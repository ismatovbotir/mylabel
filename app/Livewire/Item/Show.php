<?php

namespace App\Livewire\Item;

use Livewire\Component;
use App\Models\Category;
use App\Models\Item;
use App\Models\Price;

class Show extends Component
{
    public $item;
    public $categories;
    
    
    public function mount($id){

        $this->update($id);
        //dd($this->item);
        $this->categories=Category::all();
        
    }
    public function changeShortName($id,$value){
        Item::where('id',$id)->update([
            "short_name"=>$value
        ]);
        $this->update($id);
        //dd($this->item);
    }
    public function changeDescription($id,$value){
        Item::where('id',$id)->update([
            "description"=>$value
        ]);
        $this->update($id);
        //dd($this->item);
    }
    public function changeCategory($id,$value){
        if($value!==""){

            Item::where('id',$id)->update([
                "category_id"=>$value
            ]);
            $this->update($id);
        }
        //dd($this->item);
    }

    public function changePrice($id,$value){
    Price::where('id',$id)->update(['price'=>$value]);
        $this->update($this->item->id);

    }
    public function changePriceCurrency($id,$currency){
        
            $newCurrency=$currency=="USD"?"UZS":"USD";
        Price::where('id',$id)->update(
            ['currency'=>$newCurrency]
        );
        $this->update($this->item->id);

    }
    protected function update($id){
        $this->item=Item::where('id',$id)->with('prices.type')->first(); 
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

    public function render()
    {
        return view('livewire.item.show');
    }
}
