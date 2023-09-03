<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRuasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ruas', function (Blueprint $table) {
            $table->increments('id_ruas');
            $table->integer('id_paket')->unsigned()->nullable();
            $table->string('nilai_ruas', 50)->nullable();
            $table->string('lat', 50)->nullable();
            $table->string('long', 50)->nullable();

            $table->integer('by_users')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ruas');
    }
}
