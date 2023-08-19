<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_actions', function (Blueprint $table) {
            $table->increments('id_role_action');
            $table->integer('id_role')->unsigned()->nullable();
            $table->integer('id_menu_action')->unsigned()->nullable();
            $table->enum('status', ['0', '1'])->nullable();

            $table->integer('by_users')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('id_role')->references('id_role')->on('roles')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('id_menu_action')->references('id_menu_action')->on('menu_actions')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_actions');
    }
}
