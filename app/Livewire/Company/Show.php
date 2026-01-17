<?php

namespace App\Livewire\Company;

use Livewire\Component;
use App\Models\Company;
use App\Models\PriceType;

class Show extends Component
{
    public $company;
    public $priceTypes;

    public function mount($company){
        $this->company=$company;

        //dd($this->company);
        $this->priceTypes=PriceType::all();

    }
    public function changeCategory($id,$value){
        Company::find($id)->update([
            'price_type_id'=>$value
        ]);

    }
    public function changeAddress($id,$value){
        Company::find($id)->update([
            'address'=>$value
        ]);

    }
    public function render()
    {
        return view('livewire.company.show');
    }
}
