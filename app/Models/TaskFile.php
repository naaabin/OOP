<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TaskFile extends Pivot
{
    use HasFactory;
    protected $table = 'task_files';
   protected $primaryKey = 'task_file_id';
   protected $fillable = ['task_id','file_id'];
   public $timestamps = false;

 
}
