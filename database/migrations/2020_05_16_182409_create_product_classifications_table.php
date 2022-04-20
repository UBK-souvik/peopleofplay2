<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductClassificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_classifications', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedInteger('product_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->integer('type')->nullable();
            $table->string('sub_category')->nullable();
            $table->string('official_link')->nullable();
            $table->string('social_media')->nullable();
            $table->integer('toy_type')->nullable()->comment('refer config');
            $table->integer('delivery_mechanism')->nullable()->comment('refer config');
            $table->integer('game_type')->nullable()->comment('refer config');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_classifications');
    }
}
