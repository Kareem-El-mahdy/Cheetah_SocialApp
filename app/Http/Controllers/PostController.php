<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests\DeletePostRequest;
use App\Http\Requests\PostValidRequest;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;


class PostController extends Controller

{

   
    public function index(){
            
            return view(view:'posts.index' , data: [
            "allPosts" => Post::all() ,
            "location" => "home"
            
            ]);
    }
    public function show(Post $post){
       
            return view(view:'posts.show' , data: [
            "post" => $post ,
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
                $data['uuid'] = (string) \Illuminate\Support\Str::uuid();
                $data['user_id'] = Auth::id();
                
                Post::create($data);
                return redirect()->route('posts.index')->with('success' , 'Post created successfully');
        }

        public function edit(Post $post){
                if($post['user_id'] !== Auth::id()){
                        return redirect()->route('posts.index')->with('error' , 'You are not authorized to edit this post'); 
                }else{
                return view(view:'posts.edit' , data: [
                "post" => $post ,
                "location" => "edit"
                ]);}
        }



        public function update(Request $request, $post){
                $data = $request->all();
                if($data['user_id'] !== Auth::id()){
                        return redirect()->route('posts.index')->with('error' , 'You are not authorized to update this post'); 
                }else{

                // dd($id);
                Post::find($post)->update($data);
                return redirect()->route('posts.index')->with('success' , 'Post updated successfully'); 
                }
        }
        public function destroy($post){
                if($post['user_id'] !== Auth::id()){
                        return redirect()->route('posts.index')->with('error' , 'You are not authorized to delete this post'); 
                }else{
                Post::find($post)->delete();
                return redirect()->route('posts.index')->with('success' , 'Post deleted successfully'); }
        }


        
}
