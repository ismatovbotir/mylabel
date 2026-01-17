<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\PriceType;
use App\Models\Item;

class Company extends Model
{
    use HasFactory;
    use HasUuids ;  

    public $guarded=[];

    public function orders(){
        return $this->hasMany(Order::class );
    }
    public function deliveries(){
        return $this->hasMany(Delivery::class);
    }
    public function lastorder(){
        return $this->hasOne(Order::class)->latestOfMany('created_at');
    }
    public function priceType(){
        return $this->belongsTo(PriceType::class);
    }
    public function items()
    {
        return $this->belongsToMany(Item::class, 'company_item');
    }
}
