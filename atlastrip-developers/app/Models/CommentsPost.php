<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentsPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'creator',
        'post_id'
    ];
}
