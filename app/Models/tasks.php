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



   public function task_user()
    {
        return $this->hasMany(task_user::class, 'task_id');   //defines a one-to-many relationship between a task and its users
                                                              //one task can be assigned to many users
    }

    public function task_files()
    {
        return $this->hasMany(task_files::class, 'task_id');
    }

    public function projects()
    {
        return $this->belongsToMany(projects::class, 'project_task', 'task_id' , 'project_id');                //defines many to many relationship with projects and tasks
                                                                                                                //one task can be associated with many projects.
    }



}
