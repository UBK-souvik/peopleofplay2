<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('main_image')->nullable();
            $table->string('product_id_number')->nullable();
            $table->string('name')->nullable();
            $table->string('brand')->nullable();
            $table->string('countries_sold')->nullable();
            $table->string('company')->nullable();
            $table->integer('ratings')->nullable();
            $table->string('age')->nullable();
            $table->string('add_to_collection')->nullable();
            $table->string('community')->nullable();
            $table->string('audience')->nullable();
            $table->string('alternate_names')->nullable();
            $table->string('log_play')->nullable();
            $table->string('minimum_age')->nullable();
            $table->string('maximum_age')->nullable();
            $table->integer('complexity_rating')->nullable();
            $table->integer('my_rating')->nullable();
            $table->integer('year_launched')->nullable();
            $table->integer('buy')->nullable();
            $table->integer('like')->nullable();
            $table->integer('subscribe')->nullable();
            $table->longText('description')->nullable();
            $table->longText('comments')->nullable();
            $table->integer('setting_for_play')->nullable()->comment('refer config');
            $table->integer('interest')->nullable()->comment('refer config');
            $table->integer('number_of_players')->nullable()->comment('refer config');
            $table->integer('playing_time')->nullable()->comment('refer config');
            $table->integer('difficulty')->nullable()->comment('refer config');
            $table->tinyInteger('environmentally_friendly')->nullable()->comment('0: No ,1: Not Applicable, 2: Yes');
            $table->tinyInteger('frustration_free_packaging')->nullable()->comment('0: No ,1: Not Applicable, 2: Yes');
            $table->tinyInteger('status')->default(1)->comment('0: Inactive ,1: Active');
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
        Schema::dropIfExists('products');
    }
}
