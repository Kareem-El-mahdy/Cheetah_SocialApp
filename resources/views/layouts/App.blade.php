<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ strtoupper($location) }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-dark bg-dark ">
        <div class="container-fluid w-100 ">
            <a class="navbar-brand text-secondary" href="{{ route('posts.index') }}">Cheetah</a>
            
            <div class="collapse navbar-collapse " id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll w-100" style="--bs-scroll-height: 100px;">
                    @if ($location == 'home')
                        <li class="nav-item bg-secondary rounded mx-3 w-25">
                            <a class="nav-link active text-dark mx-2 " aria-current="page" href="{{ route('posts.index') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-secondary" href="{{ route('profile', Auth::id()) }}">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-secondary" href="{{ route('posts.saved') }}">Saved Posts</a>
                        </li>
                @elseif ($location == 'profile')
                        <li class="nav-item ">
                            <a class="nav-link text-secondary" aria-current="page" href="{{ route('posts.index') }}">Home</a>
                        </li>
                        <li class="nav-item bg-secondary rounded mx-3 w-25">
                            <a class="nav-link active text-dark mx-2" href="{{ route('profile', Auth::id()) }}">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-secondary" href="{{ route('posts.saved') }}">Saved Posts</a>
                        </li>
                @elseif ($location == 'saved')
                    <li class="nav-item ">
                            <a class="nav-link  text-secondary" aria-current="page" href="{{ route('posts.index') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-secondary" href="{{ route('profile', Auth::id()) }}">Profile</a>
                        </li>
                        <li class="nav-item bg-secondary rounded mx-3 w-25">
                            <a class="nav-link active text-dark mx-2" href="{{ route('posts.saved') }}">Saved Posts</a>
                        </li>
                @else
                    <li class="nav-item ">
                            <a class="nav-link  text-secondary" aria-current="page" href="{{ route('posts.index') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-secondary" href="{{ route('profile', Auth::id()) }}">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-secondary" href="{{ route('posts.saved') }}">Saved Posts</a>
                        </li>
                @endif
                
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger w-2">logout</button>
                </form>
            </ul> 
            </div> 
            
            
            <form method="GET" action="{{ route('search') }}" class="d-flex w-50 mx-5 " role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search"/>
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        
       
</nav>



        <div class="container" >
            @yield('content')
        </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</html>