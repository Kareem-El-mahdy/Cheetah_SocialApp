@extends('layouts.App')
@section('content')
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
            <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Set title</label>
            <input class="form-control" id="exampleFormControlTextarea1" rows="3" type='text' name="title"></input>
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="exampleFormControlTextarea1" class="form-label">What do you think</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="content"></textarea>
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