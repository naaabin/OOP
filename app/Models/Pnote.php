<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pnote extends Model
{
    use HasFactory;
    protected $table = 'pnotes';
    protected $fillable = ['project_id', 'Description'];
    protected $primaryKey = 'id';

    public function projects()
    {
        return $this->belongsToMany(Project::class , 'project_id');
    }
}
