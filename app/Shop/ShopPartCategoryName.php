<?php

namespace App\Shop;

use Illuminate\Database\Eloquent\Model;

class ShopPartCategoryName extends Model
{
    protected $primaryKey = 'category_id';
    protected $guarded = [
        'unique_id', 'man_id', 'car_id', 'table_id', 'part_ref', 'product_sku'
    ]; 
    protected $fillable = [
        'comment'
    ];
    public function subs()
    {
        return $this->hasMany('App\Shop\ShopPartSubCategory', 'sub_category', 'category_id');
    }
}
