@extends("frontend.layout_home")
@section("do-du-lieu-vao-layout")
<!-- main -->
    @include("frontend.slide")
    <!-- content-box -->
    <div class="row">
      <div class="col-xs-12 col-md-12"> 
        <!-- hot product --> 
        <div class="special-collection">
          <div class="tabs-container">
            <div class="row" style="margin-top:10px;">
              <div class="col-lg-10">
                <h2 style="font-weight:bold; color:red;">HOT PRODUCT</h2>
              </div>
              <div class="clearfix"></div>
            </div>
          </div>
          <div class="tabs-content row">
            <div id="content-tabb1" class="content-tab content-tab-proindex">
            @php
            	//gọi hàm trong HomeController để lấy kết quả. Do hàm hotProducts là hàm static nên có thể truy cập từ tên class mà không cần khởi tạo đối tượng
            	$hotProducts = \App\Http\Controllers\Frontend\HomeController::hotProducts();
            @endphp
            <style type="text/css">
              .discount{position: absolute; width: 30px; line-height: 30px; text-align: center; background: red; color: white; border-radius: 50px; left: 15px; top: 15px;}
            </style>
            @foreach($hotProducts as $row)
                <!-- box product -->
                <div class="col-xs-6 col-md-2 col-sm-6 ">
                  <div class="product-grid" id="product-1168979" style="height: 350px; overflow: hidden; position: relative;">
                    <div class="discount">{{ $row->discount }} %</div>
                    <div class="image"> <a href="{{ url('products/detail/'.$row->id) }}"><img src="{{ asset('upload/products/'.$row->photo) }}" title="{{ $row->name }}" alt="{{ $row->name }}" class="img-responsive"></a> </div>
                    <div class="info">
                      <h3 class="name"><a href="{{ url('products/detail/'.$row->id) }}">{{ $row->name }}</a></h3>
                      <p class="price-box"> <span class="special-price"> <span class="price product-price" style="text-decoration:line-through;"> {{ number_format($row->price) }}</span> ₫ </span> </p>
                      <p class="price-box"> <span class="special-price"> <span class="price product-price"> {{ number_format($row->price - ($row->price * $row->discount)/100) }} </span>₫ </span> </p>
                      <p class="price-box"> 
                      	<a href="{{ url('products/rating/'.$row->id.'?star=1') }}"><img src="frontend/images/star.jpg"></a> 
                      	<a href="{{ url('products/rating/'.$row->id.'?star=2') }}"><img src="frontend/images/star.jpg"></a> 
                      	<a href="{{ url('products/rating/'.$row->id.'?star=3') }}"><img src="frontend/images/star.jpg"></a> 
                      	<a href="{{ url('products/rating/'.$row->id.'?star=4') }}"><img src="frontend/images/star.jpg"></a> 
                      	<a href="{{ url('products/rating/'.$row->id.'?star=5') }}"><img src="frontend/images/star.jpg"></a> </p>
                      <div class="action-btn">
                        <form>
                          <a href="{{ asset('cart/buy/'.$row->id) }}" class="button">Add to Cart</a>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- end box product -->
            @endforeach
              </div>
            </div>
          </div>
        </div>
        <!-- /hot product -->
        <!-- adv -->
        <div class="row">
          <div class="col-xs-12 col-md-12"> <img src="frontend/images/adv1.jpg" class="img-thumbnail"> </div>
        </div>
        <!-- /adv -->
        @php
        	$categories = \App\Http\Controllers\Frontend\HomeController::getCategories();
        @endphp
        @foreach($categories as $rowCategory)
        <!-- category product -->
        <div class="special-collection">
          <div class="tabs-container">
            <div class="row" style="margin-top:10px;">
              <div class="head-tabs head-tab1 col-lg-11">
                <h2 style="font-weight:bold; color:red;">{{ $rowCategory->name }}</h2>
              </div>
              <div class="clearfix"></div>
            </div>
          </div>
          <div class="tabs-content row">
            <div id="content-taba4" class="content-tab content-tab-proindex"> 
              
              @php
	            	$products = \App\Http\Controllers\Frontend\HomeController::getProductsInCategory($rowCategory->id);
	            @endphp
	            @foreach($products as $row)
	                <!-- box product -->
	                <div class="col-xs-6 col-md-2 col-sm-6 ">
	                  <div class="product-grid" id="product-1168979" style="height: 350px; overflow: hidden;">
	                    <div class="image"> <a href="{{ url('products/detail/'.$row->id) }}"><img src="{{ asset('upload/products/'.$row->photo) }}" title="{{ $row->name }}" alt="{{ $row->name }}" class="img-responsive"></a> </div>
	                    <div class="info">
	                      <h3 class="name"><a href="{{ url('products/detail/'.$row->id) }}">{{ $row->name }}</a></h3>
	                      <p class="price-box"> <span class="special-price"> <span class="price product-price" style="text-decoration:line-through;"> {{ number_format($row->price) }}</span> ₫ </span> </p>
	                      <p class="price-box"> <span class="special-price"> <span class="price product-price"> {{ number_format($row->price - ($row->price * $row->discount)/100) }} </span>₫ </span> </p>
	                      <p class="price-box"> 
	                      	<a href="{{ url('products/rating/'.$row->id.'?star=1') }}"><img src="frontend/images/star.jpg"></a> 
	                      	<a href="{{ url('products/rating/'.$row->id.'?star=2') }}"><img src="frontend/images/star.jpg"></a> 
	                      	<a href="{{ url('products/rating/'.$row->id.'?star=3') }}"><img src="frontend/images/star.jpg"></a> 
	                      	<a href="{{ url('products/rating/'.$row->id.'?star=4') }}"><img src="frontend/images/star.jpg"></a> 
	                      	<a href="{{ url('products/rating/'.$row->id.'?star=5') }}"><img src="frontend/images/star.jpg"></a> </p>
	                      <div class="action-btn">
	                        <form>
	                          <a href="{{ asset('cart/buy/'.$row->id) }}" class="button">Add to Cart</a>
	                        </form>
	                      </div>
	                    </div>
	                  </div>
	                </div>
	                <!-- end box product -->
	            @endforeach

            </div>
          </div>
        </div>
        <!-- /category product --> 
        @endforeach
        
        
        <!-- adv -->
        <div class="widebanner"> <a href="#"><img src="frontend/100/047/633/themes/517833/assets/widebanner221b.jpg?1481775169361" alt="#" class="img-responsive"></a> </div>
        <!-- end adv --> 
        
        <!-- hot news -->
        <div class="home-blog">
          <h2 class="title" style="font-weight:bold; color:red;"> <span>Tin tức</span></h2>
          <div class="row">
            <div class="owl-home-blog owl-home-blog-bottompage"> 
            	@php
	            	$news = \App\Http\Controllers\Frontend\HomeController::hotNews();
	            @endphp
	            @foreach($news as $row)
	              <!-- new item -->
	              <div class="item" style="height:350px; overflow:hidden;">
	                <div class="article"> <a href="{{ url('news/detail/'.$row->id) }}" class="image"> <img src="{{ asset('upload/news/'.$row->photo) }}" alt="{{ $row->name }}" title="{{ $row->name }}" class="img-responsive"> </a>
	                  <div class="info">
	                    <h3><a class="text3line" href="{{ url('news/detail/'.$row->id) }}" style="font-weight: bold;">{{ $row->name }}</a></h3>
	                    <p class="desc">
	                    	<!-- liên quan đến ckeditor thì phải dùng tag sau -->
	                    	{!! $row->description !!}
	                    </p>
	                  </div>
	                </div>
	              </div>
	              <!-- /news item --> 
                @endforeach         
              
            </div>
          </div>
        </div>
        <!-- /hotnews -->         
      </div>
    </div>
    <!-- /content-box -->
    <!-- /main -->
@endsection