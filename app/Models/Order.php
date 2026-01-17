<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;
use App\Models\User;
use App\Models\PriceaType;
use App\Models\OrderItem;
use App\Models\Comment;
use App\Models\OrderStatus;
use App\Models\Delivery;
use App\Models\DeliveryItem;


class Order extends Model
{
    use HasFactory,HasUuids;

    public $guarded=[];

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function priceType(){
        
        return $this->belongsTo(PriceType::class);
    }
    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }

    public function deliveryItems()
    {
        // Через OrderItem -> DeliveryItem
        return $this->hasManyThrough(DeliveryItem::class, OrderItem::class);
    }
    

    public function comments(){
        return Comment::where('model','order')->where('doc_id',$this->id);
    }
    public function status(){
        return $this->hasMany(OrderStatus::class);
    }
    public function currentStatus(){
        return $this->hasOne(OrderStatus::class)->latestOfMany();
    }
    public function deliveries(){
        return $this->hasMany(Delivery::class);
    }
   
}
