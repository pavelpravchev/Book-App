<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Book App</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <div class="col-sm-6">
                <ul class="navbar-nav">
                    @if (count($navigationItems) > 0)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                Settings
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                @foreach($navigationItems as $ni)
                                    <li><a class="dropdown-item" href="{{ route($ni['route']) }}">{{ $ni['title'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
            @if (!is_null(Auth::user()))
                <div class="col-sm-4 offset-sm-4">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('userProfile.edit') }}">My Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}">Lgout</a>
                        </li>
                    </ul>
                    </li>
                    </ul>
                </div>
            @endif
        </div>
    </div>
</nav>
