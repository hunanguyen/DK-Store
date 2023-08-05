@extends("frontend.layout_shop")
@section("do-du-lieu-vao-layout")
@php
	function getCategoryName($category_id){
		//->select("name") chỉ select cột có tên là name
		$record = DB::table("categories")->where("id","=",$category_id)->select("name")->first();
		return isset($record->name) ? $record->name : "";
	}
  //hàm lấy số sao
  function getStar($product_id,$star){
    $list_record = DB::table("rating")->where("product_id","=",$product_id)->where("star","=",$star)->get();
    return $list_record->Count();
  }
@endphp
<!-- <div class="product-detail" itemscope itemtype="http://schema.org/Product"> -->
  <div class="top">
    <div class="row">
      <div class="col-xs-12 col-md-6 product-image">
        <div class="featured-image"> 
          <img src="{{ asset('upload/products/'.$record->photo) }}" style="width: 100%;" class="img-responsive"/>
        </div>
      </div>
      <div class="col-xs-12 col-md-6 info">
        <h1 itemprop="name">{{ $record->name }}</h1>
        <p class="vendor"> Category:&nbsp; <span> {{ getCategoryName($record->category_id) }} </span></p>
        <p itemprop="price" class="price-box product-price-box"> <span class="special-price"> <span class="price product-price" style="text-decoration:line-through;"> {{ number_format($record->price) }}₫ </span></span></p>
        <p itemprop="price" class="price-box product-price-box"> <span class="special-price"> <span class="price product-price"> {{ number_format($record->price - ($record->price * $record->discount)/100) }}₫ </span></span></p>
      </p>
      <a href="{{ url('cart/buy/'.$record->id) }}" class="btn btn-primary">Cho vào giỏ hàng</a>
      <!-- rating -->
      <div style="border:1px solid #dddddd; margin-top: 15px;">
        <h4 style="padding-left: 10px;">Rating</h4>
        <table style="width: 100%;">
          <tr>
            <td style="width: 80%; padding-left: 10px;"><img src="{{ asset('frontend/images/star.jpg') }}"></td>
            <td><span class="label label-primary">{{ getStar($record->id,1) }} vote</span></td>
          </tr>
          <tr>
            <td style="width: 80%; padding-left: 10px;"><img src="{{ asset('frontend/images/star.jpg') }}"> <img src="{{ asset('frontend/images/star.jpg') }}"></td>
            <td><span class="label label-warning">{{ getStar($record->id,2) }} vote</span></td>
          </tr>
          <tr>
            <td style="width: 80%; padding-left: 10px;"><img src="{{ asset('frontend/images/star.jpg') }}"> <img src="{{ asset('frontend/images/star.jpg') }}"> <img src="{{ asset('frontend/images/star.jpg') }}"></td>
            <td><span class="label label-danger">{{ getStar($record->id,3) }} vote</span></td>
          </tr>
          <tr>
            <td style="width: 80%; padding-left: 10px;"><img src="{{ asset('frontend/images/star.jpg') }}"> <img src="{{ asset('frontend/images/star.jpg') }}"> <img src="{{ asset('frontend/images/star.jpg') }}"> <img src="{{ asset('frontend/images/star.jpg') }}"></td>
            <td><span class="label label-info">{{ getStar($record->id,4) }} vote</span></td>
          </tr>
          <tr>
            <td style="width: 80%; padding-left: 10px;"><img src="{{ asset('frontend/images/star.jpg') }}"> <img src="{{ asset('frontend/images/star.jpg') }}"> <img src="{{ asset('frontend/images/star.jpg') }}"> <img src="{{ asset('frontend/images/star.jpg') }}"> <img src="{{ asset('frontend/images/star.jpg') }}"></td>
            <td><span class="label label-success">{{ getStar($record->id,5) }} vote</span></td>
          </tr>
        </table>
        <br>
      </div>
      <!-- /rating -->
    </div>
  </div>
</div>
<div class="middle" style="margin-top:20px;">
  <!-- chi tiet -->
  {!! $record->description !!}
  {!! $record->content !!}
  <!-- chi tiet -->
</div>
@endsection