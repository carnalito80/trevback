<?php
namespace App\Controllers;

use App\Controllers\Controller;
use App\Shop\ShopCarPart;
use App\Shop\ShopCarModel;
use App\Shop\ShopPartCategoryName;
use App\Shop\ShopPartSubCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;



class ShopController extends Controller
{

    public function getProduct($product_id=0) {
        $product = ShopCarPart::find($product_id); //get the product,
        return $product;
    }

    public function getProductsBySub($carId=0,$subId=0) {
      $products = ShopCarPart::where('car_id', $carId)
      ->where('tab_id', $subId)
      ->orderBy('product_gbr')
      ->get();
      return $products;
    }

    public function getCategory($cat_id) {
     $cat = ShopPartCategoryName::find($cat_id); //get the cat
      
        return $cat;
    }
    public function getSubCategory($sub_id) {
      $cat = ShopPartSubCategory::find($sub_id); //get the cat
       
         return $cat;
     }
   

    public function getCarSubCats($cats=0,$cars=0) {
        $return = Array();
        $cararray = Array();
        $catarray = Array();
        if ($cars == 0 ) $cararray =  ShopCarModel::all();
        else {
        $cars = explode(",",$cars); 
           for ($i=0; $i < count($cars); $i++) {
            array_push($cararray,ShopCarModel::find($cars[$i]));
          }
       
        }
     
        if ($cats == 0 ) $catarray =  ShopPartCategoryName::all();
        else {
          $cats = explode(",",$cats); 
          for ($i=0; $i < count($cats); $i++) {
            array_push($catarray,ShopPartCategoryName::find($cats[$i]));
          }
        }
        
        foreach($cararray as $car) {
        //  echo '<br>bil: ' . $car->car_id;         
            foreach($catarray as $cat) {
          //    echo '<br>cat: ' . $cat->category_id;
                 
                $subcats = ShopPartSubCategory::select('*')
                ->where('car_id', '=', $car->car_id)
                ->where('sub_category', '=', $cat->category_id)
                ->get();
            
                foreach($subcats as $subcat) {
                  array_push($return,$subcat);
               
                }
            }       
          
         
        }


        return $return;   
    }


    public function getProductByCat($cat_id=0,$car_id=0) {
        $return = array();
        if ($car_id == 0 ) $cars =  ShopCarModel::all();
        else $car = ShopCarModel::find($car_id);
        if ($cat_id == 0 )  $cats =  ShopPartCategoryName::all();
        else $cat = ShopPartCategoryName::find($cat_id);
      
       if ($car_id == 0 ) { //ALL cars
        foreach($cars as $car) {
            //echo "<b>" . $car->product_gbr . "</b><br>";
            if ($cat_id == 0) { //ALL cars and ALL cats
              foreach($cats as $cat) {
               
                  //echo "<u>" . $cat->category_name_gbr . "</u><br>";
                 
                  $subcats = ShopPartSubCategory::select('*')
                  ->where('car_id', '=', $car->car_id)
                  ->where('sub_category', '=', $cat->category_id)
                  ->get();
                 // echo "<BR><BR>";
                  foreach($subcats as $subcat) {
                    array_push($return,$subcat->product_gbr);
                   // echo $subcat->product_gbr . "<br>";
                  }
              }       
            }
            else { //ALL cars but a specific category
                //echo "<u>" . $cat->category_name_gbr . "</u><br>";
                echo $cat->category_id;
              
                $subcats = ShopPartSubCategory::select('*')
                ->where('car_id', '=', $car->car_id)
                ->where('sub_category', '=', $cat->category_id)
                ->get();
                //echo "<BR><BR>";
                foreach($subcats as $subcat) {
                 
                  array_push($return,$subcat->product_gbr);
                  echo $subcat->product_gbr . "<br>";
                } 
            }
          }
        }
        else { //not all cars
            if ($cat_id == 0) { //specific car, ALL cats
               // echo "<b>" . $car->product_gbr . "</b><br>";
                foreach($cats as $cat) {
                    echo "<u>" . $cat->category_name_gbr . "</u><br>";
                    
                    $subcats = ShopPartSubCategory::select('*')
                    ->where('car_id', '=', $car->car_id)
                    ->where('sub_category', '=', $cat->category_id)
                    ->get();
                  //  echo "<BR><BR>";
                    foreach($subcats as $subcat) {
                      array_push($return,$subcat->product_gbr);
                     // echo $subcat->product_gbr . "<br>";
                    } 
                }       
              }
              else { //specific car and cat
                $return['car'] = $car->car_id;
                $return['cat'] = array();
                $return['cat']['name'] = $cat->category_name_gbr;
                $return['cat']['subcats'] = array();
               
               // echo "<b>" . $car->product_gbr . "</b><br>";
               // echo "<u>" . $cat->category_name_gbr . "</u><br>";
                $subcats = ShopPartSubCategory::select('product_gbr')
                ->where('car_id', '=', $car->car_id)
                ->where('sub_category', '=', $cat->category_id)
                ->get();
              //  echo "<BR><BR>";
                foreach($subcats as $subcat) {
                 array_push( $return['cat']['subcats'],$subcat->product_gbr);    
                //  echo $subcat->product_gbr . "<br>";
                } 

              } 

        }
        //var_dump($return);
       return json_encode($return);
    }   
   
    public function getCars($car_id=0) {
        if ($car_id == 0 )  $cars =  ShopCarModel::all();
        else $cars = ShopCarModel::find($car_id);
        return $cars;

    }
    public function getCarProducts($car_id) {

        $products = ShopCarModel::find($car_id)->parts; //get the parts of the car
        return $products;
    }
    public function getCarCats($car_id) {

        $products = ShopCarModel::find($car_id)->subcats; //get avaible categories of the car
  
        return $products;
    }

    public function getCategories() {

      return ShopPartCategoryName::select('*')->where('category_publish', 1)->get();
    }
}