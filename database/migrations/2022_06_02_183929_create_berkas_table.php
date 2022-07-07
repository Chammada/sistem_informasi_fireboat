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
        Schema::create('berkas', function (Blueprint $table) {
            $table->id();
            $table->string('kode_surat');
            $table->string('jenis_surat');
            $table->string('sub_jenis_surat');
            $table->string('tgl_terima_surat');
            $table->string('tgl_masuk_surat');
            $table->string('nomor_surat');
            $table->string('asal_surat')->nullable();
            $table->string('tujuan_surat')->nullable();
            $table->string('perihal_surat');
            $table->string('file');
            $table->integer('status');
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
        Schema::dropIfExists('berkas');
    }
};
