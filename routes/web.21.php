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
/*
    - Route có các trạng thái
        - GET: sử dụng cho phương thức GET
        - POST: sử dụng cho phương thức POST
        - ANY: sử dụng cho cả GET, POST
*/
// url: /php64
Route::get('php64', function () {
    echo "<h1>Hello php64</h1>";
});
//url: /php64/hello
Route::get('php64/hello', function () {
    echo "<h1>Hello 2023</h1>";
});
//truyền biến lên url
//url: /truyenbien/bien1/bien2
Route::get('truyenbien/{bien1}/{bien2}', function ($bien1,$bien2) {
    echo "<h1>$bien1 $bien2</h1>";
});
//có thể đặt tên cho route
//url: /dat-ten-route
Route::get('dat-ten-route', function () {
    echo "<h1>Route name: test1</h1>";
})->name('test1');
//url: /den-route
Route::get('den-route', function () {
    //di chuyển đến route có tên: test1
    return redirect(route('test1'));
});
/*
    Gọi view: return view("tenview") <=> trong thư mục resource/views sẽ phải có file: tenview.blade.php
    Gọi view trong thư mục: return view("tenthumuc.tenview")
*/
//url: /view1
Route::get('view1', function () {
    //tạo biến để truyền dữ liệu ra view
    $data = array("hoten"=>"Nguyễn Văn A","email"=>"nva@gmail.com");
    //truyền dữ liệu ra view: sẽ truyền biến array vào hàm view, khi đó bên trong hàm view sẽ xử lý: sử dụng hàm extract để biến tên key thành tên biến
    return view("php64.file_view1",$data);
});
//cú pháp blade engine
Route::get('view2', function () {    
    return view("php64.file_view2");
});
//include một view khác vào view hiện tại
Route::get('view3', function () {    
    return view("php64.file_view3");
});
// import file layout.blade.php vào view
Route::get('view4', function () {    
    return view("php64.file_view4");
});
// form trong blade engine
Route::get('view5-form', function () {    
    return view("php64.file_view5");
});
//sau khi ấn nút submit thì trang sẽ ở trạng thái post, vì vậy sẽ thực hiện Route POST
//cách 1
Route::post('view5-form-post', function () {   
    $txt = Request::get("txt");
    echo "<h1>$txt</h1>";
    return view("php64.file_view5");
});