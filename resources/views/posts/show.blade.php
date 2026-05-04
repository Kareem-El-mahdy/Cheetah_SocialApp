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
                    
                    @php
                            $liked = $post->likes->contains('user_id', auth()->id());
                            $saved = $post->savedPosts->contains('user_id', auth()->id());
                        @endphp


                        <form action="{{ route('posts.like') }}" method="post">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            @if ($liked)
                                <button type="submit" class="btn btn-primary bi bi-hand-thumbs-up "> {{$post->likes->count() }}</button>
                            @else
                                <button type="submit" class="btn btn-outline-primary bi bi-hand-thumbs-up "> {{ $post->likes->count() }}</button>
                            @endif
                        </form>


                        <form action="{{ route('posts.save') }}" method="post">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            @if ($saved)
                                <button type="submit" class="btn btn-dark bi bi-save "> {{$post->savedPosts->count() }}</button>
                            @else
                                <button type="submit" class="btn btn-outline-dark bi bi-save "> {{ $post->savedPosts->count() }}</button>
                            @endif
                        </form>

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


        
        <form method="POST" action="{{ route('comments.store') }}" class="d-flex my-4" >
            @csrf
           <button class="btn btn-outline-success "  type="submit">comment</button>
            <input  class="form-control me-2" type="text" placeholder="What do you thinking" aria-label="text" name="content"/>
            <input type="hidden" name="post_id" value="{{ $post->id }}"/>

        </form>

        @foreach ($comments as $comment)
        <div class="mt-4 card">
            <div  class="d-flex flex-column  card-header">
                <div class="d-flex flex-row align-items-center  ">
                <img src="{{ $comment->user->picture }}" alt=" profile img" class="rounded-circle m-2"  style="width:40px; height:40px;" >
                <h6 class="card-title">{{ $comment->user->name }} : </h6>
                <form action="{{ route('comments.destroy', $comment) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </div>
            <p class="card-text mx-5 d-block">  {{ $comment->content }}</p>
            </div>
        </div> 
        @endforeach

@endsection