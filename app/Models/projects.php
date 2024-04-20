<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class projects extends Model
{
    use HasFactory;
    protected $table = 'projects';
    protected $primaryKey = 'project_id';
    protected $fillable = ['project_name', 'description'];
        
    public function tasks()
    {
        return $this->belongsToMany(tasks::class, 'project_task', 'project_id', 'task_id');        
                                                           
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'project_user', 'project_id', 'id');
    }

}
