<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pakets', function (Blueprint $table) {
            $table->increments('id_paket');
            $table->integer('id_kegiatan')->unsigned()->nullable();
            $table->integer('id_perusahaan')->unsigned()->nullable();
            $table->integer('id_kord_pengawas')->unsigned()->nullable();
            $table->string('nama_paket', 50)->nullable();
            $table->string('nama_pekerjaan', 50)->nullable();
            $table->string('lama_pekerjaan', 50)->nullable();
            $table->bigInteger('nilai_kontrak')->nullable();
            $table->string('nomor_kontrak', 50)->nullable();
            $table->string('nomor_spk', 50)->nullable();
            $table->string('nama_lokasi', 50)->nullable();
            $table->string('ruas_jalan', 50)->nullable();
            $table->string('nilai_peruas', 50)->nullable();
            $table->string('nilai_total_ruas', 50)->nullable();
            $table->string('titik_kordinat', 50)->nullable();
            $table->string('schedule', 50)->nullable();
            $table->text('foto_lokasi')->nullable();
            $table->text('doc_administrasi')->nullable();
            $table->text('doc_kontrak')->nullable();

            $table->integer('by_users')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('id_kegiatan')->references('id_kegiatan')->on('kegiatans')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('id_perusahaan')->references('id_perusahaan')->on('perusahaans')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('id_kord_pengawas')->references('id_kord_pengawas')->on('kord_pengawas')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pakets');
    }
}
