@extends('layouts.App')
@section('content')
    <form action="{{ route('posts.update', $post) }}" method="POST">
        @csrf
        @method('PUT')
            <div class="mb-3">
            <label for="exampleFormControlText " class="form-label" >edit title</label>
            <input class="form-control" id="exampleFormControlText" rows="3" type='text' name="title" value="{{ $post->title }}"></input>
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>   
            @enderror
            <label for="exampleFormControlTextarea1" class="form-label">What do you think</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="content" >{{ $post->content }}</textarea>
            @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
            <button  class="btn btn-outline-primary " type="submit"> Publish Article</button>
            <button type="button" class="btn btn-outline-secondary "> Cancel</button>
        </div>


            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Publication audience</button>
    <ul class="dropdown-menu">
        <li class="dropdown-item" >Public</li>
        <li class="dropdown-item" >Friends</li>
        <li class="dropdown-item" >Only me</li>
    </ul>
    </form>
@endsection