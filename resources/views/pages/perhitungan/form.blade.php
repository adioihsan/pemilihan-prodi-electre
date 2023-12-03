@php
        $alert = $alert ?? null;
        $page_ref = [
            array("title"=>"Riwayat Rekomendasi","route"=>"perhitungan"),
        ];
@endphp
<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="form-rekomendasi" ></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Profile' :page_ref="$page_ref"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                style="background-image: url( {{ asset('assets') }}/img/background/pkm2.jpg )">
                <span class="mask  bg-gradient-primary  opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <!-- <h6>Isi form dibawah untuk mendapatkan rekomendasi program studi</h6> -->
                <x-perhitungan.form :list_kriteria="$list_kriteria"></x-perhitungan.form>
            </div>
        </div>
        
    </div>
    <x-plugins></x-plugins>
</x-layout>