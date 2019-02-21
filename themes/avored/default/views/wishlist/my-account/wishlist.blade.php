@extends('layouts.app')

@section('meta_title','My Wishlist List Account E commerce')
@section('meta_description','My Wishlist List Account E commerce')


@section('content')

    <div class="row profile">
        <div class="col-md-3">
            @include('user.my-account.sidebar')
        </div>
        <div class="col-md-9">
            <div class="title">
                <h4>Danh sách mong muốn</h4>
            </div>
            @if(count($wishlists) <= 0)
                <p>Không tìm thấy danh sách</p>
            @else

                <div class="card">
                    <div class="card-header">
                    Danh sách mong muốn của tôi
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive">
                            <thead>
                            <th>Tên sản phẩm</th>
                            <th>Ảnh sản phẩm</th>
                            <th>Hành động</th>
                            </thead>
                            <tbody>
                            @foreach($wishlists as $wishlist)
                                <tr>
                                    <td> {{ $wishlist->product->name }}</td>
                                    <td>
                                        <?php
                                        //dd();
                                        ?>
                                        @if(isset($wishlist->product->image) && is_string($wishlist->product->image->url))
                                            <img alt="{{ $wishlist->product->name }}"
                                                 class="img-responsive"
                                                 style="max-height: 75px"
                                                 src="{{ $wishlist->product->image->url }}"/>
                                        @else
                                            <img alt="{{ $wishlist->product->name }}"
                                                 class="img-responsive"
                                                 style="max-height: 75px"
                                                 src="{{ asset('vendor/avored-default/images/default-product.jpg') }}"/>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-danger"
                                           href="{{ route('my-account.wishlist.remove', $wishlist->product->slug ) }}">Remove from
                                            Danh sách mong muốn</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            @endif
        </div>
    </div>
@endsection
