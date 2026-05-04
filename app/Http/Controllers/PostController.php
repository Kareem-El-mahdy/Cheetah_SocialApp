<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests\DeletePostRequest;
use App\Http\Requests\PostValidRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Like;
use App\Models\SavedPost;


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
              $data = [
                "post" => $post ,
                "comments" => $post->comments->all(),
                "location" => "post"
              ];
       
            return view(view:'posts.show' , data: $data);
    }
        public function create(){
                return view(view:'posts.create' , data: [
                "location" => "create"
                ]);
        }
        public function store(Request $request){

                $data = $request->all();
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
        public function destroy(Post $post){
                $data = $post->find($post);
                if($post->user_id !== Auth::id()){
                        return redirect()->route('posts.index')->with('error' , 'You are not authorized to delete this post'); 
                }else{
                $post->delete();
                return redirect()->route('posts.index')->with('success' , 'Post deleted successfully'); }
        }
        public function storeComment(Request $request ){
                // dd($request->all());
                $data = $request->all();
                $data['user_id'] = Auth::id();
                Comment::create($data);
                return redirect()->route('posts.show' , ['post' => $data['post_id']])->with('success' , 'Comment added successfully');
        }
        public function deleteComment( $comment){
                $comment = Comment::find($comment);
                // dd($comment['user_id']);
                if($comment->user_id !== Auth::id() || !$comment){
                        return redirect()->route('posts.show')->with('error' , 'You are not authorized to delete this comment'); 
                }else{
                $comment->delete();
                return redirect()->route('posts.show', ['post' => $comment->post_id])->with('success' , 'Comment deleted successfully'); }
        }


        
        public function like(Request $request){
                $data = $request->all();                
                $userId = Auth::id();
                // dd($data , $data['post_id'] , $userId);
                if(Like::where('user_id' , $userId)->where('post_id' , $data['post_id'])->exists()){
                        Like::where('user_id' , $userId)->where('post_id' , $data['post_id'])->delete();
                        return back()->with('error' , 'like');
                }else{
                        Like::create([
                                'user_id' => $userId,
                                'post_id' => $data['post_id'],
                        ]);
                        // dd(like::where('user_id' , $userId)->where('post_id' , $data['post_id'])->first());
                        return back()->with('success' , ' liked ');
                }
        }
        public function save(Request $request){
                $data = $request->all();
                $post = Post::find($data['post_id']);
                $userId = Auth::id();
                if(SavedPost::where('user_id' , $userId)->where('post_id' , $data['post_id'])->exists()){
                        SavedPost::where('user_id' , $userId)->where('post_id' , $data['post_id'])->delete();
                        return back()->with('error' , 'Post removed from saved posts');
                }else{
                        SavedPost::create([
                                'user_id' => $userId,
                                'post_id' => $data['post_id']
                        ]);
                return back()->with('success' , 'Post saved successfully');
        }
        }
        public function savedPosts(){
                $userId = Auth::id();
                $savedPosts = SavedPost::where('user_id' , $userId)->with('post')->get();
                // dd($savedPosts);
                return view(view:'saved' , data: [
                        "savedPosts" => $savedPosts ,
                        "location" => "saved"
                ]);
        }
}

        

