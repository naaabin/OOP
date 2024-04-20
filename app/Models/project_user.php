<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class project_user extends Pivot
{
    use HasFactory;
    protected $table = 'project_user';
    protected $primaryKey = 'project_user_id';
    protected $fillable = ['project_id','id'];
    public $timestamps = false;
}
