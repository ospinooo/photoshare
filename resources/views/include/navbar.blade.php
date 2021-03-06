
<script src="{{ asset('js/search.js')}}"></script>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand mb-0 h1" href="/">
        <img src="{{ asset('img/logo.jpeg') }}" alt="Logo" style="width:30px;">
    </a>

    <a class="navbar-brand mb-0 h1" href="/">{{config('app.name', 'Photoshare')}}</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

            <li class="nav-item">
                <a class="nav-link" href="/posts">Posts</a>
            </li>

            @if (Auth::check())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Actions
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="/posts/create">Create Post</a>
                    </div>
                </li>
            @endif
        </ul>

        <form class="form-inline my-2 my-lg-0" autocomplete="off">

            <li class="nav-item dropdown">
                <input class="nav-link form-control mr-sm-2 dropdown-toggle" id="search"  placeholder="Search" data-toggle="dropdown" aria-label="Search" >
                {{-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> --}}
                <div class="dropdown-menu" id="search-dropdown" aria-labelledby="navbarDropdownMenuLink">
                </div>
            </li>
            {{-- Appear only when the user is not logged --}}
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                        @if (Auth::user()->admin)
                          <a class="dropdown-item" href="/admin">
                            {{ __('Administration') }}
                          </a>
                        @endif

                        <a class="dropdown-item" href="{{ route('logout') }}">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </form>
    </div>
</nav>
