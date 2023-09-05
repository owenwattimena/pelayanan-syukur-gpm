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
        Schema::create('jemaat', function (Blueprint $table) {
            $table->id();
            $table->string('no_kk');
            $table->string('nama_lengkap');
            $table->string('status_keluarga'); //Kepala keluarga, Istri, Suami, Anak, Cucu, Keponakan, Orang Tua, Mertua, Menantu, Kakak, Adik, Ipar Om/Tente, Sepupu, Keluarga Lain, Penghuni Kost, Lainnya
            $table->enum('jenis_kelamin', ['l', 'p']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('status_domisili'); // Aggota tetap GPM, Anggota tidak tetap GPM
            $table->boolean('status_menikah');
            $table->date('tanggal_menikah')->nullable();
            $table->string('alamat');
            $table->unsignedBigInteger('id_unit');
            $table->timestamps();

            $table->foreign('id_unit')->references('id')->on('unit');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jemaat');
    }
};
