<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Delivery;
use App\Modles\Item;

class DeliveryItem extends Model
{
    use HasFactory;

    public $guarded=[];

    public function delivery(){
        return $this->belongsTo(Delivery::class);
    }
    public function item(){
        return $this->belongsTo(Itme::class);
    }
}
