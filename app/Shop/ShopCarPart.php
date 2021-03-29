<?php

namespace App\Shop;

use Illuminate\Database\Eloquent\Model;

class ShopCarPart extends Model
{
    protected $primaryKey ='product_id'; 
    protected $guarded = [
        'car_id', 'part_ref', 'tab_id', 'product_sku', 'product_ita', 'product_gbr'
    ]; 
    protected $fillable = [
        'product_qty', 'product_price'
    ];

}
