<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class task_files extends Model
{
    use HasFactory;
    protected $table = 'task_files';
   protected $primaryKey = 'task_file_id';
   protected $fillable = ['task_id','file_id'];
   public $timestamps = false;

   public function tasks()
   {
    return $this->belongsTo(tasks::class, 'task_id');
   }

   public function files()
   {
    return $this->belongsTo(files::class, 'file_id');
   }
}
