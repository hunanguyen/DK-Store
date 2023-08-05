<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});
//muốn sử dụng controller nào cần phải khai báo nó ở file này
use App\Http\Controllers\CustomersController;
//read
Route::get('read',[CustomersController::class,'read']);
//create
Route::get('create',[CustomersController::class,'create']);
//create post
Route::post('create-post',[CustomersController::class,'createPost']);
//update
Route::get('update/{id}',[CustomersController::class,'update']);
//update post
Route::post('update-post/{id}',[CustomersController::class,'updatePost']);
//delete
Route::get('delete/{id}',[CustomersController::class,'delete']);