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
        <div class="container mb-5">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="display-6">#PoliteknikNegeriPadang</h2>
                            <h4 class="display-6 text-lg text-bold">Temukan Program Studi yang Mencerminkan Potensimu !</h4>
                            <p>Dapatkan pengalaman pendidikan terbaik di Politeknik Negeri Padang. Temukan program studi yang sesuai dengan minat dan bakatmu, karena masa depanmu dimulai di sini!</p>
                            <a href="#collapseForm" class="btn btn-primary" data-bs-toggle="collapse" href="#collapseForm">Mulai Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-12 mx-auto">
                    <div class="collapse mt-5" id="collapseForm">
                            <div class="card card-body">
                                <h6>Isi form dibawah dan segera ketahui Program Studi yang sesuai!</h6>
                                <x-perhitungan.form :list_kriteria="$list_kriteria"></x-perhitungan.form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
