<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'photo_url'
    ];
    protected $hidden = [
        'users', 'projects', 'pivot','created_at', 'updated_at'
    ];

    public function objects() {
        return $this->hasManyThrough(Post::class, Project::class, 'organization_id', 'project_id', 'id', 'id');
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }
    public function projects() {
        return $this->hasMany(Project::class);
    }
}
