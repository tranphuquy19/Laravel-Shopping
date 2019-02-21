@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-3">
        @include('user.my-account.sidebar')
    </div>
    <div class="col-md-9">
        <div class="main-title-wrapper">
            <h2>Chi tiết đơn hàng</h2>
        </div>
        <div class="clearfix"></div>
        <div class="card mb-3">
            <div class="card-header">Thông tin chung</div>
            <div class="card-body">
                <table class="table">
                <tbody>
                    <tr>
                        <td>Thứ thự</td>
                        <td>{{ $order->id }}</td>
                    </tr>
                    <tr>
                        <td>Phương thức thanh toán</td>
                        <td>{{ $order->payment_option }}</td>
                    </tr>
                    <tr>
                        <td>Phương thức vận chuyển</td>
                        <td>{{ $order->shipping_option }}</td>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header">Thông tin địa chỉ</div>
            <div class="card-body">
                
                <div class="row">
                    <div class="col-6">
                        <h6>Thông tin vận chuyển</h6>
                        <p>
                            {{ $order->shipping_address->first_name }} 
                            {{ $order->shipping_address->last_name }}
                            <br/>
                            {{ $order->shipping_address->address1 }}<br/>
                            {{ $order->shipping_address->address2 }}<br/>
                            {{ $order->shipping_address->area }}<br/>
                            {{ $order->shipping_address->city }}<br/>
                            {{ $order->shipping_address->state }} 
                            {{ $order->shipping_address->country->name }}<br/>
                            {{ $order->shipping_address->phone }}<br/>
                        </p>
                    </div>
                    <div class="col-6">
                        <h6>Thông tin thanh toán</h6>

                        <p>
                            {{ $order->billing_address->first_name }} {{ $order->billing_address->last_name }}
                            <br/>
                            {{ $order->billing_address->address1 }}<br/>
                            {{ $order->billing_address->address2 }}<br/>
                            {{ $order->billing_address->area }}<br/>
                            {{ $order->billing_address->city }}<br/>
                            {{ $order->billing_address->state }} {{ $order->shipping_address->country->name }}<br/>
                            {{ $order->billing_address->phone }}<br/>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix">&nbsp;</div>

        <div class="card mb-3">
            <div class="card-header">Danh mục</div>
            <div class="card-body">               
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Tộng</th>
                            <th>Hành động</th>
                        </tr>
                        @foreach($order->products as $product)
                            @php
                                $productInfo = json_decode($product->getRelationValue('pivot')->product_info);
                            @endphp
                            <tr>

                                <td> {{ $productInfo->id }}</td>
                                <td>
                                    {{ $productInfo->name }}

                                    @foreach($order->orderProductVariation as $orderProductVariation)
                                        <p>
                                            {{ $orderProductVariation->attribute->name }}
                                            :
                                            {{   $orderProductVariation->attributeDropdownOption->display_text }}

                                        </p>
                                        
                                    @endforeach

                                    @if($order->orderStatus->name == "Delivered" && $product->type === 'DOWNLOADABLE') 
                                    <div class="demo-downloadable">
                                        <a href="{{ route('my-account.product.main.download') }}" 
                                                onclick="event.preventDefault();
                                                        document.getElementById('download-main-product-media').submit();">
                                            Download Media
                                        </a>
                                        <form i d="download-main-product-media"
                                                method="post"
                                                action="{{ route('my-account.product.main.download') }}">
                                            @csrf()
                                            <input type="hidden" name="product_token"
                                                    value="{{ $product->downloadable->token }}" />
                                        </form>
                                    </div>
                                    @endif
                                </td>
                                <td> {{ $product->getRelationValue('pivot')->qty }} </td>
                                <td> {{ $product->getRelationValue('pivot')->price }} </td>
                                <td> 
                                    {{ $total = $product->getRelationValue('pivot')->price * $product->getRelationValue('pivot')->qty }} 
                                </td>
                                <td>
                                    <a href="{{ route('my-account.order.return', $order->id) }}" title="Order Return Request">
                                        Yêu cầu trả hàng
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

