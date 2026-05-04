
@extends("layouts.App")
@section('content')
<a href="{{ route('posts.create') }}" style="text-decoration: none;"><form class="d-flex mt-4" role="search">
               <button class="btn btn-outline-success "  type="button">Post</button>
                <input  class="form-control me-2" type="text" placeholder="What do you thinking" aria-label="Search"/>
                <div >
                <img src="{{ Auth::user()->picture }}" alt=" profile img" class="rounded-circle w-25">
                </div>
            </form></a>

@include('posts.post')
@endsection
