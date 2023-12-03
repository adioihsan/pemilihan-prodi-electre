@php
        $alert = $alert ?? null;
        $page_ref = [
            array("title"=>"Riwayat Rekomendasi","route"=>"perhitungan"),
            array("title"=>"Hasil Rekomendasi","route"=> "result-perhitungan","params"=>['id_perhitungan'=>$perhitungan->id])
        ];
@endphp
<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="riwayat_rekomendasi"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Detail Perhitungan Rekomendasi" :page_ref="$page_ref"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-md-9">
                    <div class="card mt-4">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-6">
                                    <h6 class="mb-0">Rekomendasi Program Studi</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="d-flex text-center justify-content-center align-items-center">
                                <img src="{{ asset('assets') }}/img/logos/prodi/{{$perhitungan->hasil_prodi['logo']}}"
                                    class="avatar avatar-md me-3 border-radius-lg"
                                    alt="logo_prodi">
                                <p class="text-lg text-bold text-success mb-0">{{$perhitungan->hasil_prodi['nama']}}</p>
                            </div>
                        </div>
                        <div class="card-footer pb-1 d-flex justify-content-between">
                            <p class="text-xs mb-1">{{$perhitungan->nama}}</p>
                            <p class="text-xs text-bold">{{$perhitungan->created_at}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mt-4">
                        <div class="card-body d-grid p-3">
                            <a class="btn btn-primary btn-link"
                                href="{{route('result-perhitungan',['id_perhitungan'=>$perhitungan->id],false)}}">
                                <div class="ripple-container">
                                    <i class="material-icons">keyboard_return</i>
                                    Hasil
                                </div>
                            </a>
                            <a class="btn btn-secondary btn-link"href="https://www.pnp.ac.id"target="_blank">
                                <div class="ripple-container">
                                    <i class="material-icons">language</i>
                                    Website Jurusan
                                </div>
                            </a>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-23 mt-4">
                    <div class="card">
                        <div class="card-header pb-0 px-3">
                            <h6 class="mb-0">Input Pengguna</h6>
                        </div>
                        <div class="card-body pt-4 p-3">
                            <div>
                                <hr>
                                <p class="text-dark text-sm">Bobot Prefrensi</p>
                                <table class="table table-bordered table-sm text-xs">
                                    <thead>
                                        <tr>
                                            <td>Kode Kriteria</td>
                                            @foreach($perhitungan->bobot_prefrensi as $kode_kriteria => $bp)
                                                <td>{{$kode_kriteria}}</td>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Nama Kriteria</td>
                                            @foreach($perhitungan->bobot_prefrensi as $kode_kriteria => $bp)
                                                <td>{{$perhitungan->data_kriteria[$kode_kriteria]['nama']}}</td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <td>Bobot Preferensi</td>
                                        @foreach($perhitungan->bobot_prefrensi as $kode_kriteria => $bp)
                                                <td>{{$bp}}</td>
                                        @endforeach
                                        </tr>
      
                                    </tbody>
                                </table>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-23 mt-4">
                    <div class="card">
                        <div class="card-header pb-0 px-3">
                            <h6 class="mb-0">Alternatif Program Studi</h6>
                        </div>
                        <div class="card-body pt-4 p-3">
                            <div>
                                <hr>
                                <p class="text-dark text-sm">Program Studi</p>
                                <table class="table table-bordered table-sm text-xs">
                                    <thead>
                                        <tr>
                                            <td>Kode</td>
                                            <td>Nama</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($perhitungan->data_prodi as $kode_prodi=> $prodi)
                                        <tr>
                                            <td>{{$kode_prodi}}</td>
                                            <td>{{$prodi['nama']}}</td>
                                        </tr>    
                                        @endforeach
                                    </tbody>
                                </table>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-4">
                    <div class="card">
                        <div class="card-header pb-0 px-3">
                            <h6 class="mb-0">Perhitungan Metode Electre</h6>
                        </div>
                        <div class="card-body pt-4 p-3">
                            <div>
                                <hr>
                                <p class="text-dark text-sm">Matrix Bobot Kriteria</p>
                                <table class="table table-bordered table-sm text-xs">
                                    <thead>
                                        <tr>
                                            <td>Alternatif</td>
                                            @foreach($perhitungan->matrix_bobot_kriteria[array_key_first($perhitungan->matrix_bobot_kriteria)] as $kode_kriteria => $bobot)
                                                <td>{{$kode_kriteria}}</td>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($perhitungan->matrix_bobot_kriteria as $kode_kriteria => $mbk)
                                        <tr>
                                            <td>{{$kode_kriteria}}</td>
                                            @foreach($mbk as $bobot)
                                                <td style="border:1px solid black">{{$bobot}}</td>
                                            @endforeach
                                        <tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <hr>
                            </div>
                            <div>
                                <p class="text-dark text-sm">Matrix Normalisasi Bobot Kriteria</p>
                                <table class="table table-bordered table-sm text-xs">
                                    <thead>
                                        <tr>
                                            <td>Alternatif</td>
                                            @foreach($perhitungan->matrix_normalisasi[array_key_first($perhitungan->matrix_normalisasi)] as $kode_kriteria => $bobot)
                                                <td>{{$kode_kriteria}}</td>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($perhitungan->matrix_normalisasi as $kode_kriteria => $mbk)
                                        <tr>
                                            <td>{{$kode_kriteria}}</td>
                                            @foreach($mbk as $bobot)
                                                <td style="border:1px solid black">{{number_format($bobot,2)}}</td>
                                            @endforeach
                                        <tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <hr>
                            </div>
                            <div>
                                <p class="text-dark text-sm">Matrix Pembobotan Ternormalisasi</p>
                                <table class="table table-bordered table-sm text-xs">
                                    <thead>
                                        <tr>
                                            <td>Alternatif</td>
                                            @foreach($perhitungan->matrix_pembobotan_normalisasi[array_key_first($perhitungan->matrix_pembobotan_normalisasi)] as $kode_kriteria => $bobot)
                                                <td>{{$kode_kriteria}}</td>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($perhitungan->matrix_pembobotan_normalisasi as $kode_kriteria => $mbk)
                                        <tr>
                                            <td>{{$kode_kriteria}}</td>
                                            @foreach($mbk as $bobot)
                                                <td style="border:1px solid black">{{number_format($bobot,2)}}</td>
                                            @endforeach
                                        <tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <hr>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="text-dark text-sm">Himpunan Concordance</p>
                                    <table class="table table-sm text-xs">
                                        <thead>
                                            <tr>
                                                <td>Alternatif</td>
                                                <td>Kriteria</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($perhitungan-> himpunan_concordance as $kode_prodi_1 => $hp_p)
                                                @foreach($hp_p as $kode_prodi_2 => $hp_c)
                                                    @if(count($hp_c) > 0)
                                                    <tr>
                                                        <td>{{$kode_prodi_1}} >= {{$kode_prodi_2}} </td>
                                                        <td>
                                                            {
                                                            @foreach($hp_c as $kode_kriteria)
                                                                {{$kode_kriteria}},
                                                            @endforeach
                                                            }
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endforeach                   
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-dark text-sm">Himpunan Discordance</p>
                                    <table class="table table-sm text-xs">
                                        <thead>
                                            <tr>
                                                <td>Alternatif</td>
                                                <td>Kriteria</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($perhitungan-> himpunan_discordance as $kode_prodi_1 => $hp_p)
                                                @foreach($hp_p as $kode_prodi_2 => $hp_c)
                                                    @if(count($hp_c) > 0)
                                                    <tr>
                                                        <td>{{$kode_prodi_1}} < {{$kode_prodi_2}} </td>
                                                        <td>
                                                            {
                                                            @foreach($hp_c as $kode_kriteria)
                                                                {{$kode_kriteria}},
                                                            @endforeach
                                                            }
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endforeach                   
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div>
                                <p class="text-dark text-sm">Matrix Concordance</p>
                                <table class="table table-bordered table-sm text-xs">
                                    <thead>
                                        <tr>
                                            <td>Alternatif</td>
                                            @foreach($perhitungan->data_prodi as $kode_prodi => $prodi)
                                                <td>
                                                    {{$kode_prodi}}
                                                </td>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($perhitungan->data_prodi as $kode_prodi_1 => $prodi)
                                        <tr>
                                            <td>{{$kode_prodi_1}}</td>
                                            @foreach($perhitungan->matrix_concordance[$kode_prodi_1] as $kode_prodi_2 => $concordance)
                                                @if($kode_prodi_1 !== $kode_prodi_2)
                                                    <td>{{$concordance}}</td>
                                                @else
                                                    <td>-</td>
                                                @endif
                                            @endforeach
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <hr>
                            </div>
                            <div>
                                <p class="text-dark text-sm">Matrix Discordance</p>
                                <table class="table table-bordered table-sm text-xs">
                                    <thead>
                                        <tr>
                                            <td>Alternatif</td>
                                            @foreach($perhitungan->data_prodi as $kode_prodi => $prodi)
                                                <td>
                                                    {{$kode_prodi}}
                                                </td>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($perhitungan->data_prodi as $kode_prodi_1 => $prodi)
                                        <tr>
                                            <td>{{$kode_prodi_1}}</td>
                                            @foreach($perhitungan->matrix_discordance[$kode_prodi_1] as $kode_prodi_2 => $concordance)
                                                @if($kode_prodi_1 !== $kode_prodi_2)
                                                    <td>{{$concordance}}</td>
                                                @else
                                                    <td>-</td>
                                                @endif
                                            @endforeach
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <hr>
                            </div>
                            <div>
                                <hr>
                                <p class="text-dark text-sm">Dominasi Concordance</p>
                                <table class="table table-bordered table-sm text-xs">
                                    <thead>
                                        <tr>
                                            <td>Alternatif</td>
                                            <td>Perhitungan Nilai Dominasi</td>
                                            <td>Nilai Dominasi</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($perhitungan->matrix_dominasi_concordance as $kode_prodi_1 => $nilai_dominasi)
                                        <tr>
                                            <td>{{$kode_prodi_1}}</td>
                                            <td>
                                                @foreach($perhitungan->matrix_concordance[$kode_prodi_1] as $kode_prodi_2 => $nilai_c)
                                                    @if($kode_prodi_1 !==  $kode_prodi_2)
                                                        <span>{{$nilai_c}}</span>
                                                        @if($kode_prodi_2 != array_key_last($perhitungan->matrix_concordance[$kode_prodi_1]))
                                                        <span>+</span>
                                                        @endif
                                                    @endif    
                                                @endforeach
                                            </td>
                                            <td>{{$nilai_dominasi}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <hr>
                            </div>
                            <div>
                                <hr>
                                <p class="text-dark text-sm">Dominasi Discordance</p>
                                <table class="table table-bordered table-sm text-xs">
                                    <thead>
                                        <tr>
                                            <td>Alternatif</td>
                                            <td>Perhitungan Nilai Dominasi</td>
                                            <td>Nilai Dominasi</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($perhitungan->matrix_dominasi_discordance as $kode_prodi_1 => $nilai_dominasi)
                                        <tr>
                                            <td>{{$kode_prodi_1}}</td>
                                            <td>
                                                @foreach($perhitungan->matrix_discordance[$kode_prodi_1] as $kode_prodi_2 => $nilai_c)
                                                    @if($kode_prodi_1 !==  $kode_prodi_2)
                                                        <span>{{$nilai_c}}</span>
                                                        @if($kode_prodi_2 != array_key_last($perhitungan->matrix_discordance[$kode_prodi_1]))
                                                        <span>+</span>
                                                        @endif
                                                    @endif    
                                                @endforeach
                                            </td>
                                            <td>{{$nilai_dominasi}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <hr>
                            </div>
                            <div>
                                <hr>
                                <p class="text-dark text-sm">Dominasi Akhir</p>
                                <table class="table table-bordered table-sm text-xs">
                                    <thead>
                                        <tr>
                                            <td>Alternatif</td>
                                            <td>Nilai Dominasi</td>
                                            <td>Peringkat</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($perhitungan->matrix_dominasi_akhir as $kode_prodi => $nilai_dominasi)
                                        <tr>
                                            <td>{{$kode_prodi}}</td>
                                            <td>{{$nilai_dominasi}}</td>
                                            <td>{{$perhitungan->matrix_rank[$kode_prodi]['peringkat']}}
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <hr>
                            </div>
                            <div>
                                <hr>
                                <p class="text-dark text-sm">Peringkat Dominasi</p>
                                <table class="table table-bordered table-sm text-xs">
                                    <thead>
                                        <tr>
                                            <td>Alternatif</td>
                                            <td>Nilai Dominasi</td>
                                            <td>Peringkat</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($perhitungan->matrix_rank as $kode_prodi => $dominasi)
                                        <tr>
                                            <td>{{$kode_prodi}}</td>
                                            <td>{{$dominasi['nilai']}}</td>
                                            <td>{{$dominasi['peringkat']}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-23 mt-4">
                    <div class="card">
                        <div class="card-header pb-0 px-3">
                            <h6 class="mb-0">Rekomendasi Prodi Berdasarkan Perhitungan</h6>
                        </div>
                        <div class="card-body pt-4 p-3">
                        <div>
                            <table class="table table-bordered table-sm text-xs">
                                <thead>
                                    <tr>
                                        <td>Peringkat</td>
                                        <td>Kode Prodi</td>
                                        <td>Nama Prodi</td>
                                        <td>Jurusan</td>
                                        <td>Nilai Dominasi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($perhitungan->matrix_rank as $kode_prodi => $dominasi)
                                    <tr @if($kode_prodi == array_key_first($perhitungan->matrix_rank)) class="text-success text-bold" @endif >
                                        <td>{{$dominasi['peringkat']}}</td>
                                        <td>{{$kode_prodi}}</td>
                                        <td>{{$perhitungan->data_prodi[$kode_prodi]['nama'] }}</td>
                                        <td>{{$perhitungan->data_jurusan[$perhitungan->data_prodi[$kode_prodi]['id_jurusan']]['nama'] }}</td>
                                        <td>{{$dominasi['nilai']}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>
