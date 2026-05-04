@extends('auth.layout')
@section('auth')
    <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="tab-login" data-mdb-pill-init href="{{ route('login') }}" role="tab"
        aria-controls="pills-login" aria-selected="true">Login</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="tab-register" data-mdb-pill-init href="{{ route('register') }}" role="tab"
        aria-controls="pills-register" aria-selected="false">Register</a>
    </li>
    </ul>


    <div class="text-center mb-3 w-75">
        <p>Sign up with:</p>
        <a  href="{{ route('auth.github') }}" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1 bg-dark" >
          <i class="fab fa-github text-white"></i>
        </a>

        <a  href="{{ route('auth.google') }}" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1 bg-dark">
          <i class="fab fa-google text-white"></i>
        </a>
    </div>

      <p class="text-center">or:</p>
    

      <div class="tab-pane fade show active w-75" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
    <form method="POST" action="{{ route('authenticate') }}">
        @csrf
      <!-- Email input -->
      <div data-mdb-input-init class="form-outline mb-4">
        <input type="email" id="loginName" class="form-control" name="email"/>
        <label class="form-label" for="loginName">Email or username</label>
      </div>

      <!-- Password input -->
      <div data-mdb-input-init class="form-outline mb-4">
        <input type="password" id="loginPassword" class="form-control" name="password"/>
        <label class="form-label" for="loginPassword">Password</label>
      </div>

      <!-- 2 column grid layout -->
  

      <!-- Submit button -->
      <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">Sign in</button>

      <!-- Register buttons -->
      <div class="text-center">
        <p>Not a member? <a href="
            {{ route('register') }}">Register</a></p>
      </div>
    </form>
  </div>

@endsection