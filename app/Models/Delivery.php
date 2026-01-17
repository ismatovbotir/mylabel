<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DeliveryItem;
use App\Models\Company;
use App\Models\Order;

class Delivery extends Model
{
    use HasFactory, HasUuids;
    public $guarded=[];

    public function items(){
        return $this->hasMany(DeliveryItem::class);
    }
    public function company(){
        return $this->belongsTo(Company::class);
    }
    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
