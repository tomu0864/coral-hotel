<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->BelongsTo(User::class, 'user_id', 'id');
    }

    public function post()
    {
        return $this->belongsTo(BlogPost::class, 'post_id', 'id');
    }
}
