<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdendumRuasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adendum_ruas', function (Blueprint $table) {
            $table->increments('id_adendum_ruas');
            $table->integer('id_adendum')->unsigned()->nullable();
            $table->integer('id_kontrak_ruas')->unsigned()->nullable();

            $table->integer('by_users')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('id_adendum')->references('id_adendum')->on('adendum')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_kontrak_ruas')->references('id_kontrak_ruas')->on('kontrak_ruas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adendum_ruas');
    }
}
