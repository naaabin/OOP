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
        return $this->belongsToMany(tasks::class, 'project_task');        //defines many to many relationship between projects and tasks
                                                            //one project can be associated with many tasks.
    }
}
