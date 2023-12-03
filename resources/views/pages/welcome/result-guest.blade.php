<x-layout bodyClass="">
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <x-navbars.navs.guest signup='register' signin='login' :list_jurusan="$list_jurusan"></x-navbars.navs.guest>
            </div>
        </div>
    </div>
    <div class="page-header min-vh-100"
         style="background-image: url( {{ asset('assets') }}/img/background/pkm.jpg );background-repeat: no-repeat;
        background-attachment: fixed;">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container-lg mb-5 mt-5">
            <x-perhitungan.result :perhitungan="$perhitungan"></x-perhitungan>
        </div>
    </div>
</x-layout>
