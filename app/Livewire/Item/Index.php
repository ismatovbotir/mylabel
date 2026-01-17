<?php

namespace App\Livewire\Item;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Item;
use App\Models\Price;

class Index extends Component
{
    use WithPagination; 
    public string $search='';
   
    public function refreshItems(){
        $res = Http::withHeaders([
            'Authorization' => 'Basic YWRtaW46aW5mb0Bwb3MudXo=',
            'Accept' => 'application/json'
        ])->get('localhost:8000/base/hs/crm/item');
        if($res->status()==200){
                $jsonData=$res->json();
               // dd($jsonData['data']);
                $dataArr=$jsonData["data"];
                foreach($dataArr as $idx=>$data){
                    //dd($data);
                    //  if($data['code']==595){
                    //      dd($data);

                    // }
                    try{
                       $newItem=Item::upsert(
                        $data,
                        ['id'],
                        ['name','category_id','short_name','crm','description','mxik','package_code','acc_name','acc_code']
                    ); 
                    }catch(\Exception $e){
                        dd($data);
                    }
                    
                    //$newItem->prices->upsert();
                    //dd($newItem);
                    //$this->prices();
                }
        }else{
            dd($res);
        }
       
        //dd($res);
    }
    public function prices($id,$currency){
       
        
            for($i=1;$i<4;$i++){
               
                Price::create(
                    [
                        'item_id' => $id,
                        'price_type_id' => $i,
                        'price' => 0,
                        'currency' => $currency
                    ]
                );
            }
       

    }
    public function changePrice($id,$value){
        Price::find($id)->update(['price'=>$value]);

    }
    public function render()
    {
        $query=Item::query();
        if($this->search){
           // dd($this->search);
            $query->where(function($qr){
                $qr->where('name','like',"%{$this->search}%")
                   ->orWhere('code','like',"%{$this->search}%");

            });
            //dd($query->paginate(10));
        }
        
        
        return view('livewire.item.index',
        ["data"=>$query->paginate(10)]);
    }
}
