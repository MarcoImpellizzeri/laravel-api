<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $casts = [
        'languages_used' => 'array'
    ];

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'languages_used',
        'github_url',
        'type_id',
    ];

    public function type() {
        return $this->belongsTo(Type::class);
    }
}
