<?php

namespace App\Shop;

use Illuminate\Database\Eloquent\Model;

class ShopPartSubCategory extends Model
{
      protected $guarded = [
        'car_id', 'table_ref', 'product_ita', 'product_gbr', 'sub_category'
    ]; 
    
    // public function cat()
    // {
    //     return $this->belongsTo('App\Shop\ShopPartCatName', 'category_id','sub_category');
    // }

}
