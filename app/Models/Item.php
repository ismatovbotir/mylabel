<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;
use App\Models\Company;
use App\Models\CompanyItem;
use App\Models\OfferItem;

class Item extends Model
{
    use HasFactory;
    use HasUuids;
    protected $guarded=[];

    public function order(){
        return $this->hasOne(OrderItem::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function prices(){
        return $this->hasMany(Price::class)->orderBy('price_type_id','asc');
    }
    public function price($id){
        return $this->hasOne(Price::class)->where('price_type_id',$id)->first();
    }

    public function companies(){

        return $this->hasMany(CompanyItem::class, 'item_id');

    }
    public function offer(){
        
        return $this->hasMany(OfferItem::class);
    }

}
