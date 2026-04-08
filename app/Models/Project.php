<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['title', 'description', 'status', 'user_id'];

    public function media()
    {
        return $this->hasMany(Media::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}