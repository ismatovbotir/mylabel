<?php

namespace App\Livewire\Company;

use Illuminate\Support\Facades\Http;
use Livewire\Component;


class Balance extends Component
{
    public string $balance;
    public string $stir;
    
    public function mount(){
       // $this->balance=$this->getBalance();
        
        //dd($this->balance);
    }
    public function render()
    {
        return view('livewire.company.balance');
    }
    

    protected function getBalance(){
    
        $response = Http::withBasicAuth('Admin', 'info@pos.uz')
                             ->withBody(json_encode(["stir"=>$this->stir]))
                             ->post("127.0.0.1:8000/base/hs/clients/balance");
        
        if($response->status()!=200){
            return 0;
        };
        $jsonRes=json_decode($response->body());
        if($jsonRes->status=="ok"){
            return number_format($jsonRes->message,0,"."," ");
        }else{
            return 0;
        }

    }
}
