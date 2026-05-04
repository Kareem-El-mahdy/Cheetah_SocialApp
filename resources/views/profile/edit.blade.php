@extends('layouts.App')
@section('content')
    <form action="{{ route('updateProfile') }}" method="POST">
        @csrf
        @method('PUT')
            <div class="mb-3">
            <label for="exampleFormControlname " class="form-label" >edit name</label>
            <input class="form-control" id="exampleFormControlname" rows="3" type='text' name="name" value="{{ Auth::user()->name }}"></input>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>   
            @enderror

           

            <label for="exampleFormControlphone " class="form-label" >edit Phone</label>
            <input class="form-control" id="exampleFormControlphone" rows="3" type='text' name="phone" value="{{ Auth::user()->Phone }}"></input>
            @error('phone')
                <div class="alert alert-danger">{{ $message }}</div>   
            @enderror

            <label for="exampleFormControlage " class="form-label" >edit Age</label>
            <input class="form-control" id="exampleFormControlage" rows="3" type='text' name="age" value="{{ Auth::user()->Age }}"></input>
            @error('age')
                <div class="alert alert-danger">{{ $message }}</div>   
            @enderror
            <label for="exampleFormControladdress " class="form-label" >edit Address</label>
            <input class="form-control" id="exampleFormControladdress" rows="3" type='text' name="address" value="{{ Auth::user()->Address }}"></input>
            @error('address')
                <div class="alert alert-danger">{{ $message }}</div>   
            @enderror
          
        </div>
        <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
            <button  class="btn btn-outline-primary " type="submit"> Edit</button>
            <a href="{{ route('profile') }}" class="btn btn-outline-secondary "> Cancel</a>
        </div>


            
    </form>
@endsection