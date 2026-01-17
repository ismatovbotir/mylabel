<?php

namespace App\Livewire\Order;

use Livewire\Component;
use App\Models\Order;

class Comment extends Component
{
    public $id;
    public $comment;
    public $state;

    public function mount(){
       
        $order=Order::find($this->id);
        $this->comment=$order->comment;
        //dd($this->comment);
    }
    public function changeComment(){
        Order::find($this->id)->update(['comment'=>$this->comment]);
    }

    public function render()
    {
        return view('livewire.order.comment');
    }
}
