<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'project_id',
        'file_path',
        'file_type',
        'file_name',
        'file_size'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}