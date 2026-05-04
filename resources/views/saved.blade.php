@extends('layouts.App')
@section('content')
    <h1 class="my-3">Saved Posts</h1>
    @if($savedPosts->isEmpty())
        <p>You have no saved posts.</p>
    @else
        <div class="list-group">
            @foreach($savedPosts as $savedPost)
                <li class="list-group-item">
                    <a href="{{ route('posts.show', ['post' => $savedPost->post_id]) }}" class="list-group-item list-group-item-action my-2">
                        <h5 class="mb-1">{{ $savedPost->post->title }}</h5>
                        <p class="mb-1">{{ Str::limit($savedPost->post->content, 100) }}</p>
                    </a>
                </li>
            @endforeach
        </div>
    @endif
@endsection