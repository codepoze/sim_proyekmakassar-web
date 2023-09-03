<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMc0sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mc0', function (Blueprint $table) {
            $table->increments('id_mc0');
            $table->integer('id_ruas')->unsigned()->nullable();
            $table->integer('cc0')->nullable();
            $table->integer('volume_mc0')->nullable();
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
        Schema::dropIfExists('mc0');
    }
}
