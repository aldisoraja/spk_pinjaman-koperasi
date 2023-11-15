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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('no_anggota')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('name');
            $table->string('username')->unique();
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('id')->on('role')->cascadeOnDelete();
            $table->string('password');
            $table->integer('is_checklist')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
