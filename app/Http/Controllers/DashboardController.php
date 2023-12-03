<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurusan;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    
    public function index()
    {
        $total_jurusan = DB::select('select count(id) as total from jurusans')[0];
        $total_prodi = DB::select('select count(id) as total from prodis')[0];

        $id_user = auth()->user()->id;
        $total_rekomendasi = auth()->user()->role == "admin" ?
            DB::select('select count(id) as total from perhitungans')[0] :
            DB::select("select count(id) as total from perhitungans where id_user = $id_user")[0] ;
        $total_user = DB::select('select count(id) as total from users')[0];
        
        $trk_rekomendasi = DB::select('select created_at as tanggal from perhitungans order by created_at desc limit 1')[0] ?? False;
        $kode_prodi = DB::select('select kode from prodis order by kode');
        $total_rek_prodi = DB::select('select count(perhitungans.id) as total from prodis left join perhitungans on prodis.kode = perhitungans.hasil_kode_prodi group by kode order by kode');
        return view('dashboard.index',compact('total_jurusan','total_prodi','total_rekomendasi','total_user','trk_rekomendasi','kode_prodi','total_rek_prodi'));
    }

}
