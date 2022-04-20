<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_statistics', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedInteger('product_id')->nullable();
            $table->integer('rating')->nullable();
            $table->integer('page_views')->nullable();
            $table->string('standard_deviation')->nullable();
            $table->string('number_of_ratings')->nullable();
            $table->string('overall_rank')->nullable();
            $table->string('all_time_plays')->nullable();
            $table->string('party_rank')->nullable();
            $table->string('this_month')->nullable();
            $table->string('own')->nullable();
            $table->string('for_trade')->nullable();
            $table->string('wishlist')->nullable();
            $table->string('previously_owned')->nullable();
            $table->string('want_it_trade')->nullable();
            $table->string('has_part')->nullable()->comment('0: No, 1: Yes');
            $table->string('wants_part')->nullable()->comment('0: No, 1: Yes');
            $table->longText('comments')->nullable();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_statistics');
    }
}
