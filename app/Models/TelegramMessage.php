<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Telegram;

class TelegramMessage extends Model
{
    use HasFactory;
    public $guarded=[];
    protected $cast=[
        'obj'=>'object',
        'links'=>'object'
    ];

    public function telegram(){
        return $this->belongsTo(Telegram::class);
    }
}
