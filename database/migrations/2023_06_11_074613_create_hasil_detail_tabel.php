<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_detail_tabel', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hasil_id');
            $table->foreign('hasil_id')->references('id')->on('hasil_tabel')->cascadeOnDelete();
            $table->unsignedBigInteger('alternatif_id');
            $table->foreign('alternatif_id')->references('id')->on('alternatif')->cascadeOnDelete();
            $table->float('nilai_total');
            $table->integer('rangking');
            $table->integer('besar_pinjaman');
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hasil_detail_tabel');
    }
};
