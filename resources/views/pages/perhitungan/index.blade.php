@php
        $alert = $alert ?? null;
        $page_ref = [];
@endphp
<x-layout bodyClass="g-sidenav-show  bg-gray-200" :alert="$alert">
    <x-navbars.sidebar activePage="riwayat_rekomendasi"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Riwayat Rekomendasi" :page_ref="$page_ref" ></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 ">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3"><strong>Riwayat Rekomendasi</strong> 
                            </div>
                        </div>
                        <div class=" me-3 my-3 text-end">
                            <a class="btn bg-gradient-dark mb-0" href="{{route('form-perhitungan')}}"><i
                                    class="material-icons text-sm">add</i>&nbsp;&nbsp;Lakukan Perhitungan Rekomendasi</a>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                            @if(isset($list_perhitungan) && $list_perhitungan->count() > 0)
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                PENGGUNA
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                NAMA
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                TANGGAL REKOMENDASI
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                REKOMENDASI PRODI
                                            </th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($list_perhitungan as $perhitungan)
                                        <tr>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="ms-3 text-sm">{{$perhitungan->user->name}}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="ms-2 text-sm">{{$perhitungan->nama}}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="ms-3 text-sm">{{$perhitungan->created_at}}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex py-1">
                                                        <div>
                                                            <img src="{{ asset('assets') }}/img/logos/prodi/{{$perhitungan->hasil_prodi['logo']}}"
                                                                class="avatar avatar-sm me-3 border-radius-lg"
                                                                alt="user1">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{$perhitungan->hasil_prodi['nama']}}</h6>
                                                            <p class="text-xs text-secondary mb-0">{{$perhitungan->hasil_prodi['kode']}}
                                                            </p>
                                                        </div>
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <a rel="tooltip" class="btn btn-success btn-link"
                                                    href="{{route('result-perhitungan',['id_perhitungan'=>$perhitungan->id],false)}}"
                                                    title="Lihat Hasil Perhitungan">
                                                    <i class="material-icons">visibility</i>
                                                    <div class="ripple-container"></div>
                                                </a>
                                                <a rel="tooltip" class="btn btn-danger btn-link"
                                                    href="{{route('delete-perhitungan',['id_perhitungan'=>$perhitungan->id],false)}}"
                                                    title="Hapus">
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
                                <h5>Belum ada perhitungan rekomendasi</h5>
                            </div>
                            @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            {{$list_perhitungan->links()}}
                        </div>
                    </div>
                   
                </div>
            </div>
            
        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>
