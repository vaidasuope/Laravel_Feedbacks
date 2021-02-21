<nav class="navbar navbar-expand-lg navbar-light fixed-top pt-2 pb-2 background" id="mainNav">
    <div class="container">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>

        <a class="navbar-brand" href="/">Customer Reviews</a>
        @if(Auth::check())
            <p class="nav-brand pt-3 ml-5" disabled>Hello <span class="text-capitalize">{{Auth::user()->name}}!</span></p>
        @endif


        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                {{--                <li class="nav-item">--}}
                {{--                    <a class="nav-link" href="/">Home</a>--}}
                {{--                </li>--}}
                @if(Auth::check())

                    <li class="nav-item">
                        <a class="nav-link" href="/add-service">Add Service</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="/logout">Logout</a></li>
                @else
                    <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="/register">Register</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
