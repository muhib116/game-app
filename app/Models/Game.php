<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $casts = [
        'instruction' => 'array',
        'login' => 'array',
        'tasks' => 'array'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function media() {
        return $this->morphMany(Media::class, 'media');
    }
}
