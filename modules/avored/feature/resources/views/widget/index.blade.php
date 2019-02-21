
<div class="row">
    <div class="col-md-12">
        <div class="h2">Chức năng sản phẩm</div>
    </div>
</div>

<div class="row">
@foreach($products as $product)
    <div class="col-md-3">
        @include('product.view.product-card',['product' => $product])
    </div>

@endforeach

</div>