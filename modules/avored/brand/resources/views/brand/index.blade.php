@extends('layouts.app')

@section('meta_title')
    Test Brand Title
@endsection

@section('content')
    <div class="row">

        <div class="col-12">
            <div class="row">
                @if(count($products) <= 0)
                    <p>Không tìm thấy sản phẩm</p>
                @else

                    @foreach($products as $product)
                        <div class="col-4">
                            @include('product.view.product-card',['product' => $product])
                        </div>
                    @endforeach
                    <div class="clearfix"></div>
                    {!!  $products->links('pagination.bootstrap-4') !!}
                @endif
            </div>
        </div>

    </div>
@endsection
