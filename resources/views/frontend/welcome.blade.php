<!DOCTYPE html>
<html lang="en">
<head>
    <base href="{{ asset('') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trang chủ</title>
    <link rel="shortcut icon" href="/public/frontend/images/title2.jpg">
    <link rel="stylesheet" href="/public/frontend/css/style.css">
    <link rel="stylesheet" href="/public/frontend/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/frontend/fonts/css/all.css">
    <style>
        #test{
            background-image: url("/public/frontend/images/pic.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            height: 100vh;
        }
    </style>
</head>
<body>
    {{--  @include('frontend.header')  --}}
    <div id="test">
        <div style="width: 60%; text-align: center; color: white; padding-top: 30vh; margin: 0 auto">
            <div style="padding: 25px 25px; background-color: rgba(52, 52, 52, 0.5); border-radius: 5px">
                <h4 style="font-weight: bold; margin-bottom: 20px">CHỌN VỊ TRÍ CỦA BẠN</h4>
                <form action="" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 p-1">
                            <select class="form-control">
                                <option value="">Chọn thành phố</option>
                                <option value="">Cần Thơ</option>
                            </select>
                        </div>
                        <div class="col-md-4 p-1">
                            <select class="form-control">
                                <option value="">Chọn quận</option>
                                <option value="">Cái Răng</option>
                                <option value="">Ninh Kiều</option>
                            </select>
                        </div>
                        <div class="col-md-4 p-1">
                            {{-- <button type="submit" class="btn btn-primary w-100">HIỂN THỊ</button> --}}
                            <a href="{{ route('trang-chu') }}" class="btn btn-primary w-100">HIỂN THỊ</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- <img src="/public/frontend/images/pic.jpg" style="width: 100%; height: 100vh"> --}}
    <div class="container mt-5 mb-5">
        <div style="text-align: center; margin-bottom: 40px">
            <p style="font-size: 30px">ĐẶT THỨC ĂN VÔ CÙNG DỄ DÀNG</p>
            <p style="font-size: 25px; font-weight: bold; color: #f80">VỚI 3 BƯỚC!</p>
        </div>
        <div class="row" style="padding: 30px">
            <div class="col-md-4" style="text-align: center">
                <img src="/public/frontend/images/step1.jpg" style="width: 115px; height:100px; margin-bottom: 20px">
                <h5>Chọn vị trí của bạn</h5>
                <p style="color: #666">Chọn quận của bạn để hiển thị các sản phẩm</p>
            </div>
            <div class="col-md-4" style="text-align: center">
                <img src="/public/frontend/images/step2.jpg" style="width: 100px; height:100px; margin-bottom: 20px">
                <h5>Chọn món ăn muốn mua</h5>
                <p style="color: #666">Bạn muốn ăn gì? Chọn những món bạn thích</p>
            </div>
            <div class="col-md-4" style="text-align: center">
                <img src="/public/frontend/images/step3.jpg" style="width: 145px; height:100px; margin-bottom: 20px">
                <h5>Tiến hành thanh toán</h5>
                <p style="color: #666">Thanh toán tiền mặt hay Thẻ tín dụng PayPal</p>
            </div>
        </div>
    </div>
    {{--  @include('frontend.footer')  --}}
    {{-- ### --}}
    <script src="/public/frontend/js/bootstrap.min.js"></script>
    <script src="/public/frontend/js/jquery-3.4.1.min.js"></script>
    <script src="/public/frontend/js/bootstrap.bundle.min.js"></script>
</body>
</html>