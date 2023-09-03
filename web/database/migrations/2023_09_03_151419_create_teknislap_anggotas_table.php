<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeknislapAnggotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teknislap_anggota', function (Blueprint $table) {
            $table->increments('id_teknislap_anggota');
            $table->integer('id_teknislap')->unsigned()->nullable();
            $table->integer('id_users')->unsigned()->nullable();
            $table->string('telepon', 15)->nullable();
            $table->text('alamat')->nullable();

            $table->integer('by_users')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('id_teknislap')->references('id_teknislap')->on('teknislap')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_users')->references('id_users')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teknislap_anggota');
    }
}
