<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Game extends Authenticatable
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $casts = [
        'instruction' => 'array',
        'login' => 'object',
        'tasks' => 'array',
        'settings' => 'array',
        'finishing' => 'array',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function media() {
        return $this->morphMany(Media::class, 'media');
    }
}
