<x-layout bodyClass="">
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <x-navbars.navs.guest signup='register' signin='login' :list_jurusan="$list_jurusan"></x-navbars.navs.guest>
            </div>
        </div>
    </div>
    <main 
    style="background-image: url( {{ asset('assets') }}/img/background/pkm.jpg );background-repeat: no-repeat;
        background-attachment: fixed;"
    class="page-header min-vh-100">
    <span class="mask bg-gradient-dark opacity-6"></span>
    <div class="container-md" style="margin-top:100px">
            <div class="card card-body p-5 mb-5">
                {!! $jurusan['deskripsi'] !!}
            </div>
        </div>
    </main>
</x-layout>
