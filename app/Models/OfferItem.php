<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Offer;
use App\Models\Item;

class OfferItem extends Model
{
    use HasFactory;
    public $guarded=[];
    
    public function offer(){
        return $this->belongsTo(Offer::class);
    }
    public function item(){
        return $this->belongsTo(Item::class);
    }
}
