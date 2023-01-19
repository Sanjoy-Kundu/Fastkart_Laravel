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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('product_category_id');
            $table->string('product_name');
            $table->float('purches_product_price', 9,2); //9 digit and 2 decimal ghor projonto jabe
            $table->float('regular_product_price', 9,2);
            $table->float('product_discount_price',9,2);
            $table->longText('short_description');
            $table->longText('long_description');
            $table->longText('additonal_information');
            $table->longText('care_instruction');
            $table->text('product_thumbnail');
            $table->text('product_features_photo');
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
};
