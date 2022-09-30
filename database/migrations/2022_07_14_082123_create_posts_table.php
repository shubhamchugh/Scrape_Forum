<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('post_type', 50)->default('QA');
            $table->bigInteger('user_id')->unsigned();
            $table->string('post_title');
            $table->string('slug', 191)->unique();
            $table->string('status', 50)->default('publish');
            $table->string('post_ref', 50)->default('forum');
            $table->text('post_description')->nullable();
            $table->string('source_value')->unique();
            $table->string('google_index', 50)->default('pending');
            $table->string('bing_index', 50)->default('pending');
            $table->string('wordpress_transfer', 50)->default('pending');
            $table->string('flarum_transfer', 50)->default('pending');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
