@props(['titlePage','page_ref'])

<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5"> 
            @if(isset($page_ref))
                @foreach($page_ref as $ref)
                    @if(isset($ref['params']))
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><a href="{{route($ref['route'],$ref['params'],false)}}">{{ $ref['title'] }}</a></li>
                    @else
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><a href="{{route($ref['route'])}}">{{ $ref['title'] }}</a></li>
                    @endif
                @endforeach
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><b>{{ $titlePage }}</b></li>
            @endif    
            </ol>
            
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
   
            </div>
            <form method="POST" action="{{ route('logout') }}" class="d-none" id="logout-form">
                @csrf
            </form>
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <a href="{{ route('user-profile') }}" class="nav-link text-body font-weight-bold px-0">
                        <i class="fa fa-user me-sm-1"></i>
                        <span class="d-sm-inline d-none">{{auth()->user()->name}}</span>
                    </a>
                </li>
                <li class="nav-item d-flex align-items-center ps-3">
                    <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                   
                        <span class="d-sm-inline d-none"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out me-sm-1"></i>
                        </span>
                    </a>
                </li>
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>
                <!-- <li class="nav-item px-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0">
                        <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                    </a>
                </li> -->
            </ul>
        </div>
    </div>
</nav>
