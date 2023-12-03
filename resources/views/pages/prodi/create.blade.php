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
            <!-- <div class="page-header min-height-300 border-radius-xl mt-4"
                style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
                <span class="mask  bg-gradient-primary  opacity-6"></span>
            </div> -->
            <div class="card card-body mx-3 mx-md-4 mt-6">
                <form method='POST' action='{{ route('create-prodi') }}' enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-12">
                                <label class="form-label">Jurusan</label>
                                <select class="form-control border border-2 p-2" name="id_jurusan">
                                    @foreach($list_jurusan as $jurusan)
                                    <option value="{{ $jurusan->id }}">{{$jurusan->kode}} - {{ $jurusan->nama}}</option>
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
                                <input type="text" name="nama" class="form-control border border-2 p-2"   value="{{ old('nama') }}">
                                @error('nama')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Kode Prodi</label>
                                <input type="text" name="kode" class="form-control border border-2 p-2" value="{{ old('kode') }}">
                                @error('kode')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Akreditasi</label>
                                <select class="form-control border border-2 p-2" name="akreditasi">
                                  <option value="A / Unggul">A / Unggul</option>
                                  <option value="B / Baik Sekali">B / Baik Sekali</option>
                                  <option value="C / Baik">C / Baik</option>
                                  <option value="- / Proses Akreditasi"> - / Proses Akreditasi</option>
                                </select>
                                @error('akreditasi')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-12">
                                <label class="form-label">Deskripsi</label>
                                <textarea class="form-control border border-2 p-2" name="deskripsi" id="text-editor"  rows="5" placeholder="Tulis deskripsi tentang program studi" spellcheck="false" >{{ old('deskripsi') }}</textarea>
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
                        
                        <button type="submit" class="btn bg-gradient-dark">Tambahkan</button>
                </form>
            </div>
            
        </div>
    <x-plugins></x-plugins>

</x-layout>
