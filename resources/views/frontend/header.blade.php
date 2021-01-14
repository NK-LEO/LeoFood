{{--  #1  --}}
<div id="back-top">
    <div class="container" style="padding: 0">
        <div class="row">
            <div class="col-md-6" style="margin: auto 0"></div>
            <div class="col-md-6" id="right">
                @if (session()->has('ma_tv'))
                    <div class="dropdown">
                        <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                            <span>
                                <img src="{{ session('hinh_tv') }}" style="width: 25px; height: 25px; border-radius: 50%">
                                <small style="color: #f9694e">{{ session('ten_tv') }}</small>
                            </span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <small>
                            <a class="dropdown-item" href="{{ route('thong-tin-cn') }}"><i class="fas fa-user-cog"></i> Thông tin cá nhân</a>
                            <a class="dropdown-item" href="{{ route('dh-cua-ban') }}"><i class="fas fa-hand-holding-heart"></i> Đơn hàng của bạn</a>
                            <a class="dropdown-item" href="{{ route('dang-xuat') }}"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
                          </small>
                        </div>
                      </div>
                @else
                    <a href="{{ route('dang-nhap') }}">ĐĂNG NHẬP</a> |
                    <a href="{{ route('dang-ky') }}">ĐĂNG KÝ</a>
                @endif
            </div>
        </div>
    </div>
</div>

{{--  #2  --}}
<div class="container-fluid pt-4 pb-4" style="background-color: white; box-shadow: 1px 1px 2px #EEEEEE;">
    <div class="container">
        <div class="row p-1">
            <div class="col-md-2 p-0" id="col-header-I">
                <a href=""><img src="/public/frontend/images/logo_blue.png"></a>
            </div>
            <div class="col-md-8" id="col-header-II">
                <ul class="nav justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link active" href="">TRANG CHỦ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">TIN TỨC</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('gioi-thieu') }}" class="nav-link" href="">GIỚI THIỆU</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('lien-he') }}" class="nav-link" href="">LIÊN HỆ</a>
                    </li>
                </ul>
                <form action="{{ route('tim-kiem-san-pham') }}" name="tenSP" method="POST" id="tim-kiem">
                    @csrf
                    <input list="listSP" id="searchSP" type="text" name="ten_sp" placeholder="Nhập từ khóa ..." required>
                    <input type="submit" name="" value="Tìm kiếm">
                </form>
                <p id="change-tenSP"></p>
            </div>
            <div class="col-md-2" id="col-header-III">
                <a href="{{ route('gio-hang') }}" class="btn btn-sm btn-success w-100">
                    <i class="fas fa-shopping-cart mr-1"></i>
                    Giỏ hàng của bạn 
                    {{--  <span class='badge badge-light'>
                        @php
                            echo Cart::count();
                        @endphp
                    </span>  --}}
                </a>
            </div>
        </div>
    </div>
</div>

@if (session('dangnhap'))
    <div class="alert alert-danger" id="danger-alert"
    style="position: fixed; text-align: center; width: 450px; height: 60px; border-radius: 0; right: 0; padding-top: 15px">
    <strong><i class='fas fa-exclamation-triangle'></i> Thông báo! </strong>
    {{ session('dangnhap') }}
    </div>
@endif
@if (session('thanhcong'))
    <div class="alert alert-success" id="success-alert"
    style="position: fixed; text-align: center; width: 450px; height: 60px; border-radius: 0; right: 0; padding-top: 15px">
    <strong><i class='fas fa-exclamation-triangle'></i> Thông báo! </strong>
    {{ session('thanhcong') }}
    </div>
@endif
@if (session('hoantat'))
    <div class="alert alert-success" id="success-alert"
    style="position: fixed; text-align: center; width: 450px; height: 60px; border-radius: 0; right: 0; padding-top: 15px">
    <strong><i class='fas fa-exclamation-triangle'></i> Thông báo! </strong>
    {{ session('hoantat') }}
    </div>
@endif