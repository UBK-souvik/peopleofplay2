<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('stripe_plan_id')->nullable();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('features_title')->nullable();
            $table->longText('features')->nullable();
            $table->decimal('price')->nullable();
            $table->integer('validity')->nullable()->comment('In Days');
            $table->string('type')->default(1)->comment('0: Free, 1: Paid');
            $table->string('status')->default(1)->comment('0: Inactive, 1: Active');
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
        Schema::dropIfExists('plans');
    }
}
