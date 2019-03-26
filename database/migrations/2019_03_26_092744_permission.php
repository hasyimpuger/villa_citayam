<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Permission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usergroups', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('name', 30);
            $table->timestamps();
            $table->softDeletes();
            $table->timestamp('server_timestamp')->nullable();
        });

        Schema::create('user_usergroup', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('usergroup_id');
            $table->foreign('usergroup_id')->references('id')->on('usergroups');
            $table->timestamps();
            $table->softDeletes();
            $table->timestamp('server_timestamp')->nullable();
        });

        Schema::create('menus', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('menu_name', 30);
            $table->string('menu_value', 30)->unique();
            $table->timestamps();
            $table->softDeletes();
            $table->timestamp('server_timestamp')->nullable();
        });

        Schema::create('menu_usergroup', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('menu_id');
            $table->foreign('menu_id')->references('id')->on('menus');
            $table->unsignedBigInteger('usergroup_id');
            $table->foreign('usergroup_id')->references('id')->on('usergroups');
            $table->timestamps();
            $table->softDeletes();
            $table->timestamp('server_timestamp')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
