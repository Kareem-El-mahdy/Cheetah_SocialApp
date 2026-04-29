
@extends("layouts.App")
@section('content')
<a href="{{ route('posts.create') }}" style="text-decoration: none;"><form class="d-flex mt-4" role="search">
               <button class="btn btn-outline-success "  type="button">Post</button>
                <input  class="form-control me-2" type="text" placeholder="What do you thinking" aria-label="Search"/>
                <div >
                <img src="./images/profile.png" alt=" profile img" class="rounded-circle w-25">
                </div>
            </form></a>

@foreach ($allPosts as $post)
<div class="mt-4 card">
            <div  class="d-flex flex-row align-items-center  card-header">
                <img src="./images/profile.png" alt=" profile img" class="rounded-circle m-2"  style="width:40px; height:40px;" >
                <h6 class="">Kareem Almahdy</h6>
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text "> {{ substr($post->content, 0, 100) }}... </p>
                
                <div class="d-flex justify-content-between">
                <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                    <button type="button" class="btn btn-outline-primary bi bi-hand-thumbs-up "> Like</button>
                    <a href=""><button type="button" class="btn btn-outline-secondary bi bi-chat-square"> Comment</button></a>
                    <button type="button" class="btn btn-outline-secondary bi bi-send-fill"> Share</button>

                </div>
                <div class="" role="group" aria-label="Small button group">
                <a href="{{ route('posts.show', $post->uuid) }}" class="btn btn-sm btn-primary">The post</a>
                <a href="{{ route('posts.edit', $post->uuid) }}" class="btn btn-sm btn-secondary">Edit</a>
                <form action="{{ route('posts.destroy', $post->uuid) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
                </div>
            </div>
            </div>
        </div> 

@endforeach
@endsection