@php
        $alert = $alert ?? null;
        $page_ref = [
            array("title"=>"Prodi","route"=>"prodi"),
        ];
@endphp
<x-layout bodyClass="g-sidenav-show bg-gray-200"  :alert="$alert">
    <x-navbars.sidebar activePage="Prodi"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Tambah Program Studi' :page_ref="$page_ref" ></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="card card-body mx-3 mx-md-4 mt-6">
                <form method='POST' action='{{ route('edit-prodi',['id_prodi'=>$prodi->id],false) }}' enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-12">
                                <label class="form-label">Jurusan</label>
                                <select class="form-control border border-2 p-2" name="id_jurusan">
                                    @foreach($list_jurusan as $jurusan)
                                    <option value="{{ $jurusan->id }}" @selected($jurusan->id == $prodi->id_jurusan)> {{ $jurusan->nama}} - ({{$jurusan->kode}}) </option>
                                    @endforeach
                                </select>
                                @error('id_jurusan')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Nama Program Studi</label>
                                <input type="text" name="nama" class="form-control border border-2 p-2"    value="{{ old('nama') ?? $prodi->nama }}" >
                                @error('nama')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Kode Prodi</label>
                                <input type="text" name="kode" class="form-control border border-2 p-2"  value="{{ old('kode') ?? $prodi->kode }}">
                                @error('kode')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Akreditasi</label>
                                <select class="form-control border border-2 p-2" name="akreditasi">
                                  <option value="A / Unggul" @selected($prodi->akreditasi == 'A / Unggul' )>A / Unggul</option>
                                  <option value="B / Baik Sekali" @selected($prodi->akreditasi == 'B / Baik Sekali' )>B / Baik Sekali</option>
                                  <option value="C / Baik" @selected($prodi->akreditasi == 'C / Baik' )>C / Baik</option>
                                  <option value="- / Proses Akreditasi" @selected($prodi->akreditasi == '- / Proses Akreditasi' )> - / Proses Akreditasi</option>
                                </select>
                                @error('akreditasi')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-12">
                                <label class="form-label">Deskripsi</label>
                                <textarea class="form-control border border-2 p-2" name="deskripsi" id="text-editor"  rows="5" placeholder="Say a few words about who you are or what you're working on." spellcheck="false" >{{ old('deskripsi') ??  $prodi->deskripsi }}</textarea>
                                @error('deskripsi')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-12">
                                <label class="form-label">Logo Prodi</label>
                                <input type="file" name="logo"  class="form-control border border-2 p-2" accept="image/png, image/jpeg" value="{{ old('logo') }}">
                            </div>
                        </div>
                        
                        <button type="submit" class="btn bg-gradient-dark">Perbarui</button>
                </form>
            </div>
            
        </div>
    </div>
    <x-plugins></x-plugins>

</x-layout>
