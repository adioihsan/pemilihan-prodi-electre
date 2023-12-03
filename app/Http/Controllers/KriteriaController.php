<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKriteriaRequest;
use App\Http\Requests\UpdateKriteriaRequest;
use App\Models\Kriteria;
use App\Models\BobotKriteria;
use App\Models\Prodi;
use App\Models\Bobot;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_kriteria = Kriteria::paginate(10);
        $alert = session()->get("alert") ;
        return view("pages.kriteria.index",compact('list_kriteria','alert'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list_prodi = Prodi::all();
        $list_tipe_bobot = Bobot::distinct()->get(['tipe']);
        return view("pages.kriteria.create",compact('list_prodi','list_tipe_bobot'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $attributes = request()->validate([
            'nama' => 'required|max:255|min:5',
            'kode'=> 'required|max:10|min:2|unique:kriterias',
            'pertanyaan'=>'required|min:5',
            'tipe_bobot'=>'required',
            'tipe_bobot_pertanyaan'=>'required'
        ]);
        $kriteria = Kriteria::create($attributes);
        $id_kriteria = $kriteria["id"];
        $bobots = request('bobot');
        foreach($bobots as $id_prodi => $nilai){
            $bobot = [
            "id_kriteria"=>$id_kriteria,
            "id_prodi"=>$id_prodi,
            "nilai"=>$nilai,
        ];
            BobotKriteria::create($bobot);
        }
        
        $alert = array("status"=>"success","title"=>"Berhasil","message"=>"Kriteria berhasil ditambahkan");
        return redirect()->route("kriteria")->with("alert",$alert);

    }
    /**
     * Display the specified resource.
     */
    public function show(Kriteria $kriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_kriteria)
    {
        $kriteria = Kriteria::find($id_kriteria);
        if($kriteria){
            $list_prodi = Prodi::all();
            $list_tipe_bobot = Bobot::distinct()->get(['tipe']);
            $list_bobot = Bobot::where("tipe",$kriteria['tipe_bobot'])->orderBy("nilai","desc")->get();
            $bobot_kriteria = BobotKriteria::where("id_kriteria",$kriteria["id"])->get();
            
            return view("pages.kriteria.edit",compact('kriteria','list_prodi','list_tipe_bobot','list_bobot','bobot_kriteria'));
        }
        else{
            $alert = array("status"=>"warning","title"=>"Gagal megubah","message"=>"Kriteria tidak tersedia");
            return redirect()->route("kriteria")->with("alert",$alert);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id_kriteria)
    {
        $attributes = request()->validate([
            'nama' => 'required|max:255|min:5',
            'kode'=> 'required|max:10|min:2|unique:kriterias,kode,'.$id_kriteria,
            'pertanyaan'=>'required|min:5',
            'tipe_bobot'=>'required',
            'tipe_bobot_pertanyaan'=>'required'
        ]);
        $kriteria = Kriteria::where("id",$id_kriteria)->update($attributes);
        
        $bobots = request('bobot');
        try {
            foreach($bobots as $id_prodi => $nilai){
                BobotKriteria::where("id_prodi",$id_prodi)->where("id_kriteria",$id_kriteria)->delete();
                $bobot = [
                    "id_kriteria"=>$id_kriteria,
                    "id_prodi"=>$id_prodi,
                    "nilai"=>$nilai,
                ];
                BobotKriteria::create($bobot);
            }       
            $alert = array("status"=>"success","title"=>"Berhasil","message"=>"Kriteria berhasil diperbarui");
            return redirect()->route("kriteria")->with("alert",$alert);
        } catch (\Throwable $th) {
            dd($th);
            $alert = array("status"=>"danger","title"=>"Gagal","message"=>"Terjadi kesalahan. Kriteria gagal diperbarui");
            return redirect()->route("kriteria")->with("alert",$alert);
        }

        

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id_kriteria)
    {
        $kriteria = Kriteria::find($id_kriteria);
        if($kriteria){
            $kriteria->delete();
            $alert = array("status"=>"info","title"=>"Telah Dihapus","message"=>"Kriteria telah dihapus");
        }
        else{
            $alert = array("status"=>"warning","title"=>"Gagal Dihapus","message"=>"Kriteria tidak tersedia");
        }

        return redirect()->route("kriteria")->with("alert",$alert);
    }
}
