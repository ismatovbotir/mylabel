<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Price;
use App\Models\Company;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\CompanyItem;

class PriceType extends Model
{
    use HasFactory;

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function price(){
        return $this->hasMany(Price::class);
    }

    public function companies(){
        return $this->hasMany(Company::class);
    }

    public function companyItem(){
        return $this->hasMany(CompanyItem::class,'price_type_id');
    }
}
