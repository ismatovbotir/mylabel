<?php

namespace App\Livewire\Company;

use Livewire\Component;
use App\Models\Item;
use App\Models\CompanyItem;
use App\Models\Company;

class Items extends Component
{
    public $results=[];
    public $items=[];
    public $search="";
    //public $id;
    public $company;
    
    public function mount($companyId){
        $this->company=Company::where('id',$companyId)->first();

    }
    public function updatedSearch($value, $key)
    {
        //dd($value);
        $itemIds=CompanyItem::where('company_id',$this->company->id)->pluck('item_id');
        $this->results = Item::where('name', 'like', '%' . $value . '%')->whereNotIn('id',$itemIds)->take(5)->get();
    }
    public function selectItem($index, $itemId)
    {
        //$company=Company::where('id',$this->id)->first();
        //dd($company);
        // dd($itemId);
        //$itemIDs = Item::where('id', $itemId)->with('prices.type')->first();
        //dd($item);
        //$price = $this->getPrice($item->prices);
        //dd($price);
        CompanyItem::create([
            'company_id'=>$this->company->id,
            'item_id'=>$itemId,
            'price_type_id'=>$this->company->price_type_id

        ]);
       
        //dd($this->items);
        //$this->orderItems[]= $item;
        $this->results = [];
        $this->reset('search');
        //$this->orderItems[] =$this->def;


    }

    protected function getPrice($prices)
    {
        $res = 0;
        foreach ($prices as $price) {
            if ($this->item->price_type_id == $price->price_type_id) {

                return $price->price;
            }
        }
        return $res;
    }
    public function removeItem($id){
        //dd($id);
        CompanyItem::where('company_id',$this->company->id)->where('item_id',$id)->delete();

    }

    public function changePrice($id,$value,$price){
        if($value<$price){
            $disc=number_format((1-$value/$price)*100,2);
            CompanyItem::where('id',$id)->update(['discount'=>$disc]);

        }


    }
    
    public function render()
    {
        $this->items = CompanyItem::where('company_id', $this->company->id)->with('item.prices')->with('priceType')->get();
        //dd($this->items);
        return view('livewire.company.items');
    }
}
