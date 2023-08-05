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
//gọi middleware hello
Route::get('middleware', function () {
    echo "<h1>Hello world</h1>";
})->middleware("hello");

//sử dụng HelloController thì phải using nó ở đây
use App\Http\Controllers\HelloController;
//url: /controller/test1
Route::get('controller/test1',[HelloController::class,'index']);//gọi hàm index trong class HelloController
//truyền biến lên url
//url: /controller/test2/bien1/bien2
Route::get('controller/test2/{bien1}/{bien2}',[HelloController::class,'index2']);
//form
Route::get('controller/form1',[HelloController::class,'form1']);
//form post
Route::post('controller/form1-post',[HelloController::class,'form1Post']);
//---
//form
Route::get('controller/form2',[HelloController::class,'form2']);
//form post
Route::post('controller/form2-post',[HelloController::class,'form2Post']);
//---
//---
//form
Route::get('controller/validation',[HelloController::class,'validation']);
//form post
Route::post('controller/validation-post',[HelloController::class,'validationPost']);
//---
//include một view khác vào view hiện tại
Route::get('include', function () {
    return view('site.trang-chu');
});