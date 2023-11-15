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
        Schema::create('alternatif', function (Blueprint $table) {
            $table->id();
            $table->string('no_anggota');
            $table->string('nama_anggota');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            // $table->string('pekerjaan')->nullable();
            // $table->string('penghasilan')->nullable();
            $table->integer('besar_pinjaman');
            $table->string('alamat');
            $table->string('keperluan');
            $table->integer('is_checked')->nullable();
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
        Schema::dropIfExists('alternatif');
    }
};
