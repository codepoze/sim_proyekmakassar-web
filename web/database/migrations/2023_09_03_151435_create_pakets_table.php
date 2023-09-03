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
            $table->increments('id_paket');
            $table->integer('id_kegiatan')->unsigned()->nullable();
            $table->integer('id_perusahaan')->unsigned()->nullable();
            $table->integer('id_teknislap')->unsigned()->nullable();
            $table->string('no_spmk', 50)->nullable();
            $table->string('no_kontrak', 50)->nullable();
            $table->bigInteger('nil_kontrak')->nullable();
            $table->string('waktu_kontrak', 50)->nullable();
            $table->text('doc_kontrak')->nullable();
            $table->string('lokasi_pekerjaan', 50)->nullable();
            $table->date('schedule')->nullable();
            $table->text('foto_lokasi')->nullable();
            $table->text('laporan')->nullable();

            $table->integer('by_users')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('id_kegiatan')->references('id_kegiatan')->on('kegiatan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_perusahaan')->references('id_perusahaan')->on('perusahaan')->onDelete('cascade')->onUpdate('cascade');
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
