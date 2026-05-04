<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->input('search');
        $posts = Post::where('title', 'like', '%' . $search . '%')
            ->orWhere('content', 'like', '%' . $search . '%')
            ->get();
        $users = User::where('name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->get();
        // $users = $users->all();
        // dd($posts, $users, $search);

        return view('search', data : [
            'allPosts' => $posts,
            'users' => $users,
            'search' => $search,
            'location' => 'Cheetah Search',
        ]);
    
}}
