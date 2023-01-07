<!DOCTYPE html>
<html>
<head>
    <title>At Events</title>
<!--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

</head>
<body>
    <nav class="navbar navbar-light navbar-expand-lg mb-5" style="background-color: #e3f2fd;">
        <div class="container">
            <a class="navbar-brand mr-auto" href="#"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register-user') }}">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('eventslist') }}"> Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('events.status') }}"> Events Status</a>
                    </li>
                    @else                    
                    <li class="nav-item">                    
                        Hello,  {{ auth()->user()->email }}
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('eventslist') }}"> Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('events.status') }}"> Events Status</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('events') }}">Manage Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('invites') }}">Invites</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('signout') }}">Logout</a>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
</body>
</html>