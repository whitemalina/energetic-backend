<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fullname',
        'login',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function organizations() {
        return $this->belongsToMany(Organization::class);
    }

    public function projects() {
        return $this->belongsToMany(Project::class);
    }

    public function objects(){
        return $this->hasManyThrough(Post::class, Project::class, '', 'project_id', 'id', 'id');
    }


//    public function projects() {
//        return $this->organizations()->objects();
////        return $this->hasManyThrough(Project::class, Organization::class);
//    }

}
