@props(['list_kriteria'])

<div class="progress my-2">
  <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 10%"></div>
</div>

<form id="mainForm" method='POST' action='{{ route('spk-perhitungan') }}'  enctype="multipart/form-data">
    @csrf
    <div class="row " id="form-umum" active>
        <h2 class="h5">Pertanyaan umum</h2>
        <p>Jawab beberapa pertanyaan berikut dan segera ketahui program studi yang cocok dengan mu</p>
        <div class="mb-3 col-12">
            <label class="form-label text-md mb-2">Siapa nama mu ?</label>
            <input type="text" class="form-control border border-2 p-2 " name="nama" value="{{auth()->user()->name ?? '' }}"/>
        </div>
        @foreach($list_kriteria as $kriteria)
        @if($kriteria->tipe_bobot_pertanyaan != "Penilaian")
        <div class="mb-3 col-12">
            <label class="form-label text-md mb-2">{{$kriteria->pertanyaan}}</label>
            <select class="form-control border border-2 p-2 select-nilai" name="bobot[{{$kriteria->kode}}]" data-tipe="{{$kriteria->tipe_bobot_pertanyaan}}" >
            </select>
        </div>
        @endif
        @endforeach
    </div>

    <div class="row d-none" id="form-nilai">
        <h2 class="h5">Nilai rata-rata mata pelajaran</h2>
        <p>Masukan nilai rata-rata mata pelajaran mu dalam rentang 0-100 pada form dibawah.</p>
        @foreach($list_kriteria as $kriteria)
        @if($kriteria->tipe_bobot_pertanyaan == "Penilaian")
        <div class="mb-3 col-12 d-flex">
            <label class="form-label text-md mb-2 w-50 flex-wrap">{{$kriteria->pertanyaan}}</label>
            <select class="form-control border border-2 p-2 select-nilai" name="bobot[{{$kriteria->kode}}]" data-tipe="{{$kriteria->tipe_bobot_pertanyaan}}" >
            </select>
        </div>
        
        @endif
        @endforeach
    </div>

    <div class="text-center mt-2">
        <button class="btn bg-gradient-dark" id="btnForm">Selanjutnya</button>
    </div>   
 
</form>


@push('js')
<script type="text/javascript">
    const nilaiEl = document.querySelectorAll('.select-nilai');
    const mainFormEl = document.querySelector("#mainForm");
    const allFormEl = document.querySelectorAll('[id^="form-"]')
    const btnFormEl =  document.querySelector("#btnForm");
    const progressBarEl = document.querySelector(".progress-bar");

    function loadBobot(tipe,selectEl){
        const selectedTipe = tipe
        axios.get(`/api/bobot/getByTipe/${selectedTipe}`).then((res)=>{
            const list_bobot = res.data;
                let optionBobot = list_bobot.map((bobot)=>{
                    let newOption = document.createElement("option");
                    newOption.value = bobot.nilai;
                    newOption.innerText = bobot.keterangan;
                    return newOption;
                })
                selectEl.append(...optionBobot)
        }).catch((err)=>{
            console.log(err)
        })
    }
    nilaiEl.forEach((el)=>{
        const tipe = el.dataset.tipe;
        loadBobot(tipe,el)
    })

    function activateForm(event){
        event.preventDefault()
        let nextFormIndex = 0
        const activeForm = allFormEl.forEach((el,index)=>{
          if(el.hasAttribute("active"))   {
            nextFormIndex = index+1
            el.classList.add("d-none")
            el.removeAttribute("active")
        }
        })

        const nextForm = allFormEl[nextFormIndex]
        if(nextForm){
            nextForm.setAttribute("active",'')
            nextForm.classList.remove("d-none")
            const isLastForm = allFormEl[nextFormIndex+1] ? false : true;
            if(isLastForm){
                btnFormEl.innerText = "Ketahui Sekarang !"
            }
            progressBarEl.style.width = `${(nextFormIndex+1)/allFormEl.length * 90}%`
        }   
        else{
            mainFormEl.submit();
        } 
    };

    btnFormEl.addEventListener("click",activateForm)

</script>
@endpush
