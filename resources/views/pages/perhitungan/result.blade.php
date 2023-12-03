@php
        $alert = $alert ?? null;
        $page_ref = [
            array("title"=>"Riwayat Rekomendasi","route"=>"perhitungan"),
        ];
@endphp
<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="riwayat_rekomendasi"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Hasil Rekomendasi" :page_ref="$page_ref"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <x-perhitungan.result :perhitungan="$perhitungan"></x-perhitungan.result>
        </div>
        
    </main>
    <x-plugins></x-plugins>

</x-layout>
