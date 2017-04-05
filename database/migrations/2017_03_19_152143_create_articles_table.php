<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id');
            $table->primary('id');

            $table->string('name', 255);
            $table->string('alias', 255)->nullable();
            $table->string('description', 255)->nullable();
            $table->text('content')->nullable();
            $table->string('image', 255)->nullable();          
            $table->tinyInteger('is_blog')->default(1)->nullable();
            $table->tinyInteger('is_sesson')->default(1)->nullable();
            $table->Integer('count_share')->default(0)->nullable();
            $table->tinyInteger('status')->default(1)->nullable();
            $table->Integer('time_tracking')->default(0)->nullable();            

            // Foreign key
            $table->string('user_id', 64);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('articles');
    }
}
