<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;
use App\Models\Jurusan;

class WelcomeController extends Controller
{
    public function index()
    {
        $list_kriteria = Kriteria::all();
        $list_jurusan = Jurusan::select('id','nama','kode')->get();
        return view('pages.welcome.index',compact('list_kriteria','list_jurusan'));
    }
}
