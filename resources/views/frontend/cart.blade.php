@extends("frontend.layout_home")
@section("do-du-lieu-vao-layout")
@php
	//để sử dụng các hàm bên trong trait Cart thì phải khai báo ở đây
	use \App\Http\ShoppingCart\Cart;
@endphp
@if(isset($cart))
<div class="template-cart">
          <form action="{{ url('cart/update') }}" method="post">
          	<!-- phải đặt csrf vào bên trong thẻ form thì mới bắt được dữ liệu theo kiểu POST -->
          	@csrf
            <div class="table-responsive">
              <table class="table table-cart">
                <thead>
                  <tr>
                    <th class="image">Ảnh sản phẩm</th>
                    <th class="name">Tên sản phẩm</th>
                    <th class="price">Giá bán lẻ</th>
                    <th class="quantity">Số lượng</th>
                    <th class="price">Thành tiền</th>
                    <th>Xóa</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($cart as $product)
                  <tr>
                    <td><img src="{{ asset('upload/products/'.$product['photo']) }}" class="img-responsive" /></td>
                    <td><a href="{{ url('products/detail/'.$product['id']) }}">{{ $product['name'] }}</a></td>
                    <td> {{ number_format($product['price']) }}₫ </td>
                    <td><input type="number" id="qty" min="1" class="input-control" value="{{ $product['quantity'] }}" name="product_{{ $product['id'] }}" required="Không thể để trống"></td>
                    <td><p><b>{{ number_format($product['quantity'] * ($product['price'] - ($product['price'] * $product['discount'])/100)) }}₫</b></p></td>
                    <td><a href="{{ url('cart/remove/'.$product['id']) }}" data-id="2479395"><i class="fa fa-trash"></i></a></td>
                  </tr>
                 @endforeach
                </tbody>
                @if(Cart::cartNumber() > 0)
                <tfoot>
                  <tr>
                    <td colspan="6"><a href="{{ url('cart/destroy') }}" class="button pull-left">Xóa toàn bộ</a> <a href="{{ url('') }}" class="button pull-right black">Tiếp tục mua hàng</a>
                      <input type="submit" class="button pull-right" value="Cập nhật"></td>
                  </tr>
                </tfoot>
                @endif
              </table>
            </div>
          </form>
          @if(Cart::cartNumber() > 0)
          <div class="total-cart"> Tổng tiền thanh toán:
            {{ number_format(Cart::cartTotal()) }}₫ <br>
            <a href="{{ url('cart/order') }}" class="button black">Thanh toán</a> </div>
        </div>
        @endif
@endif
@endsection