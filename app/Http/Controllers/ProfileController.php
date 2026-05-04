<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function profile(){
        $posts = Post::where('user_id', Auth::id())->get();
        return view(view:'profile.profile' , data: [
            "allPosts" => $posts ,
            "location" => "profile"
            ]);
     
    }
    public function editProfile(){
        return view(view:'profile.edit' , data: [
            "location" => "editProfile"
            ]);
    }
    public function updateProfile(Request $request){
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->age = $request->input('age');
        $user->address = $request->input('address');
        $user->phone = $request->input('phone');
        $user->save();
        return redirect()->route('profile')->with('success' , 'Profile updated successfully');
    }
    public function viewProfile($id){
        $profileUser = User::where('id', $id)->first();
        if (!$profileUser) {
            return redirect()->route('search')->with('error', 'User not found');
        }
        $posts = Post::where('user_id', $profileUser->id)->get();
        return view(view:'profile.profile' , data: [
            "allPosts" => $posts ,
            "profileUser" => $profileUser,
            "location" => "viewProfile"
            ]);
    }
}
