<?php

namespace App\Livewire\Offer;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Offer;
use App\Models\OfferItem;

class Index extends Component
{
    use WithPagination;

    //public $items = [];
    public $search="";
    public $data=[];
    
    public function mount()
    {
       
    }

    public function publicStatus($status,$id){
      $newStatus=0;
      //dd($status);
      if($status==0){
        $newStatus=1;
      }

      Offer::where('id',$id)->update([
        'public'=>$newStatus
      ]);
      //$offer=Offer::where('id',$id)->first();
      //dd($offer);
    }
    public function deleteOffer($id){
      OfferItem::where('offer_id',$id)->delete();
      Offer::where('id',$id)->delete();
    }
    public function render()
    {
        //dd(auth()->user());
       
          $this->data=Offer::orderBy('created_at','desc')->get();  
        
        //dd($this->data);
        return view('livewire.offer.index');
    }
}
