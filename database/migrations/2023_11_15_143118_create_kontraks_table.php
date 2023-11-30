<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKontraksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kontrak', function (Blueprint $table) {
            // paket / pekerjaan
            $table->increments('id_kontrak');
            $table->integer('id_paket')->unsigned()->nullable();
            $table->integer('id_penyedia')->unsigned()->nullable();
            $table->integer('id_konsultan')->unsigned()->nullable();
            $table->integer('id_teknislap')->unsigned()->nullable();
            $table->integer('id_fund')->unsigned()->nullable();
            $table->string('pj_penyedia', 45)->nullable();
            $table->string('pj_konsultan', 45)->nullable();
            $table->string('no_spmk', 50)->nullable();
            $table->string('no_kontrak', 50)->nullable();
            $table->binary('doc_kontrak')->nullable();
            $table->enum('jns_kontrak', ['utama', 'adendium'])->nullable();
            $table->date('tgl_kontrak_mulai')->nullable();
            $table->date('tgl_kontrak_akhir')->nullable();
            $table->string('thn_anggaran', 10)->nullable();
            $table->bigInteger('nil_pagu')->nullable();
            $table->string('kd_rekening', 50)->nullable();
            $table->binary('foto_lokasi')->nullable();
            $table->binary('laporan')->nullable();

            $table->integer('by_users')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('id_paket')->references('id_paket')->on('paket')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_penyedia')->references('id_penyedia')->on('penyedia')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_konsultan')->references('id_konsultan')->on('konsultan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_teknislap')->references('id_teknislap')->on('teknislap')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_fund')->references('id_fund')->on('fund')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kontrak');
    }
}