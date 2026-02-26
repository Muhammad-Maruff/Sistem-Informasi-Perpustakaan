<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rental Buku | @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="shortcut icon" href="{{ asset('img/logo-buku.png') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  </head>

  <body>
    <div class="main d-flex flex-column justify-content-between">
        {{-- navbar --}}
        <nav class="navbar navbar-expand-lg navbar-dark bg-info shadow-sm">
            <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('img/logo-buku.png') }}" alt="" width="60" height="60">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            @if(Auth::user())
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-weight: bold">
                       
                        {{ auth()->user()->username }}
                       
                    </a>
                    <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/logout"><i class="bi bi-box-arrow-right" style="font-size: 20px"></i>  Logout</a></li>
                    </ul>
                </li>
                </ul>
            </div>
            @else
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/login" role="button" aria-expanded="false" style="font-weight: bold">
                        Login
                    </a>
                </li>
                </ul>
            </div>
            @endif
        </div>
        </nav>
      {{-- end navbar  --}}
        
        {{-- sidebar  --}}
        <div class="body-content h-100">
            <div class="row g-0 h-100">
                <div class="sidebar col-lg-2 collapse d-lg-block" id="navbarNav">
                    <ul>@auth
                        @if (Auth::user()->role_id == 1)
                        <a href="/dashboard" @if (request()->route()->uri == 'dashboard')
                            class="active"
                        @endif>Dashboard</a>

                        <a href="/users" @if (request()->route()->uri == 'users' || request()->route()->uri == 'user-banned' || request()->route()->uri == 'registered-users' || request()->route()->uri == 'user-detail/{slug}' || request()->route()->uri == 'user-ban/{slug}')
                            class="active"
                        @endif>User</a>

                        <a href="/book-rent" @if (request()->route()->uri == 'book-rent' )
                            class="active"
                        @endif>Book Rent</a>

                        <a href="/book-return" @if (request()->route()->uri == 'book-return' )
                            class="active"
                        @endif>Book Return</a>

                        <a href="/rent-logs" @if (request()->route()->uri == 'rent-logs')
                            class="active"
                        @endif>Rent Log</a>

                        <a href="/categories" @if (request()->route()->uri == 'categories' || request()->route()->uri =='category-add' || request()->route()->uri =='category-delete/{slug}' || request()->route()->uri =='category-edit/{slug}')
                            class="active"
                        @endif>Category</a>

                        <a href="/books" @if (request()->route()->uri == 'books' || request()->route()->uri =='book-add' || request()->route()->uri =='book-delete/{slug}' ||request()->route()->uri == 'book-edit/{slug}')
                            class="active"
                        @endif>Book</a>
                        @endif
                        
                        @if (Auth::user()->role_id == 2)
                        <a href="/profile" @if (request()->route()->uri == 'profile')
                            class="active"
                        @endif>Profile</a>
                        @endif
                        <a href="/" @if (request()->route()->uri == '/')
                            class="active"
                        @endif>Book List</a>
                        @endauth

                    </ul>
                </div>
            {{-- end sidebar  --}}

            {{-- content  --}}
            <div class="content p-5 col-lg-10">
                @yield('content')
            </div>
            {{-- end content  --}}
        </div>
      </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>