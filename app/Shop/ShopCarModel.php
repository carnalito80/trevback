<?php

namespace App\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopCarModel extends Model
{

    protected $primaryKey ='car_id'; 
    protected $guarded = [
        'man_id'
    ]; 
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'car_visible', 'product_ita', 'product_gbr', 'category_thumb_image'
    ];

  
   /**
     * Get the parts for the model.
     */
    public function parts()
    {
        return $this->hasMany('App\Shop\ShopCarPart', 'car_id', 'car_id');
    }
    public function subcats()
    {
        return $this->hasMany('App\Shop\ShopPartSubCategory', 'car_id', 'car_id');
    }
}
