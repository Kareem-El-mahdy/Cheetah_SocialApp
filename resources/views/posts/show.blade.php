@extends('layouts.App')
@section('content')
        <div class="mt-4 card">
            <div  class="d-flex flex-row align-items-center  card-header">
                <img src="{{ $post->picture }}" alt=" profile img" class="rounded-circle m-2"  style="width:40px; height:40px;" >
                <h6 class="card-title">{{ $post->user->name }}</h6>
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text "> {{ $post->content }}</p>
                
                <div class="d-flex justify-content-between">
                <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                    <button type="button" class="btn btn-outline-primary bi bi-hand-thumbs-up "> Like</button>
                    <a href=""><button type="button" class="btn btn-outline-secondary bi bi-chat-square"> Comment</button></a>
                    <button type="button" class="btn btn-outline-secondary bi bi-send-fill"> Share</button>
                </div>
                @if($post->user_id === Auth::id())
                <div class="" role="group" aria-label="Small button group">
                <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-secondary">Edit</a>
                <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
                @endif
                </div>
            </div>
            
            </div>
        </div> 

@endsection