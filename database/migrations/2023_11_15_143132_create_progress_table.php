<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progress', function (Blueprint $table) {
            $table->increments('id_progress');
            $table->integer('id_kontrak_rencana')->unsigned()->nullable();
            $table->integer('id_kontrak_ruas_item')->unsigned()->nullable();
            $table->text('nma_pekerjaan')->nullable();
            $table->float('panjang')->nullable();
            $table->float('titik_core')->nullable();
            $table->float('l_1')->nullable();
            $table->float('l_2')->nullable();
            $table->float('l_3')->nullable();
            $table->float('l_4')->nullable();
            $table->float('tki_1')->nullable();
            $table->float('tki_2')->nullable();
            $table->float('tki_3')->nullable();
            $table->float('tte_1')->nullable();
            $table->float('tte_2')->nullable();
            $table->float('tte_3')->nullable();
            $table->float('tka_1')->nullable();
            $table->float('tka_2')->nullable();
            $table->float('tka_3')->nullable();
            $table->float('berat_bersih')->nullable();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('id_kontrak_rencana')->references('id_kontrak_rencana')->on('kontrak_rencana')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_kontrak_ruas_item')->references('id_kontrak_ruas_item')->on('kontrak_ruas_item')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('progress');
    }
}
