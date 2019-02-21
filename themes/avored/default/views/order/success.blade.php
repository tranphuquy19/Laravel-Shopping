@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">

            <h1>Đặt hàng thành công!</h1>

            <a class="btn btn-primary" href="{{ route('my-account.home') }}">Tài khoản của tôi</a>
            <a class="btn btn-primary" href="{{ route('home') }}">Tiếp tục thanh toán</a>
        </div>
    </div>

@endsection
