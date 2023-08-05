<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//để sử dụng Query Builder cần phải use đối tượng sau
use DB;

class ProductsController extends Controller
{
    public function category($category_id){               
        $data = DB::table("products")->where("category_id","=",$category_id)->orderBy("id","desc")->paginate(16);
        $order = request('order'); 
        switch ($order) {
            case 'nameAsc':
                $data = DB::table("products")->where("category_id","=",$category_id)->orderBy("name","asc")->paginate(16);
                break;
            case 'nameDesc':
                $data = DB::table("products")->where("category_id","=",$category_id)->orderBy("name","desc")->paginate(16);
                break;
            case 'priceAsc':
                $data = DB::table("products")->where("category_id","=",$category_id)->orderBy("price","asc")->paginate(16);
                break;
            case 'priceDesc':
                $data = DB::table("products")->where("category_id","=",$category_id)->orderBy("price","desc")->paginate(16);
                break;
        }
        return view("frontend.product_category",["category_id"=>$category_id,"data"=>$data,'order'=>$order]);
    }
    public function detail($id){
        $record = DB::table("products")->where("id","=",$id)->first();
        return view("frontend.product_detail",["record"=>$record]);
    }
    public function search(Request $request){
        $key = request('key');
        $data = DB::table("products")->where("name","like",'%'.$key.'%')->orWhere("description","like",'%'.$key.'%')->orWhere("content","like",'%'.$key.'%')->paginate(40);
        return view("frontend.product_search",["key"=>$key,"data"=>$data]);
    }
    public function ajax(){
        $key = request('key');
        $data = DB::table("products")->where("name","like",'%'.$key.'%')->orWhere("description","like",'%'.$key.'%')->orWhere("content","like",'%'.$key.'%')->select('name','id','photo')->get();
        $str = "";
        foreach($data as $row){
            $str =  $str."<li><img src='".asset('upload/products/'.$row->photo)."'> <a href='".url('products/detail/'.$row->id)."'>".$row->name."</a></li>";
        }
        echo $str;
    }
    //đánh giá sao sản phẩm
    public function rating($id){
        $star = request('star');
        DB::table("rating")->insert(["product_id"=>$id,'star'=>$star]);
        return redirect(url('products/detail/'.$id));
    }
    public function searchPrice(Request $request){
        $fromPrice = request('fromPrice');
        $toPrice = request('toPrice');
        $data = DB::table('products')->where('price','>=',$fromPrice)->where('price','<=',$toPrice)->paginate(40);
        return view('frontend.product_search_price',['fromPrice'=>$fromPrice,'toPrice'=>$toPrice,'data'=>$data]);
    }
}
