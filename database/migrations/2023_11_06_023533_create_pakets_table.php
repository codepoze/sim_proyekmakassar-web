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
        Schema::create('paket', function (Blueprint $table) {
            // paket / pekerjaan
            $table->increments('id_paket');
            $table->integer('id_kegiatan')->unsigned()->nullable();
            $table->integer('id_penyedia')->unsigned()->nullable();
            $table->integer('id_konsultan')->unsigned()->nullable();
            $table->integer('id_teknislap')->unsigned()->nullable();
            $table->string('nma_paket', 50)->nullable();
            $table->string('pj_penyedia', 45)->nullable();
            $table->string('pj_konsultan', 45)->nullable();
            $table->string('no_spmk', 50)->nullable();
            $table->string('no_kontrak', 50)->nullable();
            $table->text('doc_kontrak')->nullable();
            $table->date('tgl_kontrak_mulai')->nullable();
            $table->date('tgl_kontrak_akhir')->nullable();
            $table->string('thn_anggaran', 10)->nullable();
            $table->bigInteger('nil_pagu')->nullable();
            $table->string('kd_rekening', 50)->nullable();
            $table->string('sumber_dana', 50)->nullable();
            $table->text('foto_lokasi')->nullable();
            $table->text('laporan')->nullable();

            $table->integer('by_users')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('id_kegiatan')->references('id_kegiatan')->on('kegiatan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_penyedia')->references('id_penyedia')->on('penyedia')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_konsultan')->references('id_konsultan')->on('konsultan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_teknislap')->references('id_teknislap')->on('teknislap')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paket');
    }
}
