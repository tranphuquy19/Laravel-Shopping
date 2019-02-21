@extends('layouts.app')

@section('meta_title','My Order List Account E commerce')
@section('meta_description','My Order List Account E commerce')

@section('content')
    <div class="row">
        <div class="col-md-3">
            @include('user.my-account.sidebar')
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Đơn hàng của tôi</div>
                <div class="card-body">
                    @if(count($orders) <= 0)
                        <p>Chúng tôi không tìm thấy mục nào.</p>
                    @else
                        <table class="table table-striped">
                            <thead>
                                <th>ID</th>
                                <th>Tùy chọn vận chuyển</th>
                                <th>Tùy chọn thanh toán</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->shipping_option}}</td>
                                        <td>{{ $order->payment_option }}</td>
                                        <td>{{ $order->orderStatus->name }}</td>
                                        <td><a href="{{ route('my-account.order.view',$order->id )}}">View</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>            
@endsection

