<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductsController;

use App\Http\Controllers\API\FrontEnd\PublicCategoryController;


// front end routes (public)
Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::get('getCategory',[PublicCategoryController::class,'category']);

Route::middleware('auth:sanctum','IsApiAdmin')->group(function(){

    Route::get('checkingAuthenticated',[AuthController::class,function(){
        return response()->json(['status' => 200, 'message' => 'Authenticated Successfully'],200);
    }]);

    Route::get('view-category',[CategoryController::class,'index']);
    Route::get('edit-category/{id}',[CategoryController::class,'edit']);
    Route::put('update-category/{id}',[CategoryController::class,'update']);
    Route::delete('delete-category/{id}',[CategoryController::class,'destroy']);
    Route::post('store-category',[CategoryController::class,'store']);
    Route::get('all-categories',[CategoryController::class,'all_categories']);

    // Products
    Route::post('store-product',[ProductsController::class,'store']);
    Route::get('view-product',[ProductsController::class,'index']);
    Route::get('edit-product/{id}',[ProductsController::class,'edit']);
    Route::post('update-product/{id}',[ProductsController::class,'update']);
});

Route::middleware('auth:sanctum')->group(function(){


    Route::post('logout',[AuthController::class,'logout']);
});

//Route::post('add-product',[ProductsController::class,'add']);
//Route::post('store-product',[ProductsController::class,'store']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
