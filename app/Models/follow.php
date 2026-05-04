<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Post;

class follow extends Model
{
    protected $fillable = ['follower_id', 'following_id', 'status'];

    public function follower()
    {
        return $this->belongsTo(User::class, 'follower_id');
    }

    public function following()
    {
        return $this->belongsTo(User::class, 'following_id');
    }
    
}
