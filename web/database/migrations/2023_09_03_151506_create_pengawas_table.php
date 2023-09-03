<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengawasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengawas', function (Blueprint $table) {
            $table->increments('id_pengawas');
            $table->integer('id_ruas')->unsigned()->nullable();
            $table->string('nama')->nullable();
            $table->date('tgl')->nullable();
            $table->text('keterangan')->nullable();
            $table->integer('panjang')->nullable();
            $table->integer('lebar')->nullable();
            $table->binary('video')->nullable();
            $table->binary('doc')->nullable();

            $table->integer('by_users')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('id_ruas')->references('id_ruas')->on('ruas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengawas');
    }
}
