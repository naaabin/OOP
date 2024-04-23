<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
   protected $table = 'files';
   protected $primaryKey = 'file_id';
   protected $fillable = ['file_name','file_loc','task_id'];
   public $timestamps = false;

    public function tasks()
    {
        return $this->belongsTo(Task::class, 'task_id', 'task_id');
    }
}
