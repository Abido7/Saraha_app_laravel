<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset("css/style.css")}}">
    @yield('addition-stylies')
    <title>@yield('title')</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
        <div class="container-fluid mx-3">
            <a class="navbar-brand text-uppercase" href="{{url('/saraha')}}">Saraha</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav float-right ms-auto">
                
                @guest
                    
                    <li class="nav-item mx-2">
                        <a class="nav-link btn btn-outline-primary" aria-current="page" href="{{url('/register')}}">Register</a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-primary" aria-current="page" href="{{url('/login')}}">Login</a>
                    </li>
                    
                @endguest


                @auth
                    
                    <li class="nav-item">
                        <div class="d-flex flex-row align-items-center justify-content-center">
                            <a href="{{url("profile/".auth()->user()->id)}}">@yield('pro')</a>
                            <a class="nav-link btn btn-outline-danger" aria-current="page" href="{{url('/logout')}}">logout</a>
                        </div>
                    </li>

                @endauth

            </ul>
            </div>
        </div>
    </nav>

    <div class="container my-3">
        @yield('content')
    </div>
    @yield('addition-scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>