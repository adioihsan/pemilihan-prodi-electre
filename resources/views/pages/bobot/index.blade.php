@php
        $alert = $alert ?? null;
        $page_ref = [];
@endphp
<x-layout bodyClass="g-sidenav-show  bg-gray-200" :alert="$alert">
    <x-navbars.sidebar activePage="bobot"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Bobot" :page_ref="$page_ref" ></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 ">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3"><strong>Bobot</strong> 
                            </div>
                        </div>
                        <div class=" me-3 my-3 text-end">
                            <a class="btn bg-gradient-dark mb-0" href="{{route('create-bobot')}}"><i
                                    class="material-icons text-sm">add</i>&nbsp;&nbsp;Tambah Bobot</a>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                            @if(isset($list_bobot) && $list_bobot->count() > 0)
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-4">
                                                Tipe</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-2">
                                                Keterangan</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-2">
                                                Nilai</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                TERAKHIR DIUBAH
                                            </th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                           
                                        @foreach($list_bobot as $bobot)
                                        <tr>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center  ps-3">
                                                    <h6 class="mb-0 text-sm">{{$bobot->tipe}}</h6>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center  ">
                                                    <h6 class="mb-0 text-sm">{{$bobot->keterangan}}</h6>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center  ">
                                                    <h6 class="mb-0 text-sm">{{$bobot->nilai}}</h6>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $bobot->updated_at->diffForHumans() }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <a rel="tooltip" class="btn btn-success btn-link"
                                                    href="{{route('edit-bobot',['id_bobot' => $bobot->id], false)}}"
                                                    title="">
                                                    <i class="material-icons">edit</i>
                                                    <div class="ripple-container"></div>
                                                </a>
                                                <a rel="tooltip" class="btn btn-danger btn-link"
                                                    href="{{route('delete-bobot',['id_bobot' => $bobot->id], false)}}"
                                                    title="">
                                                    <i class="material-icons">close</i>
                                                    <div class="ripple-container"></div>
                                                </a>
                                            </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                            <div class="d-flex m-3 justify-content-center">
                                <h5>Belum ada bobot</h3>
                            </div>
                            @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            {{$list_bobot->links()}}
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>
