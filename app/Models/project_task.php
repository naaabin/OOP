<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project_task extends Model
{
    use HasFactory;
    protected $table = 'project_task';
    protected $primaryKey = 'project_task_id';
    protected $fillable = ['task_id','project_id'];
    public $timestamps = false;
}
