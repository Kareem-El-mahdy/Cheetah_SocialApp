
@extends('layouts.App')
@section('content')
<div class="container">

@if (!$followers)
    <div class="alert alert-info mt-3" role="alert">
        No users found ".
    </div>
    @else
    @foreach ($followers as $user)
        
    <div class="card shadow-sm mt-3" style="max-width: 540px; margin: 0 auto;">
    
            <div class="row g-0 d-flex align-items-center justify-content-center">
                <div class=" p-3 text-center w-25">
                    <img src="{{ $user->picture }}" class="rounded-circle img-thumbnail" alt="Profile Picture">
                </div>
                <div class="w-75">
                    <div class="card-body mt-3">
                        <h5 class="card-title d-flex justify-content-between align-items-center">
                            {{ $user->name }}
                        </h5>
                            <small class="text-muted">
                                    <i class="fas fa-map-marker-alt"></i> {{ $user->address }}
                                </small>
                        </p>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white">
                <div class="d-flex justify-content-around">
                    <a href="{{ route('user.profile', $user->id) }}" class="btn btn-link text-decoration-none">
                             view profile
                    </a>

                </div>
            </div>
        </div>
        @endforeach
@endif

@endsection