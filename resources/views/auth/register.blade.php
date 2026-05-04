@extends('auth.layout')
@section('auth')
    <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="tab-login" data-mdb-pill-init href="{{ route('login') }}" role="tab"
        aria-controls="pills-login" aria-selected="false">Login</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="tab-register" data-mdb-pill-init href="{{ route('register') }}" role="tab"
        aria-controls="pills-register" aria-selected="true">Register</a>
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


    <div class="tab-content w-75">

  <div class="tab-pane fade show active" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
    <form method="POST" action="{{ route('storeUser') }}">
        @csrf
      <!-- Name input -->
      <div data-mdb-input-init class="form-outline mb-4">
        <input type="text" id="registerName" class="form-control" name="name"/>
        <label class="form-label" for="registerName">Name</label>
      </div>


      <!-- Email input -->
      <div data-mdb-input-init class="form-outline mb-4">
        <input type="email" id="registerEmail" class="form-control" name="email"/>
        <label class="form-label" for="registerEmail">Email</label>
      </div>

      <!-- Password input -->
      <div data-mdb-input-init class="form-outline mb-4">
        <input type="password" id="registerPassword" class="form-control" name="password"/>
        <label class="form-label" for="registerPassword">Password</label>
      </div>

      <!-- Repeat Password input -->
      <div data-mdb-input-init class="form-outline mb-4">
        <input type="password" id="registerRepeatPassword" class="form-control" name="password_confirmation"/>
        <label class="form-label" for="registerRepeatPassword">Repeat password</label>
      </div>

      <!-- Checkbox -->

      <!-- Submit button -->
      <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-3">Sign in</button>
    </form>
  </div>
</div>
 @endsection