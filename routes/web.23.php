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
/*
    request() <=> Request. VD: request()->get("tenbien") <=> Request::get("tenbien")
    session() <=> Session
*/
Route::get('/', function () {
    return view('welcome');
});
/*
//khởi tạo biến session
Route::get('session', function () {
    print_r(session());
    //session()->put("hoten"=>"Nguyễn Văn A");
    //session()->put("lop"=>"php64");
    echo "<h1><a href='".url('session-retrive')."'>Đến url để truy vấn biến session</a></h1>";
});
Route::get('resession-retrive', function () {
    //lấy giá trị của biến session
    $hoten = session()->get("hoten");
});
*/
//upload file
Route::get('upload', function () {
    return view('php64.form-upload');
});
Route::post('upload-post', function () {
    //lấy giá trị của textbox
    echo request()->get("name");//có thể dùng Request::get("name")
    //kiểm tra xem có file upload không
    if(request()->hasFile('photo')){
        //echo "file có tồn tại";
        //lấy tên file
        $file_name = request()->file('photo')->getClientOriginalName();
        //lấy đuôi file
        $file_extension = request()->file('photo')->getClientOriginalExtension();
        echo "<h1>Tên file: $file_name</h1>";
        echo "<h1>Đuôi file: $file_extension</h1>";
        //upload file
        request()->file('photo')->move('upload',$file_name);
    }
});
//session
Route::get('session1', function () {
    //xóa toàn bộ session
    //session()->flush();
    //khởi tạo biến session
    //khởi tạo các biến đơn
    session()->put("name","Nguyễn Văn A");
    session()->put("email","nva@gmail.com");
    //lấy giá trị của biến
    $name = session()->get("name");
    $email = session()->get("email");
    echo "<h1>Name: $name - Email: $email</h1>";
});
Route::get('session2', function () {
    //xóa toàn bộ session
    session()->flush();
    //xóa từng biến session
    //session()->forget('tenbien')
    $sinh_vien = ["hoten"=>"Nguyễn Văn A","email"=>"nva@gmail.com","lop"=>"php64"];
    //sử dụng hàm push để khai báo biến array
    session()->push('sinh_vien',$sinh_vien);
    //truy xuất biến
    $sv = session()->get('sinh_vien');
    //hàm dd xuất ra kiến trúc
    //dd($sv);
    //duyệt các phần tử trong array
    echo "<pre>";
    print_r($sv);
    echo "</pre>";
    //---
    foreach($sv as $value){
        echo $value["hoten"];
    }
});
//read
Route::get('read', function () {
    //session()->flush();
    //kiểm tra xem biến session sinh_vien có tồn tại chưa, nếu chưa thì khởi tạo nó
    //if(session()->has('sinh_vien') == false)
        //session()->push('sinh_vien',[]);
    //truy xuất biến session
    $sinh_vien = session()->get('sinh_vien');
    return view('php64.read',['sinh_vien'=>$sinh_vien]);
});
//create
Route::get('create', function () {
    return view('php64.form-sinh-vien');
});
//create-post
Route::post('create-post', function () {
    $name = request()->get('name');
    //có thể dùng cách khác để lấy giá trị của thẻ form
    $email = Request::get("email");
    //đưa dữ liệu vào biến session, có thể dùng hàm session() hoặc đối tượng Session
    Session::push('sinh_vien',['name'=>$name,'email'=>$email]);
    //di chuyển đến url
    return redirect(url('read'));
});
//delete
Route::get('delete/{key}', function ($key) {
    //truy xuất biến session
    $sinh_vien = session()->get('sinh_vien');

    //duyệt thông tin của biến session array, xóa phần tử có key trùng với key truyền vào
    foreach($sinh_vien as $k=>$v){
        if($k == $key)
            //remove phần tử thứ $key trong session array
            Session::pull('sinh_vien.'.$key);
    }
    //di chuyển đến url
    return redirect(url('read'));
});