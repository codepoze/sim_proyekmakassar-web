<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePh0DetFotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ph0_det_foto', function (Blueprint $table) {
            $table->increments('id_ph0_det_foto');
            $table->integer('id_ph0')->unsigned()->nullable();
            $table->binary('foto')->nullable();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('id_ph0')->references('id_ph0')->on('ph0')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ph0_det_foto');
    }
}
