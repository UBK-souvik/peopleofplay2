<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductGalleryMetaDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_gallery_meta_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_gallery_id')->nullable();
            $table->integer('meta_key')->nullable()->comment('1: Type, 2: Name, 3: Title, 4: Other');
            $table->string('meta_value')->nullable();
            $table->integer('meta_value_int')->nullable();
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
        Schema::dropIfExists('product_gallery_meta_datas');
    }
}
