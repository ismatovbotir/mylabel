<?php

namespace App\Livewire\Company;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Company;
use Illuminate\Support\Facades\Http;

class CompanySearch extends Component
{
    use WithPagination; 
    public string $search='';
    public $addCompany=false;
    //public $data;
    public function mount(){
        //$this->data=Company::where('stir','<>',null)->paginate(15);
       // dd($this->data);
    }
    
    public function refreshCompany(){
        $res = Http::withHeaders([
            'Accept' => 'application/json'
        ])->withBasicAuth(env('ADINES_USER'), env('ADINES_PASSWORD'))->get(env('ADINES_SERVER').':'.env('ADINES_PORT').'/base/hs/crm/company');
        if($res->status()==200){
                $jsonData=$res->json();
                //dd($jsonData['data']);
                $dataArr=$jsonData["data"];
                foreach($dataArr as $data){
                    //if($data["mob"]!=""){
                        //dd($data);

                    //}
                    Company::upsert(
                        $data,
                        ['stir'],
                        ['code','name','fullName','address','mob','one_time']
                    );
                }
                //dd($companies);
        }else{
            //dd($res);
        }
        
       
        
        
    }
    public function companyCreate(){
        $res = Http::withHeaders([
            'Authorization' => 'Basic YWRtaW46aW5mb0Bwb3MudXo=',
            'Accept' => 'application/json'
        ])->post('localhost:8000/base/hs/clients/newClient',[
            'stir'=>$this->search
        ]);
        if($res->status()==200){
                $jsonData=$res->json();
                //dd($jsonData['data']);
                $dataArr=$jsonData["data"];
                foreach($dataArr as $data){
                    //if($data["mob"]!=""){
                        //dd($data);

                    //}
                    $cmpn=Company::upsert(
                        $data,
                        ['stir'],
                        ['code','name','fullName','address','mob','one_time']
                    );
                    //dd($cmpn);
                }
                //dd($companies);
        }else{
            $this->search='';
        }
    }
    
    public function render()
    {
        $query=Company::query();
        if($this->search){
            $query->where(function ($qr){
                $qr->where('name','like',"%{$this->search}%")
                   ->orWhere('fullname','like',"%{$this->search}%")
                   ->orWhere('stir','like',"%{$this->search}%");

            });
            
        }
        $data=$query->with('priceType')->orderBy('name','asc')->paginate(10);
        //dd($data);
        return view('livewire.company.company-search',
        ["data"=>$data]);
    }
}
