<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;
use App\Models\PriceType;

class Price extends Model
{
    use HasFactory;
    public $guarded=[];

    public function item(){
        return $this->belongsTo(Item::class);
    }

    public function type(){
        return $this->belongsTo(PriceType::class,'price_type_id');
    }

}
