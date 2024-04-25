<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table = 'tasks';
    protected $primaryKey = 'task_id';
    protected $fillable = ['task','description','priority'];
    public $timestamps = true;

    public function users()
    {
        return $this->belongsToMany(User::class, 'task_user', 'task_id', 'id');  
    }

    public function files()
    {
        return $this->hasMany(File::class, 'task_id', 'task_id');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_task', 'task_id' , 'project_id');                
    }

    public function notes()
    {
        return $this->hasMany(Note::class, 'task_id');
    }
}
