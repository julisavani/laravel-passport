<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\HomescreenController;
use App\Http\Controllers\OrderController;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['namespace' => 'Api', 'prefix' => 'v1'], function () {
    Route::post('register', [AuthenticationController::class, 'register']);
    Route::post('login', [AuthenticationController::class, 'login']);
    Route::post('social-login', [AuthenticationController::class, 'socialLogin']);
    Route::post('logout', [AuthenticationController::class, 'logout'])->middleware('auth:api');
    Route::get('profile', [AuthenticationController::class, 'profile'])->middleware('auth:api');
    Route::put('profile', [AuthenticationController::class, 'updateProfile'])->middleware('auth:api');

    Route::group(['middleware' => ['userAuth']], function (){
        Route::post("add-to-cart",[OrderController::class,"addToCart"]);
        Route::get("remove-to-cart/{cart}",[OrderController::class,"removeToCart"]);
        Route::get("increase-product/{cart}",[OrderController::class,"increaseProduct"]);
        Route::get("decrease-product/{cart}",[OrderController::class,"decreaseProduct"]);
        Route::post("store-address",[OrderController::class,"storeAddress"]);
        Route::get("get-addresses",[OrderController::class,"getAddress"]);
        Route::post("payment",[OrderController::class,"payment"]);
        Route::post("place-order",[OrderController::class,"placeOrder"]);
        Route::get("cart-detail",[OrderController::class,"cartDetail"]);    // Route::get("check-out",[OrderController::class,"checkOut"]);
        Route::get("my-orders",[OrderController::class,"myOrder"]);    // Route::get("check-out",[OrderController::class,"checkOut"]);

        //favriute product
        Route::get("favourite-list",[HomescreenController::class,"favouriteList"]); 
        Route::get("add-to-favourite/{id}",[HomescreenController::class,"addFavourite"]);
        Route::get("remove-favourite/{id}",[HomescreenController::class,"removeFavouriteProduct"]);
        
    });
    //city state
    Route::get("state/{country}", [HomescreenController::class, "getState"]);
    Route::get("get-country", [HomescreenController::class, "country"]);
});

Route::get("navbar", [HomescreenController::class, 'navbarmenus']);
Route::get("detail/{id}", [HomescreenController::class, 'productdetail']);
Route::get("{slug}", [HomescreenController::class, 'productlist']);




