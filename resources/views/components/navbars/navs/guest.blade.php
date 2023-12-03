@props(['signin', 'signup','list_jurusan'])
<nav
    class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-1 py-2 start-0 end-0 mx-4">
    <div class="ps-2 pe-0" style="display:flex;flex:1">
        <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 d-flex flex-column" href="{{ route('welcome') }}">
            <span>Rekomendasi Program Studi PNP</span>
        </a>
        <div class="flex-fill"></div>
        <div id="navigation">
            <ul class="navbar-nav">
                <li class="dropdown">
                    <a class="nav-link me-2 dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-graduation-cap opacity-6 text-dark me-1"></i>
                            Jurusan
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @foreach($list_jurusan as $jurusan)
                            <li><a class="dropdown-item" href="{{route('show-jurusan',['id_jurusan'=>$jurusan->id],false)}}">{{$jurusan->nama}}</a></li>
                        @endforeach
                    </ul>
                </li>
                @if(auth()->user())
                <li class="nav-item">
                    <a class="nav-link me-2" href="{{ route('dashboard') }}">
                        <i class="fas fa-house opacity-6 text-dark me-1"></i>
                        Dashboard
                    </a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link me-2" href="{{ route($signup) }}">
                        <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                        Daftar
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="{{ route($signin) }}">
                        <i class="fas fa-key opacity-6 text-dark me-1"></i>
                        Login
                    </a>
                </li>
                @endif
            </ul>
        </div>

    </div>
</nav>
