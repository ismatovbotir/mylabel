<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TelegramMessage;
use App\Models\User;
use App\Models\Company;

class Telegram extends Model
{
    use HasFactory;
    public $incrementing=false;
    //protected $keyType='int';
    //protected $primaryKey='id';
    protected $guarded=[];

    public function messages(){
        return $this->hasMany(TelegramMessage::class);
    }
    public function lastMessage(){
        return $this->hasOne(TelegramMessage::class)->where('bdb',0)->where('type','text')->whereNot('business_connection_id','')->latestOfMany();
    }
    public function company(){
        return $this->belongsTo(Company::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
