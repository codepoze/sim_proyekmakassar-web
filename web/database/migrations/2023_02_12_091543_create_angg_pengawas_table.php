<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggPengawasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('angg_pengawas', function (Blueprint $table) {
            $table->increments('id_angg_pengawas');
            $table->integer('id_kord_pengawas')->unsigned()->nullable();
            $table->integer('id_users')->unsigned()->nullable();
            $table->string('telepon', 15)->nullable();
            $table->text('alamat')->nullable();

            $table->integer('by_users')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('id_kord_pengawas')->references('id_kord_pengawas')->on('kord_pengawas')->onDelete('cascade');
            $table->foreign('id_users')->references('id_users')->on('users')->onDelete('cascade')->onUpdate('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('angg_pengawas');
    }
}
