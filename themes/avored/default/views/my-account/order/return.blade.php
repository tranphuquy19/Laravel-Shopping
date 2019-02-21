@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-3">
        @include('user.my-account.sidebar')
    </div>
    <div class="col-md-9">
        <div class="main-title-wrapper">
            <h2>Chi tiết đặt hàng</h2>
        </div>
        <div class="clearfix"></div>
        <div class="card mb-3">
            <div class="card-header">Thông tin chung</div>
            <div class="card-body">
                <table class="table">
                <tbody>
                    <tr>
                        <td>Số thứ tự</td>
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

        <div class="clearfix">&nbsp;</div>

        <div class="card mb-3">
            <div class="card-header">Đơn hàng</div>
            <div class="card-body">               
                <div class="table-responsive">

                    <form action="{{ route('my-account.order.return.post', $order->id) }}" method="post">
                        @csrf()
                    <table class="table">
                        <tbody>
                        <tr>
                            <th></th>
                            <th>Tên</th>
                            <th>SỐ lượng</th>
                            <th>Giá</th>
                            
                            <th>Lý do</th>
                        </tr>
                        @foreach($order->products as $product)
                            <tr>

                                <td> 
                                    <div class="form-check">
                                        <input class="form-check-input=""
                                                name="products[{{ $product->slug }}][slug]"
                                                type="checkbox" value="{{ $product->slug }}"
                                                id="order-product-{{ $product->slug }}">
                                        
                                    </div>
                                </td>
                                <td>
                                    {{ $product->name }}

                                    @foreach($order->orderProductVariation as $orderProductVariation)
                                        <p>
                                            {{ $orderProductVariation->attribute->name }}
                                            :
                                            {{   $orderProductVariation->attributeDropdownOption->display_text }}

                                        </p>
                                        
                                    @endforeach

                                </td>
                                <td> 
                                    <div class="form-group">                  
                                        <select
                                            class="form-control"
                                            name="products[{{ $product->slug }}][qty]"
                                            >

                                            <option value="">Vui lòng chọn</option>
                                            @for($i = 0; $i<$product->getRelationValue('pivot')->qty; $i++)
                                                <option value="{{ $i+1 }}">{{ $i+1 }}</option>
                                            @endfor
                                        </select>
                                    </div>

                                </td>
                                <td> {{ $product->getRelationValue('pivot')->price }} </td>
                                <td> 
                                    <select
                                            class="form-control product-reason-dropdown"
                                            name="products[{{ $product->slug }}][reason]"
                                            >
                                        <option value="">Vui lòng chọn</option>
                                        <option value="Product comes Damage">
                                            Sản phẩm thiệt hại
                                        </option>
                                        <option value="Never Receive">
                                            Không nhận được
                                        </option>
                                        <option value="Other">
                                            Khác
                                        </option>
                                    </select>

                                    <div class="form-group other-reason d-none">
                                        <label>Lý do khác</label>
                                        <textarea
                                            name="comment"

                                            class="form-control"></textarea>
                                    </div>
                                    
                                </td>
                               
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="form-group">
                        <label>Bình luận</label>
                        <textarea
                            name="comment"

                            class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Hoàn tất trả hàng</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    jQuery(document).ready(function() {
        jQuery(document).on('change','.product-reason-dropdown', function(e){
            if(jQuery(this).val() == 'Other') {
                jQuery(this).parent().find('.other-reason').removeClass('d-none');
            } else {
                jQuery(this).parent().find('.other-reason').addClass('d-none');
            }
        });
    });
</script>
@endpush