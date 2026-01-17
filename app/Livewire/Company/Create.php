<?php

namespace App\Livewire\Company;

use Livewire\Component;

class Create extends Component
{
    public $stir='';
    public function newCompany(){
        dd($this->stir);

    }
    public function render()
    {
        return view('livewire.company.create');
    }
}
