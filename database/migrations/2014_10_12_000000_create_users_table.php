<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->engine = 'InnoDB';
            $table->uuid('id');
            $table->primary('id');

            $table->string('fullname', 255);
            $table->string('nickname', 100);
            $table->string('email', 100)->unique();
            $table->string('password', 64);
            $table->string('phone', 100)->nullable();
            $table->string('facebook_link', 255)->nullable();
            $table->string('linkedin_link', 255)->nullable();
            $table->string('github_link', 255)->nullable();
            $table->string('stackoverflow_link', 255)->nullable();
            $table->text('skill')->nullable();
            $table->tinyInteger('rank')->default(0);
            $table->tinyInteger('role')->default(3);
            $table->tinyInteger('status')->default(1);
            $table->rememberToken();
            $table->timestamps();
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
