<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopCarParts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_car_parts', function (Blueprint $table) {
            $table->bigIncrements('product_id');
            $table->bigInteger('part_ref')->default(0);
            $table->bigInteger('car_id')->default(0); //links to cars
            $table->bigInteger('tab_id')->default(0);
            $table->string('product_sku', 64)->default('');
            $table->integer('product_qty')->default(0);
            $table->string('product_ita', 250)->default(NULL);
            $table->string('product_gbr', 250)->default(NULL);
            $table->decimal('product_price', 12, 2)->default(NULL);

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
        Schema::dropIfExists('shop_car_parts');
    }
}
