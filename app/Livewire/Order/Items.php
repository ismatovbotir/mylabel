<?php

namespace App\Livewire\Order;

use App\Http\Controllers\Admin\TelegramController;
use Livewire\Component;
use App\Models\OrderItem;
use App\Models\Item;
use App\Models\Order;
use Illuminate\Support\Facades\Http;
//use Illuminate\Support\Facades\Auth;

class Items extends Component
{
    public $orderItems = [];
    public $search = '';
    public $results = [];

    //public $def=[];

    public $order;
    public $id;

    public $adines_server;
    public $adines_port;
    public $adines_user;
    public $adines_password;


    public function mount($id)
    {
        $this->id = $id;
        $this->order = Order::where('id', $id)->with('orderItems')->first();

        //$this->def=['order_item_id'=>'','name'=>'','item_id'=>null,'quantity'=>1,'price'=>0,'price_type'=>$this->order->price_type_id];
        //$this->orderItems[]=$this->def;
        $this->orderItems = OrderItem::where('order_id', $id)->with('item')->get();
        //dd($this->orderItems);
        $this->adines_server=env('ADINES_SERVER');
        $this->adines_port=env('ADINES_PORT');
        $this->adines_user=env('ADINES_USER');
        $this->adines_password=env('ADINES_PASSWORD');
    }

    public function updatedSearch($value, $key)
    {
        //dd($value);
        $this->results = Item::where('name', 'like', '%' . $value . '%')->take(5)->get();
    }

    public function selectItem($index, $itemId)
    {
        // dd($itemId);
        $item = Item::where('id', $itemId)->with('prices.type')->first();
        //dd($item);
        $price = $this->getPrice($item->prices);
        //dd($price);
        OrderItem::create([
            "order_id" => $this->order->id,
            "item_id" => $itemId,
            "qty" => 1,
            "price" => $price,
            "user_id" => auth()->id()
        ]);
        $this->orderItems = OrderItem::where('order_id', $this->order->id)->with('item')->get();
        //dd($this->orderItems);
        //$this->orderItems[]= $item;
        $this->results = [];
        $this->reset('search');
        //$this->orderItems[] =$this->def;


    }
    protected function getPrice($prices)
    {
        $res = 0;
        foreach ($prices as $price) {
            if ($this->order->price_type_id == $price->price_type_id) {

                return $price->price;
            }
        }
        return $res;
    }

    public function changeQty($id, $value)
    {

        OrderItem::where('id', $id)->update(['qty' => $value]);
    }
    public function changePrice($id, $value)
    {

        OrderItem::where('id', $id)->update(['price' => $value]);
    }

    public function sendInvoice()
    {
        Order::where('id', $this->id)->update(["status" => "Bill"]);
        $telegram = new TelegramController;
        $order = Order::where('id', $this->id)->with('company')->with('orderItems.item')->first();
        //dd($order);
        $userId = auth()->id();
        $order->status()->create([
            "user_id" => $userId,
            "status" => "Bill"

        ]);
        //$telegram->sendMessage('bill','','',2, ($order->toArray()));
        //dd($order->toArray());
        try{

            $adinesURL=rtrim($this->adines_server, '/') . ':' . $this->adines_port . '/base/hs/clients/order';
      
            $response =Http::acceptJson()
            ->withBasicAuth(
                $this->adines_user,
                $this->adines_password
            )
            ->timeout(15) 
            ->withBody(json_encode($order->toArray()))
            ->post($adinesURL);
           // dd($response->body());
            if ($response->successful()) {
               // dd($response->status());
                $jsonRes = json_decode($response->body());
                //dd($jsonRes);
                $doc = "error";
                if ($jsonRes->status == "ok") {
                    $doc = $jsonRes->message;
                    //dd($doc);
                    if ($doc->agreement_date == '') {
                        $order->update(
                            [
                                "bill" => $doc->bill,
                                "agreement_number" => $doc->agreement_number
                            ]
                        );
                    } else {
                        $order->update(
                            [
                                "bill" => $doc->bill,
                                "agreement_number" => $doc->agreement_number,
                                "agreement_date" => $doc->agreement_date
                            ]
                        );
                    }
                    $response = $telegram->sendMessage('bill', $order, $doc->doc);
                    $jsonRes = json_decode($response->body());
                    //dd($jsonRes);
                    $order->update([
                        'telegram' => $jsonRes->result->message_id
                    ]);
                    //dd($order);
                } else {
                    dd($response->status());
                }
            } 
        }catch(\Exception $e){
            dd($e->getMessage());
        }
              
    }


    public function removeItem($id)
    {
        OrderItem::where('id', $id)->delete();
        $this->orderItems = OrderItem::where('order_id', $this->order->id)->with('item')->get();
    }


    public function render()
    {
        //dd($this->results);
        return view('livewire.order.items');
    }
}
