<?php

namespace App\Livewire\Telegram;

use Livewire\Component;
use App\Models\Telegram;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    //public $data=[];
    public function mount(){
        

    }
    
    public function render()
    {
        $data=Telegram::with(['lastMessage','user','company'])->orderBy('created_at','desc')->paginate(20);
        //dd($data);
        return view('livewire.telegram.index',['data'=>$data]);
    }
}
