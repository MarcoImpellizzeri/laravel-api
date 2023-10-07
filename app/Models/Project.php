<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $casts = [
        'languages_used' => 'array'
    ];

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'languages_used',
        'github_url'
    ];
}
