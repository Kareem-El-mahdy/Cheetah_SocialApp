<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests\DeletePostRequest;

use Illuminate\Http\Request;


class PostController extends Controller

{

   
    public function index(){
            
            return view(view:'posts.index' , data: [
            "allPosts" => Post::all() ,
            "location" => "home"
            ]);
    }
    public function show($uuid){
            return view(view:'posts.show' , data: [
            "post" => Post::where('uuid', $uuid)->first() ,
            "location" => "post"
            ]);
    }
        public function create(){
                return view(view:'posts.create' , data: [
                "location" => "create"
                ]);
        }
        public function store(Request $request){
                $data = $request->all();
                $data['user_id'] = 2;
                $data['uuid'] = (string) \Illuminate\Support\Str::uuid();
                
                Post::create($data);
                return redirect()->route('posts.index')->with('success' , 'Post created successfully');
        }
        public function edit($id){
                return view(view:'posts.edit' , data: [
                "post" => Post::where('uuid', $id)->first() ,
                "location" => "edit"
                ]);
        }
        public function update(Request $request , $uuid){
                $data = $request->all();
                // dd($id);
                Post::where('uuid', $uuid)->first()->update($data);
                return redirect()->route('posts.index')->with('success' , 'Post updated successfully'); 
        }
        public function destroy($uuid){
                Post::where('uuid', $uuid)->first()->delete();
                return redirect()->route('posts.index')->with('success' , 'Post deleted successfully'); 
        }
}
