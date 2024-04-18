<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class task_user extends Model
{
    use HasFactory;
    protected $table = 'task_user';
    protected $primaryKey = 'task_user_id';
    protected $fillable = ['task_id','id'];
    public $timestamps = false;
     
   
}
