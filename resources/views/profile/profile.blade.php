@extends('layouts.App')
@section('content')

    <div class="row my-3">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <img src="{{ Auth::user()->picture }}" alt="avatar"
              class="rounded-circle img-fluid" style="width: 150px;">
            <h5 class="my-3">{{ Auth::user()->name }}</h5>
            <div class="d-flex justify-content-center mb-2">
              <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary">Follow</button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Full Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ Auth::user()->name }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Phone</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ Auth::user()->phone }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Age</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ Auth::user()->age }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Address</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ Auth::user()->address }}</p>
              </div>
            </div>
          </div>
        </div>
        
      </div>
      @foreach ($allPosts as $post)
          
      
        <div class="mt-4 card">
                    <div  class="d-flex flex-row align-items-center  card-header">
                        <img src="{{ $post->user->picture }}" alt=" profile img" class="rounded-circle m-2"  style="width:40px; height:40px;" >
                        <h6 class="card-title">{{ $post->user->name }}</h6>
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
                        <a href="{{ route('posts.show', $post) }}" class="btn btn-sm btn-primary">The post</a>
                        @if($post->user_id === Auth::id())
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


    @endforeach


    </div>
 
</section>
@endsection