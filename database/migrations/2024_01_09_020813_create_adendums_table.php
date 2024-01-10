<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdendumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adendum', function (Blueprint $table) {
            $table->increments('id_adendum');
            $table->integer('id_kontrak')->unsigned()->nullable();
            $table->string('no_adendum', 50)->nullable();
            $table->date('tgl_adendum')->nullable();
            $table->enum('jenis', ['cco', 'optimasi', 'perpanjangan'])->nullable();
            $table->bigInteger('nil_adendum_kontrak')->nullable();
            $table->date('tgl_adendum_mulai')->nullable();
            $table->date('tgl_adendum_akhir')->nullable();

            $table->integer('by_users')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('id_kontrak')->references('id_kontrak')->on('kontrak')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adendum');
    }
}
