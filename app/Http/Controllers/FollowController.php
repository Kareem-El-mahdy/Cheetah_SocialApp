<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Follow;

class FollowController extends Controller
{
    //Route::get(uri: '/follow/{user}', action: [FollowController::class, 'follow']) ->name(name: 'follow');
    // Route::get(uri: '/followers/{user}', action: [FollowController::class, 'followers']) ->name(name: 'followers');
    // Route::get(uri: '/followRequests', action: [FollowController::class, 'followRequests']) ->name(name: 'followRequests');
    // Route::get(uri: '/acceptFollow/{user}', action: [FollowController::class, 'acceptFollow']) ->name(name: 'acceptFollow');
    public function follow(User $user)
    {
        $currentUser = Auth::user();
        $followedUser = $user;

        if ($currentUser->id === $user->id) {
            return redirect()->back()->with('error', 'You cannot follow yourself.');
        }

        if (Follow::where('follower_id', $currentUser->id)->where('followeing_id', $user->id)->exists()) {
            Follow::where('follower_id', $currentUser->id)->where('following_id', $user->id)->delete();
            
            return redirect()->back()->with('error', 'You are no longer following this user.');
        }

        
            Follow::create([
                'follower_id' => $currentUser->id,
                'following_id' => $user->id,
            ]);

        return redirect()->back()->with('success', 'You are now following ' . $user->name);
    }

    public function followers(User $user)
    {
        $followers = $user->followers()->with('follower')->get()->pluck('follower');
        // dd($followers);
        return view('profile.followers', data:[
            'followers' => $followers,
            'user' => $user , 
            'location' => 'followers'
        ]);
    }
    public function follows(User $user)
    {
        $following = $user->follows()->with('following')->get()->pluck('following');
        // dd($followers);
        return view('profile.following', data:[
            'following' => $following,
            'user' => $user , 
            'location' => 'following'
        ]);
    }
    }
