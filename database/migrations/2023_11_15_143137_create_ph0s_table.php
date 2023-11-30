<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePh0sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ph0', function (Blueprint $table) {
            $table->increments('id_ph0');
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

            $table->integer('by_users')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

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
        Schema::dropIfExists('ph0');
    }
}
