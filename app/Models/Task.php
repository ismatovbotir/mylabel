<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\TaskStatus;

class Task extends Model
{
    use HasFactory, HasUuids;
    public $guarded=[];

    public function statussess(){
        return $this->hasMany(TaskStatus::class);
    }
    public function authorName(){
        return $this->belongsTo(User::class,'author');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
