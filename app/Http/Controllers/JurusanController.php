<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Jurusan;

class JurusanController extends Controller
{
    public function index(){
        $list_jurusan = Jurusan::paginate(10);
        $alert = session()->get("alert") ;
        return view("pages.jurusan.index",compact('list_jurusan','alert'));
    }
    public function create(){
        return view("pages.jurusan.create");
    }
    public function show(string $id_jurusan){
        $list_jurusan = Jurusan::select('id','nama','kode')->get();
        $jurusan = Jurusan::find($id_jurusan);
        return view("pages.jurusan.show",compact('list_jurusan','jurusan'));
    }
    public function edit(string $id_jurusan){
        $jurusan = Jurusan::find($id_jurusan);
        if($jurusan){
            return view("pages.jurusan.edit")->with('jurusan',$jurusan);
        }
        else{
            $alert = array("status"=>"warning","title"=>"Gagal megubah","message"=>"Jurusan tidak tersedia");
            return redirect()->route("jurusan")->with("alert",$alert);
        }
    }
    public function store(){
        
        $attributes = request()->validate([
            'nama' => 'required|max:255|min:5',
            'kode'=> 'required|unique:jurusans|max:10|min:2',
            'website'=> 'required|active_url|min:3',
            'deskripsi'=>'required|min:10'
        ]);

        if(request()->file('logo')){
            $file= request()->file('logo');
            $filename= str_replace(' ', '_', $attributes["nama"]).".".$file->getClientOriginalExtension();
            $file-> move(public_path('assets/img/logos/jurusan'), $filename);
            $attributes["logo"] = $filename;
        }
        else{
            $attributes["logo"] = "Politeknik_Negeri_Padang.png";
        }
        $jurusan = Jurusan::create($attributes);
        $alert = array("status"=>"success","title"=>"Berhasil","message"=>"Jurusan berhasil ditambahkan");
        return redirect()->route("jurusan")->with("alert",$alert);
    }
    public function update(string $id_jurusan){
        $attributes = request()->validate([
            'nama' => 'required|max:255|min:5',
            'kode'=> 'required|max:10|min:2|unique:jurusans,kode,'.$id_jurusan,
            'website'=> 'required|active_url|min:3',
            'deskripsi'=>'required|min:10'
        ]);

        if(request()->file('logo')){
            $file= request()->file('logo');
            $filename= str_replace(' ', '_', $attributes["nama"]).".".$file->getClientOriginalExtension();
            $file-> move(public_path('assets/img/logos/jurusan'), $filename);
            $attributes["logo"] = $filename;
        }

        $jurusan = Jurusan::where('id',$id_jurusan)->update($attributes);

        $alert = array("status"=>"success","title"=>"Berhasil","message"=>"Jurusan berhasil diperbarui");
        return redirect()->route("jurusan")->with("alert",$alert);
    }
    public function delete(string $id_jurusan){
        $jurusan = Jurusan::find($id_jurusan);
        if($jurusan){
            $jurusan->delete();
            $alert = array("status"=>"info","title"=>"Telah Dihapus","message"=>"Jurusan telah dihapus");
        }
        else{
            $alert = array("status"=>"warning","title"=>"Gagal Dihapus","message"=>"Jurusan tidak tersedia");
        }

        return redirect()->route("jurusan")->with("alert",$alert);
    }
}
