<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('id_users')->unsigned()->unique();
            $table->integer('id_role')->unsigned()->nullable();
            $table->string('nama', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('foto', 50)->nullable();
            $table->enum('active', ['y', 'n'])->nullable();
            $table->string('token_remember')->unique()->nullable();
            $table->string('token_activation', 50)->unique()->nullable();
            $table->string('username', 180)->unique();
            $table->string('password');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();

            $table->foreign('id_role')->references('id_role')->on('roles')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
