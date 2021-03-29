<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopCarModels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_car_models', function (Blueprint $table) {
            $table->bigIncrements('car_id');
            $table->bigInteger('man_id');
            $table->tinyInteger('car_visible')->default(1);
            $table->string('product_ita', 255)->nullable();
            $table->string('product_gbr', 255)->nullable();
            $table->string('category_thumb_image', 255)->default('noimage.jpg');
           
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
        Schema::dropIfExists('shop_car_models');
    }
}
