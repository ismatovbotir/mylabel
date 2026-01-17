<?php

namespace App\Livewire\Order;

use Livewire\Component;
use App\Models\Order;
use App\Models\PriceType;

class Head extends Component
{
    public $order;
    public $isPublic;
    public $types;
    public $priceTypes;

    public function mount($id){
        $this->order=Order::with('user')->with('company')->with('priceType')->where('id',$id)->first();
        $this->isPublic=$this->order->public==1?true:false;
        $this->priceTypes=PriceType::all();
        $this->types=[
            'in',
            'out'
        ];
        //dd($this->type);
    }

    public function updatedIsPublic($value){
        //dd($value);
        Order::where('id',$this->order->id)->update(['public'=>$value]);
        $this->order->public=$value;

    }
    public function changeType($value){
        Order::where('id',$this->order->id)->update(
            ['type'=>$value]
        );

    }
    public function changePriceType($value){
        Order::where('id',$this->order->id)->update(
            ['price_type_id'=>$value]
        );


    }

    public function changeExpiryDate($value){
        Order::where('id',$this->order->id)->update(
            ['expiry_date'=>$value]
        );
    }

    public function render()
    {
        //dd($this->order);
        return view('livewire.order.head');
    }
}
