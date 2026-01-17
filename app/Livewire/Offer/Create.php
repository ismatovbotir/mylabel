<?php

namespace App\Livewire\Offer;

use Livewire\Component;
use App\Models\Company;
use App\Models\Item;
use App\Models\PriceType;
use Illuminate\Support\Carbon;
use App\Models\Offer;
use App\Models\OfferItem;

class Create extends Component
{
    public $clients=[];
    public $offer_id='';
    public $clientId='';
    public $clientSearch="";
    public $priceType;
    public $priceTypeName='';
    public $offerName='';    
    public $validDate;
    public $itemSearch='';
    public $items=[];
    public $offerItems=[];

    public function mount($id=''){
        if($id!=''){
            $this->offer_id=$id;
           // dd('this is edit');
           $offer=Offer::with(['priceType','company'])->where('id',$id)->first();
           $this->priceType=$offer->priceType;
           //dd($this->priceType->toArray());
            $this->priceTypeName=$offer->priceType->name; 
            $this->validDate=$offer->expiry_date;
            $this->clientId=$offer->company_id;
            $this->clientSearch=$offer->company->name;
            $this->offerName=$offer->name;
            $offerItems=OfferItem::with('item')->where('offer_id',$id)->get();
            foreach($offerItems as $offerItem){
                $this->offerItems[]=[
                    'id'=>$offerItem->item->id,
                    'rec_id'=>$offerItem->id,
                    'name'=>$offerItem->item->name,
                    'qty'=>$offerItem->qty,
                    'price'=>$offerItem->price
                


                ];
            }
           //dd($this->offerItems);
        }else{
            $this->priceType=PriceType::find(1)->first();
            $this->priceTypeName=$this->priceType->name; 
            $this->validDate= Carbon::now()->addDays(7)->format('Y-m-d');   
        }
       
        


       
        
    }

    public function updatedClientSearch($value,$key){
        //dd($value);
        if($value!=""){
         $this->clients=Company::where('name','like','%'.$value.'%')->take(10)->get();   
        }else{
            $this->clients=[];
        }
        
        
    }

    public function updatedItemSearch($value,$key){
        $this->items=Item::where('name','like','%'.$value.'%')->take(10)->get();
    }

    public function selectClient($id,$name){

        $company=Company::where('id',$id)->with('priceType')->first();
        //dd($company);
        $this->priceType=$company->priceType;
        $this->priceTypeName=$this->priceType->name;
        $this->clientId=$id;
        $this->clientSearch=$name;
        $this->reset('clients');

    }

    public function selectItem($id){
        $n=0;
        $item=Item::where('id',$id)->first();
        $price=$item->price($this->priceType->id);
        if($price==null){
            $itemPrice=0;
        }else{
            $itemPrice=$price->price;
        }
       
          foreach($this->offerItems as $idx=> $offerItem){
            if ($offerItem['id']==$id){
                $n=1;
                $this->offerItems[$idx]['qty']++;

            }
        }
        if($n==0){
                $this->offerItems[]=[
                    'id'=>$id,
                    'rec_id'=>0,
                    'name'=>$item->name,
                    'qty'=>1,
                    'price'=>$itemPrice
                ];

        }  
        
        
        
        $this->reset(['items','itemSearch']);

    }
    
    public function qtyChanged($id,$value){
        $this->offerItems[$id]['qty']=$value;

    }
    public function priceChanged($id,$value){
        $this->offerItems[$id]['price']=$value;

    }

    public function saveOffer()
    {
       // dd($this->validDate);
        if($this->offer_id==''){
            $offerNumber = (Offer::whereYear('created_at', date('Y'))->max('number') ?? 0) + 1;
            //dd($offerNumber);
            $offer=Offer::create([
                'company_id'=>$this->clientId,
                'name'=>$this->offerName,
                'number'=>$offerNumber,
                'price_type_id'=>$this->priceType['id'],
                'expiry_date'=>$this->validDate=='' ? null :$this->validDate,
                'user_id'=>auth()->user()->id
            ]);
        
            //dd($this->offerItems);
            foreach($this->offerItems as $item){
                OfferItem::create([
                    'offer_id'=>$offer->id,
                    'item_id'=>$item['id'],
                    'qty'=>$item['qty'],
                    'price'=>$item['price']
                ]);
            }
            $this->offer_id=$offer->id;  
        }else{
            //dd($this->validDate);
            Offer::where('id',$this->offer_id)->update([
                'company_id'=>$this->clientId,
                'name'=>$this->offerName,
                'price_type_id'=>$this->priceType->id,
                'expiry_date'=>$this->validDate?? null,
                'user_id'=>auth()->user()->id

            ]);

            foreach($this->offerItems as $item){
                if($item['rec_id']==0){
                  OfferItem::create([
                        'offer_id'=>$this->offer_id,
                        'item_id'=>$item['id'],
                        'qty'=>$item['qty'],
                        'price'=>$item['price']
                    ]);  
                }else{
                    OfferItem::where('id',$item['rec_id'])->update([
                        'qty'=>$item['qty'],
                        'price'=>$item['price']
                    ]);
                }
                
            }
        }
        $this->redirect(route('admin.offer.show',['offer'=>$this->offer_id]));//,['offer'=>$offer->id]));  
     
        

    }

    public function removeItem($id){

        if($this->offerItems[$id]['rec_id']!=0){
            OfferItem::where('id',$this->offerItems[$id]['rec_id'])->delete();
        };
        $collection = collect($this->offerItems);
        $this->offerItems= $collection->forget($id)->values();


    }


    public function render()
    {
        return view('livewire.offer.create');
    }
}
