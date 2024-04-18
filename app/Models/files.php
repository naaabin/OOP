<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class files extends Model
{
    use HasFactory;
   protected $table = 'files';
   protected $primaryKey = 'file_id';
   protected $fillable = ['file_name','file_loc','task_id'];
   public $timestamps = false;

    public function tasks()
    {
        return $this->belongsToMany(tasks::class, 'task_files', 'file_id', 'task_id');
    }
}
