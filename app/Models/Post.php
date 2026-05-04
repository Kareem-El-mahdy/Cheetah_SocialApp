<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Comment;
use App\Models\Like;
use App\Models\SavedPost;


class Post extends Model
{
    protected $fillable = ['title', 'content', 'user_id' ];
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function savedPosts()
    {
        return $this->hasMany(SavedPost::class);
    }
    

}
