<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;
use App\Models\Media;

class Project extends Model
{
    protected $fillable = ['title', 'description', 'status', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function media()
    {
        return $this->hasMany(Media::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}