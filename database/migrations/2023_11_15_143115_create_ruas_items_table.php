<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRuasItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ruas_item', function (Blueprint $table) {
            $table->increments('id_ruas_item');
            $table->text('nama')->nullable();
            $table->enum('tipe', ['pbj', 'lpa', 'lpb', 'ac_bc', 'ac_wc', 'lc', 'rigid', 'timbunan', 'paving', 'k_precast', 'k_cor', 'pas_batu'])->nullable();

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
        Schema::dropIfExists('ruas_item');
    }
}
