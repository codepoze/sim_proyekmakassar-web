<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKontrakRuasItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kontrak_ruas_item', function (Blueprint $table) {
            $table->increments('id_kontrak_ruas_item');
            $table->integer('id_kontrak_ruas')->unsigned()->nullable();
            $table->integer('id_satuan')->unsigned()->nullable();
            $table->enum('tipe', ['pbj', 'lpa', 'lpb', 'ac_bc', 'lc', 'timbunan', 'paving', 'k_precast', 'k_cor', 'pas_batu'])->nullable();
            $table->text('nama')->nullable();
            $table->float('volume')->nullable();
            $table->bigInteger('harga_hps')->nullable();
            $table->bigInteger('harga_kontrak')->nullable();

            $table->integer('by_users')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('id_kontrak_ruas')->references('id_kontrak_ruas')->on('kontrak_ruas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_satuan')->references('id_satuan')->on('satuan')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kontrak_ruas_item');
    }
}
