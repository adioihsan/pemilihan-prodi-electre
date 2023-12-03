<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurusan;
use App\Models\Prodi;
use App\Models\Kriteria;
use App\Models\BobotKriteria;

class ProdiController extends Controller
{
    public function index(){
        $list_prodi = Prodi::paginate(10);
        $alert = session()->get("alert") ;
        return view("pages.prodi.index",compact('list_prodi','alert'));
    }

    public function create(){
        $list_jurusan = Jurusan::all();
        return view("pages.prodi.create")->with('list_jurusan',$list_jurusan);
    }

    public function show(string $id_prodi){
        $list_jurusan = Jurusan::select('id','nama','kode')->get();
        $prodi = Prodi::find($id_prodi);
        return view("pages.prodi.show",compact('list_jurusan','prodi'));
    }

    public function edit(string $id_prodi){
        $prodi = Prodi::find($id_prodi);
        $list_jurusan = Jurusan::all();
        if($prodi){
            return view("pages.prodi.edit",compact('prodi','list_jurusan'));
        }
        else{
            $alert = array("status"=>"warning","title"=>"Gagal megubah","message"=>"Prodi tidak tersedia");
            return redirect()->route("prodi")->with("alert",$alert);
        }
    }
    public function store(){

        $attributes = request()->validate([
            'id_jurusan'=>'required',
            'nama' => 'required|max:255|min:5',
            'kode'=> 'required|unique:prodis|max:10|min:2',
            'deskripsi'=>'required|min:10',
            'akreditasi'=>'required'
        ]);

        if(request()->file('logo')){
            $file= request()->file('logo');
            $filename= str_replace(' ', '_', $attributes["nama"]).".".$file->getClientOriginalExtension();
            $file-> move(public_path('assets/img/logos/prodi'), $filename);
            $attributes["logo"] = $filename;
        }
        else{
            $attributes["logo"] = "Politeknik_Negeri_Padang.png";
        }
        $prodi = Prodi::create($attributes);

        // tambahkan bobot default (2) untuk prodi;
        $id_prodi = $prodi["id"];
        $list_kriteria = Kriteria::all();
        foreach($list_kriteria as $kriteria){
            $bobot = [
                "id_kriteria"=>$kriteria->id,
                "id_prodi"=>$id_prodi,
                "nilai"=>2,
            ];
            BobotKriteria::create($bobot);
        }

        $alert = array("status"=>"success","title"=>"Berhasil","message"=>"Program studi berhasil ditambahkan");
        return redirect()->route("prodi")->with("alert",$alert);
    }

    public function update(string $id_prodi){
        $attributes = request()->validate([
            'id_jurusan'=>'required',
            'nama' => 'required|max:255|min:5',
            'kode'=> 'required|max:10|min:2|unique:prodis,kode,'.$id_prodi,
            'deskripsi'=>'required|min:10',
            'akreditasi'=>'required',
        ]);

        if(request()->file('logo')){
            $file= request()->file('logo');
            $filename= str_replace(' ', '_', $attributes["nama"]).".".$file->getClientOriginalExtension();
            $file-> move(public_path('assets/img/logos/prodi'), $filename);
            $attributes["logo"] = $filename;
        }

        $prodi = Prodi::where('id',$id_prodi)->update($attributes);

        $alert = array("status"=>"success","title"=>"Berhasil","message"=>"Program studi berhasil diperbarui");
        return redirect()->route("prodi")->with("alert",$alert);
    }
    public function delete(string $id_prodi){
        $prodi = Prodi::find($id_prodi);
        if($prodi){
            $prodi->delete();
            $alert = array("status"=>"info","title"=>"Telah Dihapus","message"=>"Program studi telah dihapus");
        }
        else{
            $alert = array("status"=>"warning","title"=>"Gagal Dihapus","message"=>"Program studi tidak tersedia");
        }

        return redirect()->route("prodi")->with("alert",$alert);
    }
}
