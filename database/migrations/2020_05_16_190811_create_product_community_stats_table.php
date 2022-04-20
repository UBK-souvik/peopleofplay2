<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCommunityStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_community_stats', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedInteger('product_id')->nullable();
            $table->string('own')->nullable();
            $table->string('for_trade')->nullable();
            $table->string('wishlist')->nullable();
            $table->string('want_it_trade')->nullable();
            $table->string('has_part')->nullable()->comment('0: No, 1: Yes');
            $table->string('wants_part')->nullable()->comment('0: No, 1: Yes');
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
        Schema::dropIfExists('product_community_stats');
    }
}
