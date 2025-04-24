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
        Schema::create('rental', function (Blueprint $table) {
            $table->id('id_rental');
            $table->unsignedBigInteger('id_mahasiswa')->index();
            $table->unsignedBigInteger('kategori_id')->index(); //indexing untuk fk
            $table->integer('total_pinjam');
            $table->date('tgl_pinjam');
            $table->date('tgl_kembali');
            $table->timestamps();

            $table->foreign('kategori_id')->references('kategori_id')->on('kategori_sepeda');
            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('data_mahasiswa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental');
    }
};
