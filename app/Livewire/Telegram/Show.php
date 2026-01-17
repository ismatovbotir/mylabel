<?php

namespace App\Livewire\Telegram;

use App\Models\Telegram;
use Livewire\Component;

class Show extends Component
{
    public $client;
    public function mount($id){
        $this->client=Telegram::where('id',$id)->with(['company','user','messages'])->first();
    }
    public function render()
    {
        dd($this->client);
        return view('livewire.telegram.show');
    }
}
