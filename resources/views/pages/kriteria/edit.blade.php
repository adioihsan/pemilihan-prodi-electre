@php
        $alert = $alert ?? null;
        $page_ref = [
            array("title"=>"Kriteria","route"=>"kriteria"),
        ];
@endphp
<x-layout bodyClass="g-sidenav-show bg-gray-200"  :alert="$alert">
    <x-navbars.sidebar activePage="Kriteria"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Perbarui Kriteria' :page_ref="$page_ref" ></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <!-- <div class="page-header min-height-300 border-radius-xl mt-4"
                style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
                <span class="mask  bg-gradient-primary  opacity-6"></span>
            </div> -->
            <div class="card card-body mx-3 mx-md-4 mt-6">
                <h6>Data Kriteria</h6>
                <form method='POST' action='{{ route('edit-kriteria',['id_kriteria' => $kriteria->id], false) }}' enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Nama Kriteria</label>
                                <input type="text" name="nama" class="form-control border border-2 p-2"   value="{{ old('nama') ?? $kriteria->nama }}">
                                @error('nama')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Kode Kriteria</label>
                                <input type="text" name="kode" class="form-control border border-2 p-2" value="{{ old('kode') ?? $kriteria->kode }}">
                                @error('kode')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Tipe Bobot</label>
                                <select class="form-control border border-2 p-2" name="tipe_bobot" id="tipe-bobot" >
                                    @foreach($list_tipe_bobot as $bobot)
                                        <option value="{{$bobot->tipe}}" @selected($bobot->tipe == $kriteria->tipe_bobot) >{{$bobot->tipe}}</option>
                                    @endforeach
                                </select>
                                @error('bobot')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                        <hr>
                        <h6>Bobot Kriteria Terhadap Program Studi</h6>
        
                        @foreach($list_prodi as $prodi)
                        <div class="mb-3 col-12">
                                <label class="form-label">{{$prodi->nama}}</label>
                                @php
                                    $id_prodi_col = array_column($bobot_kriteria->toArray(), 'id_prodi');
                                    $prodi_index = array_search($prodi->id,$id_prodi_col);
                                @endphp
                                <select class="form-control border border-2 p-2 select-bobot" name="bobot[{{$prodi->id}}]">
                                @foreach($list_bobot as $bobot)
                                        <option value="{{$bobot->nilai}}" @selected($bobot->nilai == $bobot_kriteria[$prodi_index]->nilai)>{{$bobot->keterangan}}</option>
                                @endforeach
                                </select>
                                @error('bobot')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                        </div>
                        @endforeach
                        <hr>
                        <h6>Pertanyaan</h6>
                        <div class="row">
                            <div class="mb-3 col-12">
                                <label class="form-label">Pertanyaan untuk kriteria</label>
                                <textarea class="form-control border border-2 p-2" name="pertanyaan" rows="5" placeholder="Tulis pertanyaan ...." spellcheck="false" required>{{ old('pertanyaan') ?? $kriteria->pertanyaan }}</textarea>
                                @error('pertanyaan')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                            </div>
                            <div class="mb-3 col-12">
                                <label class="form-label">Tipe Bobot Pertanyaan</label>
                                <select class="form-control border border-2 p-2" name="tipe_bobot_pertanyaan" id="tipe_bobot_pertanyaan">
                                    @foreach($list_tipe_bobot as $bobot)
                                        <option value="{{$bobot->tipe}}" @selected($bobot->tipe == $kriteria->tipe_bobot_pertanyaan)>{{$bobot->tipe}}</option>
                                    @endforeach
                                </select>
                                @error('bobot')
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
@push('js')
<script type="text/javascript">
    const tipeBobotEl = document.getElementById("tipe-bobot");

    // axios.get(`/api/bobot/getAllTipe`).then((res)=>{
    //     const list_tipe_bobot = res.data;
    //     list_tipe_bobot.forEach((item)=>{
    //         let newOption = document.createElement("option");
    //         newOption.value = item.tipe
    //         newOption.innerText = item.tipe;
    //         tipeBobotEl.appendChild(newOption)
    //     })

    //     const event = new Event('change');
    //     tipeBobotEl.dispatchEvent(event)

    // }).catch((err)=>{
    //     console.log(err)
    // })

    function loadBobot(event){
        const selectedTipe = event.target.value;
        console.log("value",selectedTipe)
        axios.get(`/api/bobot/getByTipe/${selectedTipe}`).then((res)=>{
            const list_bobot = res.data;
            const selectBobotEls = document.querySelectorAll('.select-bobot')
            selectBobotEls.forEach((bobotEls)=>{
                bobotEls.innerHTML = ""
                let optionBobot = list_bobot.map((bobot)=>{
                    let newOption = document.createElement("option");
                    newOption.value = bobot.nilai;
                    newOption.innerText = bobot.keterangan;
                    return newOption;
                })
                bobotEls.append(...optionBobot)
            })
        }).catch((err)=>{
            console.log(err)
        })
    }

    tipeBobotEl.addEventListener("change",loadBobot)

    // const event = new Event('change');
    // tipeBobotEl.dispatchEvent(event)
</script>
@endpush
</x-layout>
