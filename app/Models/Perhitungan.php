<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Perhitungan extends Model
{
    use HasFactory;
    
    protected $fillable = [
    'id_user',
    'nama','bobot_prefrensi','matrix_bobot_kriteria','matrix_normalisasi',
    'matrix_pembobotan_normalisasi','himpunan_concordance','matrix_concordance',
    'himpunan_discordance','matrix_discordance','matrix_dominasi_concordance',
    'matrix_dominasi_discordance','matrix_dominasi_akhir','matrix_rank',
    'hasil_kode_prodi','hasil_prodi','hasil_jurusan',
    'data_jurusan','data_prodi','data_kriteria',
   ];

   public function User(): BelongsTo
   {
       return $this->belongsTo(User::class,'id_user','id');
   }

}
