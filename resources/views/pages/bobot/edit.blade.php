@php
        $alert = $alert ?? null;
        $page_ref = [
            array("title"=>"Bobot","route"=>"bobot"),
        ];
@endphp
<x-layout bodyClass="g-sidenav-show bg-gray-200"  :alert="$alert">
    <x-navbars.sidebar activePage="Perbarui bobot"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Perbarui Bobot' :page_ref="$page_ref" ></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <!-- <div class="page-header min-height-300 border-radius-xl mt-4"
                style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
                <span class="mask  bg-gradient-primary  opacity-6"></span>
            </div> -->
            <div class="card card-body mx-3 mx-md-4 mt-6">
                <form method='POST' action='{{ route('edit-bobot',['id_bobot' => $bobot->id], false) }}' enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Tipe Bobot</label>
                                <input type="text" name="tipe" class="form-control border border-2 p-2"   value="{{ old('tipe') ?? $bobot->tipe }}" >
                                @error('tipe')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Nilai Bobot</label>
                                <input type="text" name="nilai" class="form-control border border-2 p-2"    value="{{ old('nilai') ?? $bobot->nilai }}"  >
                                @error('nilai')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Keterangan</label>
                                <input type="text" name="keterangan" class="form-control border border-2 p-2"   value="{{ old('keterangan') ?? $bobot->keterangan }}" >
                                @error('keterangan')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn bg-gradient-dark">Perbarui</button>
                </form>
            </div>
            
        </div>
    </div>
    <x-plugins></x-plugins>

</x-layout>
