@props(['perhitungan'])
<div>
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
                        href="{{route('detail-perhitungan',['id_perhitungan'=>$perhitungan->id],false)}}">
                        <div class="ripple-container">
                            <i class="material-icons">read_more</i>
                            Detail
                        </div>
                    </a>
                    <a class="btn btn-secondary btn-link"href="{{$perhitungan->hasil_jurusan['website']}}"target="_blank">
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
        <div class="col-md-12 mt-4">
            <div class="card mb-3">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">Tentang Program Studi</h6>
                </div>
                <div class="card-body pt-4 p-3 overflow-hidden">
                    {!! $perhitungan->hasil_prodi['deskripsi'] !!}
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header pb-0 px-3 overflow-hidden">
                    <h6 class="mb-0">Tentang Jurusan</h6>
                </div>
                <div class="card-body pt-4 p-3 overflow-hidden">
                     {!! $perhitungan->hasil_jurusan['deskripsi'] !!}
                </div>
            </div>
        </div>
    </div>
</div>