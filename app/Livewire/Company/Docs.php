<?php

namespace App\Livewire\Company;

use Livewire\Component;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Company;

class Docs extends Component
{
    public $orders;
    public $offers;
    public $items;
    public $id;

    public function mount($id){
        $this->orders=Order::where('company_id',$id)->orderBy('updated_at','desc')->get();
        $this->offers=Offer::where('company_id',$id)->orderBy('updated_at','desc')->get();
        $this->items=Company::where('id',$id)->with('items')->get();
        $this->id=$id;
        //dd($this->offers);
    }
    public function render()
    {
        return view('livewire.company.docs');
    }
}
