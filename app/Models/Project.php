<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $hidden = [
        'users', 'pivot',
    ];

    public function objects() {
        return $this->hasMany(Post::class);
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }
}
