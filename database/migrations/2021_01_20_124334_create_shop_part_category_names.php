<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopPartCategoryNames extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_part_category_names', function (Blueprint $table) {
            $table->bigIncrements('category_id');
            $table->string('cat_description', 255)->nullable();
            $table->string('cat_thumb_image', 255)->nullable();
            $table->string('cat_full_image',255)->nullable();
            $table->string('category_name_ita',128)->default('');
            $table->string('category_name_gbr',128)->default('');
            $table->string('category_name_fre',128)->default('');
            $table->string('category_name_jpg',128)->default('');
            $table->string('category_name_ger',128)->default('');
            $table->bigInteger('cdate')->nullable();
            $table->bigInteger('mdate')->nullable();
            $table->tinyInteger('category_publish')->nullable();
       
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
        Schema::dropIfExists('shop_part_category_names');
    }
}
