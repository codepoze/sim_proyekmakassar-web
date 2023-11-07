<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeknislapAnggsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teknislap_angg', function (Blueprint $table) {
            $table->increments('id_teknislap_angg');
            $table->integer('id_teknislap')->unsigned()->nullable();
            $table->string('nik', 16)->nullable();
            $table->string('nama', 50)->nullable();
            $table->string('telepon', 15)->nullable();
            $table->text('alamat')->nullable();

            $table->integer('by_users')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('id_teknislap')->references('id_teknislap')->on('teknislap')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teknislap_angg');
    }
}
