<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleBodiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_bodies', function (Blueprint $table) {
            $table->increments('id_role_body');
            $table->integer('id_role')->unsigned()->nullable();
            $table->integer('id_menu_body')->unsigned()->nullable();

            $table->integer('by_users')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('id_role')->references('id_role')->on('roles')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('id_menu_body')->references('id_menu_body')->on('menu_bodies')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_bodies');
    }
}
