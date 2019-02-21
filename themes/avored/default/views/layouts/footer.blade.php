<footer class="footer-main mt-3 pb-3 border border-bottom-0 border-left-0 border-right-0 pt-3">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h5>Thông tin</h5>
                <div class="footer-menu">
                    <ul>
                        <li class="nav item">
                            <a href="#">About us</a>
                        </li>
                        <li class="nav item">
                            <a href="#">Contact us</a>
                        </li>
                        <li class="nav item">
                            <a href="#">Chăm sóc khách hàng</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <h5>Chăm sóc khách hàng</h5>
                <ul>
                    <li class="nav item">
                        <a href="#">Privacy & Cookie Policy</a>
                    </li>
                    <li class="nav item">
                        <a href="{{ route('my-account.order.list') }}">Đặt hàng</a>
                    </li>
                    <li class="nav item">
                        <a href="#">Trả hàng</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-2">
            </div>
            <div class="col-md-4"> 
                @include('avored-subscribe::subscribe.form')
            </div>
        </div>
    </div>
</footer>

<footer class="bg-dark">
    <div class="container-fluid">
        <div class="footer-copyright text-center text-white">
            <span>Copyright &copy; {{ date('Y') }} 
                <a href="https://www.facebook.com/tranphuquy19" title="SmartWatch Chip Chip" target="_blank">SmartWatch Chip Chip</a> All rights reserved.
            </span>
        </div>
    </div>
</footer>
