<?php

namespace App\Livewire\Item;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Price extends Component
{
    public $price=0;
    public $code;
    public function mount($code){
        $this->code=$code;

    }
    public function getPrice(){
        //dd('localhost:8000/base/hs/crm/price/'.$this->code);
        $res = Http::withHeaders([
            'Authorization' => 'Basic YWRtaW46aW5mb0Bwb3MudXo=',
            'Accept' => 'application/json'
        ])->get('localhost:8000/base/hs/crm/price/'.$this->code);
        
        if($res->status()==200){
                //dd($res->body());
                $jsonData=$res->json();
                //dd($jsonData);
                $this->price=$jsonData["data"];
                //$this->price=$dataArr["price"];
        }else{
            
        }
    }
    public function render()
    {
        $this->getPrice();
        return view('livewire.item.price');
    }
}
