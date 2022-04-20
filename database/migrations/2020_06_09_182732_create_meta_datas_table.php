<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetaDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meta_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('gallery_id')->nullable();
            $table->string('person')->nullable();
            $table->string('product')->nullable();
            $table->string('award')->nullable();
            $table->string('company')->nullable();
            $table->string('other')->nullable();
            $table->string('url')->nullable();
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
        Schema::dropIfExists('meta_datas');
    }
}
