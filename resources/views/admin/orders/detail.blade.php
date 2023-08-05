@extends("admin.layout")
@section("do-du-lieu-tu-view")

@php
    //lấy thông tin đơn hàng
    function getOrder($order_id){
        $order = DB::table("orders")->where("id","=",$order_id)->first();
        return $order;
    }
    //lấy thông tin customer
    function getCustomer($customer_id){
        $customer = DB::table("customers")->where("id","=",$customer_id)->first();
        return $customer;
    }
    //lấy thông tin sản phẩm thuộc đơn hàng
    function getProducts($order_id){
        $products = DB::table("order_details")->join("products","products.id","=","order_details.product_id")->select("products.name","products.photo","products.discount","order_details.quantity","order_details.price")->get();
        return $products;
    }
@endphp

@php
    $order = getOrder($order_id);
    $customer = getCustomer($order->customer_id)
@endphp
    <div class="col-md-12">
    <div style="margin-bottom:5px;">        
        <a href="#" onclick="history.go(-1);" class="btn btn-primary">Quay lại</a>
        @if($order->status == 0)
        <a href="{{ url('backend/orders/update/'.$order->id) }}" class="btn btn-danger">Thực hiện giao hàng</a>     
        @endif    
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">Thông tin đơn hàng</div>
        <div class="panel-body">
            <table class="table">
                <tr>
                    <td style="width:200px;">Tên khách hàng</td>
                    <td>{{ isset($customer->name) ? $customer->name : "" }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ isset($customer->email) ? $customer->email : "" }}</td>
                </tr>
                <tr>
                    <td>ngày mua</td>
                    <td>{{ isset($order->date) ? date("d/m/Y", strtotime($order->date)) : "" }}</td>
                </tr>
                <tr>
                    <td>Tổng giá</td>
                    <td>{{ isset($order->price) ? $order->price : "" }}</td>
                </tr>
                <tr>
                    <td>Trạng thái giao hàng</td>
                    <td>{{ $order->status == 1 ? "Đã giao hàng" : "Chưa giao hàng" }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">Chi tiết đơn hàng</div>
        <div class="panel-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th style="width:100px;">Photo</th>
                    <th>Name</th>
                    <th style="width:100px;">Price</th>
                    <th style="width:80px;">Discount</th>
                    <th style="width:80px;">Quantity</th>
                </tr>
                @php
                    $products = getProducts($order_id);
                @endphp
                @foreach($products as $row)
                <tr>
                    <td>
                        @if($row->photo != "" && file_exists('upload/products/'.$row->photo))
                        <img src="{{ asset('upload/products/'.$row->photo) }}" style="width:100px;">
                        @endif
                    </td>
                    <td>{{ $row->name }}</td>
                    <td>{{ number_format($row->price) }}</td>
                    <td style="text-align:center;">{{ $row->discount }}%</td>
                    <td style="text-align:center;">{{ $row->quantity }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection