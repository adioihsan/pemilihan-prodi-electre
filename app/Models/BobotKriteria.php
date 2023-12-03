<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BobotKriteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_kriteria',
        'id_prodi',
        'nilai',
    ];

    public function Prodi(): BelongsTo
    {
        return $this->belongsTo(Prodi::class,'id_prodi','id');
    }
    public function Kriteria(): BelongsTo
    {
        return $this->belongsTo(Kriteria::class,'id_kriteria','id');
    }
}
