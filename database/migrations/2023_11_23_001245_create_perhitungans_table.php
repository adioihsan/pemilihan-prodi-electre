<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

     
    public function up(): void
    {
        Schema::create('perhitungans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->string('nama');

            $table->text("bobot_prefrensi");              
            $table->text("matrix_bobot_kriteria");  
            $table->text("matrix_normalisasi");  
            $table->text("matrix_pembobotan_normalisasi");  
            $table->text("himpunan_concordance");  
            $table->text("matrix_concordance");
            $table->text("himpunan_discordance");  
            $table->text("matrix_discordance");
            $table->text("matrix_dominasi_concordance");  
            $table->text("matrix_dominasi_discordance"); 
            $table->text("matrix_dominasi_akhir"); 
            $table->text("matrix_rank");

            $table->string("hasil_kode_prodi");
            $table->text("hasil_prodi");
            $table->text("hasil_jurusan");

            $table->mediumText("data_jurusan");
            $table->mediumText("data_prodi");
            $table->mediumText("data_kriteria");

            $table->timestamps();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perhitungans');
    }
};
