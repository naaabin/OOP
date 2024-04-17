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
     
    /*
    This method defines a relationship that the task_user model belongs to the tasks model. 
    The belongsTo method is used to define an inverse one-to-one or one-to-many relationship. 
    The first argument is the name of the related model. 
    The second argument is the name of the foreign key in the task_user model that is used to link it to the tasks model.
    */
    public function tasks() 
    {
     return $this->belongsTo(tasks::class, 'task_id');
    }
 
    public function users()
    {
     return $this->belongsTo(User::class, 'id');
    }
}
