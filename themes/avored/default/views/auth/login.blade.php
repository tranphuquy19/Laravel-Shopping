@extends('layouts.app')

@section('meta_title', 'Login: AvoRed E commerce')
@section('meta_description', 'My Account Management System for AvoRed E Commerce')


@section('content')
    <div class="row mt-4 mb-4 justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-header"><span>SmartWatch Chip Chip Login</span></div>
                <div class="card-body">
                    <div class="col-12">
                        <form method="POST"
                              action="{{ route('login.post') }}">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="email">Địa chỉ E-Mail</label>


                                <input id="email" type="email" name="email"
                                       class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                       value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password"
                                       class="form-control {{ $errors->has('password') ? ' has-error' : '' }}"
                                       type="password" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                            </div>

                            <div class="checkbox">
                                <label>
                                    <input id="rememberme" type="checkbox" name="remember"/>
                                    Nhớ tôi
                                </label>
                            </div>


                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    Đăng nhập
                                </button>
                                <a class="" href="{{ url('/password/reset') }}">
                                    Quên mật khẩu?
                                </a>
                                <a class="" href="{{ url('register') }}">
                                    Tạo mật khẩu
                                </a>
                                @if($errors->has('enableResendLink'))
                                    <div class="form-group">
                                        <a class="" href="{{ route('user.activation.resend') }}">
                                            Gửi lại Email kích hoạt
                                        </a>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <a class="btn btn-warning" href="{{ route('login.provider', 'facebook') }}">
                                    Login via <i class="fab fa-facebook"></i>   
                                </a>
                                <a class="btn btn-warning" href="{{ route('login.provider', 'google') }}">
                                    Login via <i class="fab fa-google"></i>   
                                </a>
                                <a class="btn btn-warning" href="{{ route('login.provider', 'twitter') }}">
                                    Login via <i class="fab fa-twitter"></i>   
                                </a>
                               
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
