<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TaskUser extends Pivot
{
    use HasFactory;
    protected $table = 'task_user';
    protected $primaryKey = 'task_user_id';
    protected $fillable = ['task_id','id'];
    public $timestamps = false;
     
   
}
