<?php

namespace App\Livewire\Delivery;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Delivery;

class Index extends Component
{
    
    use WithPagination;
    //public $data=[];
    public function render()
    {
        $data=Delivery::with(['order','company','user'])->orderBy('created_at','desc')->paginate(10);
        //dd($this->data);
        return view('livewire.delivery.index',compact('data'));
    }
}
