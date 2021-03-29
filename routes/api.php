<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
});


//User stuff
// Route::middleware('auth:api')->post('/login', 'AuthController@login');
Route::middleware('auth:api')->post('/logout', 'AuthController@logout');
Route::middleware('auth:api')->post('/refresh-token', 'AuthController@refresh');
Route::post('login', [ 'as' => 'login', 'uses' => 'AuthController@login']);
Route::post('register', 'AuthController@register');
Route::get('getnews/{number?}', 'NewsController@getNews' );

// Admin stuff
Route::group(['middleware' => 'isAdmin'], function () {
    Route::get('/admin/getcompanies', 'AdminController@getCompanies');
    Route::get('/admin/getusers/{id?}', 'AdminController@getUsers');
    Route::get('/admin/getroles', 'AdminController@getRoles');
    Route::delete('/admin/removeuser/{id?}','AdminController@removeUser');
});


//Company stuff
Route::get('/company/getcompany/{id?}', 'CompanyController@getCompany'); //company id is optional
Route::post('/company/uploadlogo','CompanyController@uploadLogo');
Route::post('/company/updatecompanydetails/{id?}','CompanyController@updateCompanyDetails');


//***************Webshop stuff ******************
Route::get('/shop/getcars/{car_id?}', 'ShopController@getCars'); 
Route::get('/shop/getproductbycat/{cat_id?}/{car_id?}', 'ShopController@getProductByCat');
Route::get('/shop/getcarsubcats/{cat_id?}/{car_id?}', 'ShopController@getCarSubCats');
Route::get('/shop/getproduct/{product_id?}', 'ShopController@getProduct'); 

Route::get('/shop/getcarproducts/{car_id?}', 'ShopController@getCarProducts'); 

Route::get('/shop/getcarcats/{car_id?}', 'ShopController@getCarCats'); 
Route::get('/shop/categories', 'ShopController@getCategories');
Route::get('/shop/category/{cat_id?}', 'ShopController@getCategory');
Route::get('/shop/subcat/{sub_id?}', 'ShopController@getSubCategory');
Route::get('/shop/getproductsbysub/{subId?}/{carId?}', 'ShopController@getProductsBySub');

//*************** */Test stuff*******************

Route::post('/hepp', 'AuthController@test');
Route::get('me', [ 'as' => 'me', 'uses' => 'AuthController@me']);

//Storage test
Route::get('/showme', function() {
    $thereturn = [];
    $thereturn[0] = Storage::disk('ecudisk')->url('test.txt');
    $thereturn[1] = Storage::disk('ecudisk')->get('test.txt');
    return $thereturn;
}); 

//websockets test
Route::get('/websockets/test', 'WebsocketsController@test');


