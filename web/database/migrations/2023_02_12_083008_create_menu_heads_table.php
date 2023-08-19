<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuHeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_heads', function (Blueprint $table) {
            $table->increments('id_menu_head');
            $table->string('nama', 50)->nullable();
            $table->string('icon', 50)->nullable();
            $table->string('path', 50)->nullable();
            $table->enum('status', ['0', '1'])->nullable();
            $table->enum('jenis', ['single', 'multi'])->nullable();

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
        Schema::dropIfExists('menu_heads');
    }
}
