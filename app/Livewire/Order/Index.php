<?php

namespace App\Livewire\Order;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Item;
use App\Http\Controllers\admin\TelegramController;
use App\Models\Bill;
use App\Models\Company;
use App\Models\Delivery;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Http;

class Index extends Component
{
    use WithPagination;

    public $items = [];
    public $search='';
    public $modal=false;
    public $company='';
    public $dItems=[];
    public $current_order=null;
    
    public function mount()
    {
       
    }
    public function newOrder(){
        dd('new order');
    }
    public function delOrder($id){
        OrderStatus::where('order_id',$id)->delete();
        Bill::where('order_id',$id)->delete();
        Order::where('id',$id)->delete();
    }
    public function doneOrder($id){
        $order=Order::where('id',$id)->first();
        $order->update(['status'=>'Done']);
        //dd($order);
        $telegram=new TelegramController;
        $telegram->sendMessage("delivery",$order);
        $order->status()->create([
            'status'=>'Done',
            'user_id'=>auth()->user()->id
        ]);
    }
    public function showModal($id){
        //$this->dItems=[];
        $this->current_order=Order::with(['company','orderItems.item'])->where('id',$id)->first();
        //$company_id=Order::select('company_id')->where('id',$id);
        //$this->company=Company::where('id',$company_id)->first();
        $this->modal=true;
        //$items=OrderItem::with('item')->where('order_id',$id)->get();
        foreach($this->current_order->orderItems as $item){
            $this->dItems[]=[
                'name'=>$item->item->name,
                'id'=>$item->item->id,
                'code'=>$item->item->code,
                'qty'=>$item->qty,
                'dqty'=>$item->qty,
                'price'=>$item->price,
                'order_item_id'=>$item->id

            ];
        }
        //dd($this->dItems);
    }
    protected function hasDeliveryItems(){
        //$res=false;
        foreach($this->dItems as $item){
            if($item['dqty']>0){
                return true;
            }

        }
        return false;
    }
    public function closeModal(){
        $this->modal=false;
        $this->reset(['dItems','current_order']);
        }


    public function deliveryQtyChanged($idx,$value){
        
        $this->dItems[$idx]['dqty']=$value=='' ? 0 : $value;
        //dd($value);
    }

    public function saveDelivery(){
        //dd($this->dItems);
        if($this->hasDeliveryItems()){
            $delivery=Delivery::create([
                'order_id'=>$this->current_order->id,
                'company_id'=>$this->current_order->company_id,
                'user_id'=>auth()->user()->id

            ]);
            $done=1;
            foreach($this->dItems as $item){
                if($item['dqty']<$item['qty']){
                    $done=0;
                }
                if($item['dqty']>0){
                    $delivery->items()->create([
                        'order_item_id'=>$item['order_item_id'],
                        'item_id'=>$item['id'],
                        'qty'=>$item['dqty'],
                        'price'=>$item['price']
                    ]);
                }
            }
            
            try{
                $response = Http::withBasicAuth('Admin', 'info@pos.uz')
                ->withBody(json_encode([
                    "order_id"=>$this->current_order->id,
                    "delivery_id"=>$delivery->id,
                    "delivery"=>$this->dItems
                ]))
                ->post("http://127.0.0.1:8000/base/hs/clients/delivery");
               // dd($response->body());
               if($response->successful()){
                    $this->sendTelegramMessage($response->body());
               }else{
                    $this->sendTelegramMessage($response->status()." : error");
               } 
               //$response->body();

            }catch(\Exception $e){
                $this->sendTelegramMessage($e->getMessage());
            }
            


            if($done==1){
                $this->doneOrder($this->current_order->id);
            }

        }
        $this->reset(['dItems','modal','current_order']);
    }
    public function sendTelegramMessage($text){
        $telegram=new TelegramController;
        $response=$telegram->sendMessage(" "," "," ",0,$text);

    }
    public function render()
    {
        //dd(auth()->user());
        if(auth()->user()->role_id==3){
            $data=Order::where('status','<>','New')->with('company')->with('user')->with('priceType')->with('orderItems')->orderBy('created_at','desc')->paginate(10);
        }else{
            if ($this->search!=''){
                $this->resetPage();
                $data = Order::where('status','<>','Done')
                ->withSum('orderItems', 'qty') // заказано
                ->withSum('deliveryItems', 'qty')
                ->with(['company', 'user', 'priceType', 'orderItems'])
                ->whereHas('company', function ($q) {
                    $q->where('stir', 'like','%'.$this->search.'%')->orWhere('name','like','%'.$this->search.'%');
                })
                ->orderBy('created_at', 'desc')
                ->paginate(10);
            }else{
               

                $data=Order::where('status','<>','Done')->withSum('orderItems', 'qty') // заказано
                ->withSum('deliveryItems', 'qty')
                
                ->with(['company','user','priceType','orderItems'])->orderBy('created_at','desc')->paginate(10);  
            }
        }
        
       // dd($data);
        return view('livewire.order.index',compact('data'));
    }
}
