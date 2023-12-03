<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Prodi extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id_jurusan',
        'nama',
        'kode',
        'logo',
        'deskripsi',
        'akreditasi',
    ];

    public function Jurusan(): BelongsTo
    {
        return $this->belongsTo(Jurusan::class,'id_jurusan','id');
    }

    // public function BobotKriteria(): HasMany
    // {
    //     return $this->hasMany(BobotKriteria::class,"id_prodi","id");
    // }
    
}
