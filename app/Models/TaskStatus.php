<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Task;

class TaskStatus extends Model
{
    use HasFactory;
    public $guarded=[];

    public function task(){
        return $this->belongsTo(Task::class);
    }
}
