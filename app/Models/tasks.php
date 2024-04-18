<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tasks extends Model
{
    use HasFactory;
   protected $table = 'tasks';
   protected $primaryKey = 'task_id';
   protected $fillable = ['task','description','priority'];
   public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany(User::class, 'task_user', 'task_id', 'id');  
    }

    public function files()
    {
        return $this->belongsToMany(files::class, 'task_files', 'task_id', 'file_id');
    }

    public function projects()
    {
        return $this->belongsToMany(projects::class, 'project_task', 'task_id' , 'project_id');                //defines many to many relationship with projects and tasks
                                                                                                                //one task can be associated with many projects.
    }



}
