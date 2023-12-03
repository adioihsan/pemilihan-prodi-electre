<?php

namespace App\Http\Controllers;

use App\Models\Perhitungan;
use App\Http\Requests\StorePerhitunganRequest;
use App\Http\Requests\UpdatePerhitunganRequest;
use App\Models\Kriteria;
use App\Models\BobotKriteria;
use App\Models\Jurusan;
use App\Models\Prodi;
use App\Models\Bobot;

class PerhitunganController extends Controller
{

    public function index()
    {
        if(auth()->user()->role == "admin"){
            $list_perhitungan = Perhitungan::select(["id","id_user","nama","created_at","hasil_prodi"])->orderby('created_at','desc')->paginate(10);
        }
        else{
            $id_user = auth()->user()->id;
            $list_perhitungan = Perhitungan::select(["id","id_user","nama","created_at","hasil_prodi"])->where("id_user",$id_user)->orderby('created_at','desc')->paginate(10);
        }
        $alert = session()->get("alert") ;
        foreach($list_perhitungan as $key => $perhitungan){
            $perhitungan->hasil_prodi = unserialize($perhitungan->hasil_prodi);
        }
        return view("pages.perhitungan.index",compact('list_perhitungan','alert'));
    }

    public function form(){
        $list_kriteria = Kriteria::all();
        return view("pages.perhitungan.form",compact('list_kriteria'));
    }

    public function spkElectre(){

        $bobot_prefrensi = request("bobot");
        $bobot_kriteria = BobotKriteria::all();

        $matrix_bobot_kriteria = $this->m_bobot_kriteria($bobot_kriteria);
        $matrix_normalisasi = $this->m_normalisasi($matrix_bobot_kriteria);
        $matrix_pembobotan_normalisasi = $this->m_pembobotan_normalisasi($matrix_bobot_kriteria,$matrix_normalisasi);

        $himpunan_concordance = $this->h_concordance($matrix_pembobotan_normalisasi);
        $matrix_concordance = $this->m_corcodance($bobot_prefrensi,$himpunan_concordance);

        $himpunan_discordance = $this->h_discordance($matrix_pembobotan_normalisasi);
        $matrix_discordance = $this->m_discordance($bobot_prefrensi,$himpunan_discordance);

        $matrix_dominasi_concordance = $this->m_dominasi_matrix($matrix_concordance);
        $matrix_dominasi_discordance = $this->m_dominasi_matrix($matrix_discordance);

        $matrix_dominasi_akhir = $this->m_dominasi_akhir($matrix_dominasi_concordance,$matrix_dominasi_discordance);

        $matrix_rank = $this->m_rank($matrix_dominasi_akhir);

        $hasil_kode_prodi = array_key_first($matrix_rank);

        // nama user
        $nama = request('nama') ?? "Guest";

        return $this->store(
            $nama,$bobot_prefrensi,$matrix_bobot_kriteria,$matrix_normalisasi,
            $matrix_pembobotan_normalisasi,$himpunan_concordance,$matrix_concordance,
            $himpunan_discordance,$matrix_discordance,$matrix_dominasi_concordance,
            $matrix_dominasi_discordance,$matrix_dominasi_akhir,$matrix_rank,$hasil_kode_prodi
        );
    }

    public function m_bobot_kriteria($bobot_kriteria){
        $matrix_bobot_kriteria = [];
        $list_prodi = [];
        foreach($bobot_kriteria as $bt){
             $matrix_bobot_kriteria[$bt->prodi->kode][$bt->kriteria->kode] = $bt->nilai;
             array_push($list_prodi,$bt->prodi->kode);
        }
        return $matrix_bobot_kriteria;
    }

    public function m_normalisasi($matrix_bobot_kriteria){
        $matrix_normalisasi = [];
        foreach($matrix_bobot_kriteria as $kode_prodi => $bobot_kriteria){
            $jumlah_bobot = array_sum($bobot_kriteria);
            foreach($bobot_kriteria as $kode_kriteria => $bobot){
                $matrix_normalisasi[$kode_prodi][$kode_kriteria] = sqrt($bobot/$jumlah_bobot);
            }
        }
        return ($matrix_normalisasi);
    }

    public function m_pembobotan_normalisasi($matrix_bobot_kriteria,$matrix_normalisasi){
        $matrix_pembobotan_normalisasi  = [];
        foreach($matrix_bobot_kriteria as $kode_prodi => $bobot_kriteria){
            foreach($bobot_kriteria as $kode_kriteria => $bobot){
                $nilai_normalisasi = $matrix_normalisasi[$kode_prodi][$kode_kriteria];
                $matrix_pembobotan_normalisasi[$kode_prodi][$kode_kriteria] = $bobot*$nilai_normalisasi;
            }
        }
        return  $matrix_pembobotan_normalisasi;
    }

    public function bandingkanBobot($kriteria_1, $kriteria_2, $matrix_bobot_kriteria,$jenis_matrix){
        $list_kriteria = [];
    
        foreach ($matrix_bobot_kriteria[$kriteria_1] as $kriteria => $bobot_kriteria_1) {
            $bobot_kriteria_2 = $matrix_bobot_kriteria[$kriteria_2][$kriteria];
    
            // tentukan kriterida concordance
            if($jenis_matrix == "concordance"){
                if ($bobot_kriteria_1 >= $bobot_kriteria_2) {
                    $list_kriteria[] = $kriteria;
                }
            // tentukan kriteria discordance 
            }else{
                if ($bobot_kriteria_1 < $bobot_kriteria_2) {
                    $list_kriteria[] = $kriteria;
                }
            }
        
        }
    
        return $list_kriteria;
    }
    
    public function h_concordance($matrix_bobot_kriteria){
        $list_kriteria = array_keys($matrix_bobot_kriteria);
        $himpunan_concordance = [];
    
        foreach ($list_kriteria as $kriteria_1) {
            foreach ($list_kriteria as $kriteria_2) {
                if ($kriteria_1 != $kriteria_2) {
                    $himpunan_concordance[$kriteria_1][$kriteria_2] = 
                    $this->bandingkanBobot($kriteria_1, $kriteria_2, $matrix_bobot_kriteria,"concordance");
                }
                else{
                    $himpunan_concordance[$kriteria_1][$kriteria_2] = [];
                }
            }
        }
        return $himpunan_concordance;
    }
    
    public function h_discordance($matrix_bobot_kriteria){
        $list_kriteria = array_keys($matrix_bobot_kriteria);
        $himpunan_discordance = [];
    
        foreach ($list_kriteria as $kriteria_1) {
            foreach ($list_kriteria as $kriteria_2) {
                if ($kriteria_1 != $kriteria_2) {
                    $himpunan_discordance[$kriteria_1][$kriteria_2] = 
                    $this->bandingkanBobot($kriteria_1, $kriteria_2, $matrix_bobot_kriteria,"discordance");
                }
                else{
                    $himpunan_discordance[$kriteria_1][$kriteria_2] = [];
                }
            }
        }
        return $himpunan_discordance;
    
    }


    public function m_corcodance($bobot_prefrensi,$himpunan_concordance){
        $matrix_concordance = [] ;

        foreach($himpunan_concordance as $kode_prodi_baris => $himpunan){
            foreach($himpunan as $kode_prodi_kolom  => $concordance ){
                // $matrix_concordance[$id]
                $nilai_concordance = [];
                foreach($concordance as $id_kriteria){
                    array_push($nilai_concordance,$bobot_prefrensi[$id_kriteria]);
                }
                $matrix_concordance[$kode_prodi_baris][$kode_prodi_kolom] = array_sum($nilai_concordance);
            }
        }
        return $matrix_concordance;
    }

    public function m_discordance($bobot_prefrensi,$himpunan_discordance){
        $matrix_discordance = [] ;

        foreach($himpunan_discordance as $kode_prodi_baris => $himpunan){
            foreach($himpunan as $kode_prodi_kolom  => $discordance ){
                // $matrix_concordance[$id]
                $nilai_discordance = [];
                foreach($discordance as $id_kriteria){
                    array_push($nilai_discordance,$bobot_prefrensi[$id_kriteria]);
                }
                $matrix_discordance[$kode_prodi_baris][$kode_prodi_kolom] = array_sum($nilai_discordance);
            }
        }
        return $matrix_discordance;
    }

    public function m_dominasi_matrix($matrix){
        $matrix_dominasi = [];
        foreach($matrix as $kode_prodi => $nilai_prodi){
            $matrix_dominasi[$kode_prodi] = array_sum($nilai_prodi);
        }
        return $matrix_dominasi;
    }

    public function m_dominasi_akhir($matrix_dominasi_concordance,$matrix_dominasi_discordance){
        $matrix_dominasi_akhir = [];
        foreach($matrix_dominasi_concordance as $kode_prodi =>$nilai_concordance){
            $nilai_discordance = $matrix_dominasi_discordance[$kode_prodi];
            $matrix_dominasi_akhir[$kode_prodi] = $nilai_concordance - $nilai_discordance;
        }
        return $matrix_dominasi_akhir;
    }

    public function m_rank($matrix_dominasi_akhir){
        $matrix_rank = $matrix_dominasi_akhir;
        arsort($matrix_rank);
        $rank = 1;
        foreach($matrix_rank as $key => $mr){
            $matrix_rank[$key] = ["nilai"=>$mr ,"peringkat"=> $rank];
            $rank++;
        }
        return $matrix_rank;
    }

    // simpan hasil spk
    public function store(
        $nama,$bobot_prefrensi,$matrix_bobot_kriteria,$matrix_normalisasi,
        $matrix_pembobotan_normalisasi,$himpunan_concordance,$matrix_concordance,
        $himpunan_discordance,$matrix_discordance,$matrix_dominasi_concordance,
        $matrix_dominasi_discordance,$matrix_dominasi_akhir,$matrix_rank,$hasil_kode_prodi
        ){
        $data_perhitungan = [];

        // simpan id user
        $id_user = auth()->id() ?? 1;
        $data_perhitungan["id_user"] = $id_user;
        $data_perhitungan['nama'] = $nama;

        // simpan matrix
        $data_perhitungan["bobot_prefrensi"] = serialize($bobot_prefrensi);
        $data_perhitungan["matrix_bobot_kriteria"] = serialize($matrix_bobot_kriteria);
        $data_perhitungan["matrix_normalisasi"] = serialize($matrix_normalisasi);
        $data_perhitungan["matrix_pembobotan_normalisasi"] = serialize($matrix_pembobotan_normalisasi);
        $data_perhitungan["himpunan_concordance"] = serialize($himpunan_concordance);
        $data_perhitungan["matrix_concordance"] = serialize($matrix_concordance);
        $data_perhitungan["himpunan_discordance"] = serialize($himpunan_discordance);
        $data_perhitungan["matrix_discordance"] = serialize($matrix_discordance);
        $data_perhitungan["matrix_dominasi_concordance"] = serialize($matrix_dominasi_concordance);
        $data_perhitungan["matrix_dominasi_discordance"] = serialize($matrix_dominasi_discordance);
        $data_perhitungan["matrix_dominasi_akhir"] = serialize($matrix_dominasi_akhir);
        $data_perhitungan["matrix_rank"] = serialize($matrix_rank);
        // 

        // simpan data lengkap prodi dan jurusan hasil pilihan spk
        $data_perhitungan["hasil_kode_prodi"] = $hasil_kode_prodi;

        $hasil_prodi = Prodi::where("kode",$hasil_kode_prodi)->first();
        $data_perhitungan["hasil_prodi"] = serialize($hasil_prodi->toarray());

        $hasil_jurusan = $hasil_prodi->jurusan;
        $data_perhitungan["hasil_jurusan"] = serialize($hasil_jurusan->toarray());

        // 

        // simpan data prodi saat perhitungan dilakukan
        $semua_prodi_db = Prodi::select(["kode","id_jurusan","nama"])->get();
        $semua_prodi = [];
        foreach($semua_prodi_db as $prodi){
            $semua_prodi[$prodi->kode] = ["nama"=>$prodi->nama,"id_jurusan"=>$prodi->id_jurusan]; 
        }
        $data_perhitungan["data_prodi"] = serialize($semua_prodi);
        // 
        
        // simpan data jurusan saat perhitungan dilakukan
        $semua_jurusan_db = Jurusan::select(["id","kode","nama"])->get();
        $semua_jurusan = [];
        foreach($semua_jurusan_db as $jurusan){
            $semua_jurusan[$jurusan->id] = ["kode"=>$jurusan->kode,"nama"=>$jurusan->nama];
        }
        $data_perhitungan["data_jurusan"] = serialize($semua_jurusan);
        // 

        // simpan data kriteria saat perhitungan dilakukan
        $semua_kriteria_db = Kriteria::select(["id","kode","nama"])->get();
        $semua_kriteria = [];
        foreach($semua_kriteria_db as $kriteria){
            $semua_kriteria[$kriteria->kode] = ["id"=>$kriteria["id"],"nama"=>$kriteria->nama];
        }
        $data_perhitungan["data_kriteria"] = serialize($semua_kriteria);

        $perhitungan = Perhitungan::create($data_perhitungan);
        $id_perhitungan = $perhitungan["id"];
       
        return to_route('result-perhitungan', ["id_perhitungan"=>$id_perhitungan]);

    }

    public function result(string $id_perhitungan){
        $perhitungan = Perhitungan::select("id","created_at","id_user","nama","hasil_prodi","hasil_jurusan","matrix_rank")->where("id",$id_perhitungan)->first();
        $perhitungan->hasil_prodi = unserialize($perhitungan->hasil_prodi);
        $perhitungan->hasil_jurusan = unserialize($perhitungan->hasil_jurusan);
        $perhitungan->matrix_rank = unserialize($perhitungan->matrix_rank);
        
        if($perhitungan['id_user'] != 1){
            return view("pages.perhitungan.result")->with("perhitungan",$perhitungan);
        }
        else{
         $list_jurusan = Jurusan::select('id','nama','kode')->get();
            return view("pages.welcome.result-guest")->with("perhitungan",$perhitungan)
            ->with("list_jurusan",$list_jurusan);
        }
    }

    public function result_detail(string $id_perhitungan){
        $perhitungan = Perhitungan::where("id",$id_perhitungan)->first();

        $perhitungan["bobot_prefrensi"] = unserialize($perhitungan['bobot_prefrensi']);
        $perhitungan["matrix_bobot_kriteria"] = unserialize($perhitungan['matrix_bobot_kriteria']);
        $perhitungan["matrix_normalisasi"] = unserialize($perhitungan['matrix_normalisasi']);
        $perhitungan["matrix_pembobotan_normalisasi"] = unserialize($perhitungan['matrix_pembobotan_normalisasi']);
        $perhitungan["himpunan_concordance"] = unserialize($perhitungan['himpunan_concordance']);
        $perhitungan["matrix_concordance"] = unserialize($perhitungan['matrix_concordance']);
        $perhitungan["himpunan_discordance"] = unserialize($perhitungan['himpunan_discordance']);
        $perhitungan["matrix_discordance"] = unserialize($perhitungan['matrix_discordance']);
        $perhitungan["matrix_dominasi_concordance"] = unserialize($perhitungan['matrix_dominasi_concordance']);
        $perhitungan["matrix_dominasi_discordance"] = unserialize($perhitungan['matrix_dominasi_discordance']);
        $perhitungan["matrix_dominasi_akhir"] = unserialize($perhitungan['matrix_dominasi_akhir']);
        $perhitungan["matrix_rank"] = unserialize($perhitungan['matrix_rank']);
        $perhitungan["hasil_prodi"] = unserialize($perhitungan['hasil_prodi']);
        $perhitungan["hasil_jurusan"] = unserialize($perhitungan['hasil_jurusan']);
        $perhitungan["data_prodi"] = unserialize($perhitungan['data_prodi']);
        $perhitungan["data_jurusan"] = unserialize($perhitungan['data_jurusan']);
        $perhitungan["data_kriteria"] = unserialize($perhitungan['data_kriteria']);

        return view("pages.perhitungan.result-detail")->with("perhitungan",$perhitungan);
    }

    public function delete(string $id_perhitungan){
        $perhitungan = Perhitungan::find($id_perhitungan);
        if($perhitungan){
            $perhitungan->delete();
            $alert = array("status"=>"info","title"=>"Telah Dihapus","message"=>"Rekomendasi telah dihapus");
        }
        else{
            $alert = array("status"=>"warning","title"=>"Gagal Dihapus","message"=>"Perhitungan Rekomendasi tidak tersedia");
        }

        return redirect()->route("perhitungan")->with("alert",$alert);
    }

}
