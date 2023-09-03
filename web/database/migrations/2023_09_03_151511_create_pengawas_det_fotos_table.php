<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengawasDetFotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengawas_det_foto', function (Blueprint $table) {
            $table->increments('id_pengawas_det_foto');
            $table->integer('id_pengawas')->unsigned()->nullable();
            $table->binary('foto')->nullable();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('id_pengawas')->references('id_pengawas')->on('pengawas')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengawas_det_foto');
    }
}
