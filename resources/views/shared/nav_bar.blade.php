<nav class="container navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('home')}}">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    @auth
                        @if(auth()->user()->hasRole('admin'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('users.index')}}">Users</a>
                            </li>
                        @endif
                    @endauth
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('clients.index')}}">Clients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('annonces.index')}}" tabindex="-1" aria-disabled="true">Annonces</a>
                    </li>
                </ul>
            </div>

        </div>

        @auth
            <div class="d-flex">
                <span>{{auth()->user()->name . ': ' . Auth::user()->getRoleNames()->first()}}</span>
                <form action="{{route('auth.logout')}}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">Logout</button>
                </form>
            </div>
        @endauth

        @guest
            <a class="nav-link" href="{{route('auth')}}">Authentication</a>
        @endguest
    </div>
</nav>
