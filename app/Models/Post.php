<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'photo_url',
        'scheme_url',
        'risks',
        'security',
        'geotag',
        'project_id',
    ];
}
