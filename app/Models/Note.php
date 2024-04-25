<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    
    protected $fillable = ['task_id', 'Description'];
    protected $table = 'notes';
    protected $primaryKey = 'id';

    public function tasks()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }
}
