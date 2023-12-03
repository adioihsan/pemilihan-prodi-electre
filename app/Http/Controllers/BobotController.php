<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBobotRequest;
use App\Http\Requests\UpdateBobotRequest;
use App\Models\Bobot;
use Illuminate\Support\Facades\DB;

class BobotController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_bobot = Bobot::paginate(10);
        $alert = session()->get("alert") ;
        return view("pages.bobot.index",compact('list_bobot','alert'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("pages.bobot.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $attributes = request()->validate([
            'tipe' => 'required|max:255|min:2',
            'nilai'=> 'required|integer',
            'keterangan'=>'required',
        ]);

        $bobot = Bobot::create($attributes);
        $alert = array("status"=>"success","title"=>"Berhasil","message"=>"Bobot berhasil ditambahkan");
        return redirect()->route("bobot")->with("alert",$alert);

    }

    /**
     * Display the specified resource.
     */
    public function show(Bobot $bobot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_bobot)
    {
        $bobot = Bobot::find($id_bobot);
        if($bobot){
            return view("pages.bobot.edit")->with('bobot',$bobot);
        }
        else{
            $alert = array("status"=>"warning","title"=>"Gagal megubah","message"=>"Bobot tidak tersedia");
            return redirect()->route("bobot")->with("alert",$alert);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id_bobot)
    {
        $attributes = request()->validate([
            'tipe' => 'required|max:255|min:2',
            'nilai'=> 'required|integer',
            'keterangan'=>'required',
        ]);

        $bobot = Bobot::where("id",$id_bobot)->update($attributes);
        $alert = array("status"=>"success","title"=>"Berhasil","message"=>"Bobot berhasil diperbarui");
        return redirect()->route("bobot")->with("alert",$alert);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id_bobot)
    {
        $bobot = Bobot::find($id_bobot);
        if($bobot){
            $bobot->delete();
            $alert = array("status"=>"info","title"=>"Telah Dihapus","message"=>"Bobot telah dihapus");
        }
        else{
            $alert = array("status"=>"warning","title"=>"Gagal Dihapus","message"=>"Bobot tidak tersedia");
        }

        return redirect()->route("bobot")->with("alert",$alert);
    }

    public function api_getAllTipe(){
        $list_tipe_bobot = Bobot::distinct()->get(['tipe']);
        return response()->json($list_tipe_bobot, 200);
    }

    public function api_getByTipe(string $tipe){
        $list_bobot = Bobot::where("tipe",$tipe)->orderBy("nilai","desc")->get();
        return response()->json($list_bobot, 200);
    }
}
