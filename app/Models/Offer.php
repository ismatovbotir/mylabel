<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;
use App\Models\OfferItem;
use App\Models\User;
use App\Models\PriceType;


class Offer extends Model
{
    use HasFactory, HasUuids;
    public $guarded=[];

    public function items(){
        //return $this->hasMany(OfferItem::class);
        return $this->hasMany(OfferItem::class)
        ->join('items', 'items.id', '=', 'offer_items.item_id')
        ->orderBy('items.parent_id')
        ->orderBy('items.name')
        ->select('offer_items.*');
    }
    public function company(){
        return $this->belongsTo(Company::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function priceType(){
        return $this->belongsTo(PriceType::class);
    }
}
