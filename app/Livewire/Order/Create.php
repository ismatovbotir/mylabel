<?php

namespace App\Livewire\Order;

use Livewire\Component;
use App\Models\Item;

class Create extends Component
{
    public $items=[];
    public $search='';

    public function updatedSearch(){
        if(strlen($this->search)>3){
            $this->items=Item::select('name')->where('name','like',"%{$this->search}%")->get();
        }
    }
    public function render()
    {
        return view('livewire.order.create');
    }
}
