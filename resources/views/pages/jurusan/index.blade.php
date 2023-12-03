@php
        $alert = $alert ?? null;
        $page_ref = [];
@endphp
<x-layout bodyClass="g-sidenav-show  bg-gray-200" :alert="$alert">
    <x-navbars.sidebar activePage="Jurusan"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Jurusan" :page_ref="$page_ref" ></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 ">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3"><strong>Data Jurusan</strong> 
                            </div>
                        </div>
                        @if(auth()->user()->role == "admin")
                        <div class=" me-3 my-3 text-end">
                            <a class="btn bg-gradient-dark mb-0" href="{{route('create-jurusan')}}"><i
                                    class="material-icons text-sm">add</i>&nbsp;&nbsp;Tambah Jurusan</a>
                        </div>
                        @endif
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                            @if(isset($list_jurusan) && $list_jurusan->count() > 0)
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                KODE
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                LOGO</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                NAMA</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                TERAKHIR DIUBAH
                                            </th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($list_jurusan as $jurusan)
                                        <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <p class="ms-2 text-sm">{{$jurusan->kode}}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ asset('assets') }}/img/logos/jurusan/{{$jurusan->logo}}"
                                                            class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$jurusan->nama}}</h6>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $jurusan->updated_at->diffForHumans() }}</span>
                                            </td>
                                            @if(auth()->user()->role == "admin")
                                            <td class="align-middle">
                                                <a rel="tooltip" class="btn btn-success btn-link"
                                                    href="{{route('edit-jurusan',['id_jurusan' => $jurusan->id], false)}}"
                                                    title="">
                                                    <i class="material-icons">edit</i>
                                                    <div class="ripple-container"></div>
                                                </a>
                                                <a class="btn btn-info btn-link"
                                                    href="{{route('show-jurusan',['id_jurusan' => $jurusan->id], false)}}"
                                                    target="_blank"
                                                    >
                                                    <i class="material-icons">visibility</i>
                                                    <div class="ripple-container"></div>
                                                </a>
                                                <a rel="tooltip" class="btn btn-danger btn-link"
                                                    href="{{route('delete-jurusan',['id_jurusan' => $jurusan->id], false)}}"
                                                    title="">
                                                    <i class="material-icons">close</i>
                                                    <div class="ripple-container"></div>
                                                </a>
                                            </td>
                                            @else
                                            <td class="align-middle">
                                                <a class="btn btn-info btn-link"
                                                        href="{{route('show-jurusan',['id_jurusan' => $jurusan->id], false)}}"
                                                        target="_blank"
                                                        >
                                                        <i class="material-icons">visibility</i>
                                                        <div class="ripple-container"></div>
                                                    </a>    
                                            </td>
                                            @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                            <div class="d-flex m-3 justify-content-center">
                                <h5>Belum ada jurusan</h3>
                            </div>
                            @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            {{$list_jurusan->links()}}
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </main>

</x-layout>
