<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMissingFieldsInProductPage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('price')->nullable();
        });

        Schema::table('product_classifications', function (Blueprint $table) {
            $table->string('inventor')->nullable();
            $table->longText('team')->nullable();
            $table->string('launched')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('price');
        });

        Schema::table('product_classifications', function (Blueprint $table) {
            $table->dropColumn('inventor');
            $table->dropColumn('team');
            $table->dropColumn('launched');
        });
    }
}
