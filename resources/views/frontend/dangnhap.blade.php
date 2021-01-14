<!DOCTYPE html>
<html lang="en">
<head>
    <base href="{{ asset("") }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng nhập tài khoản leo-food</title>
    <link rel="shortcut icon" href="/public/frontend/images/title2.jpg">
    <link rel="stylesheet" href="/public/frontend/css/style.css">
    <link rel="stylesheet" href="/public/frontend/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/frontend/fonts/css/all.css">
    <style>
        body {
            background-color: #f5f5f5;
        }
        #text-resetPass:hover{
            text-decoration: none;
            color: #f8694d;
        }
    </style>
</head>
<body>
    @include('frontend.header')
    <div class="container mt-3" >
        <div class="row p-1">
            <div class="col-md-12 p-1" style="border-bottom: 1px solid grey; color: #f8694d">
                <h5>ĐĂNG NHẬP</h5>
            </div>
            <div class="col-md-12 mt-4 p-0">
                <img src="/public/frontend/images/fb-btn.svg" style="width:140px">
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6 p-3" style="background-color: white; border-right: 10px solid #f5f5f5">
                        <h5 style="background-color: #333; padding: 12px; color: #f8694d">ĐĂNG NHẬP</h5>
                        <small class="form-text text-muted mb-3">Nếu bạn có tài khoản, hãy đăng nhập dưới đây</small>
                        <form action="{{ route('dang-nhap-tai-khoan') }}" method="POST">
                            @csrf
                            <div class="form-group">
                              <h6>Email</h6>
                              <input type="email" name="email" class="form-control" required placeholder="Nhập email của bạn">
                            </div>
                            <div class="form-group">
                              <h6>Mật khẩu</h6>
                              <input type="password" name="matkhau" class="form-control" required placeholder="Nhập mật khẩu của bạn">
                            </div>
                            @if (session()->has('dntb'))
                                <div class="alert alert-danger" id="danger-alert">
                                    <strong><i class='fas fa-exclamation-triangle'></i> Thông báo! </strong>
                                    {{ session('dntb') }}
                                </div>
                            @endif
                            <button type="submit" class="btn btn-sm btn-secondary"><i class="fas fa-lock"></i> ĐĂNG NHẬP</button>
                            <a id="text-resetPass" href="{{ route('lay-lai-mat-khau') }}">Quên mật khẩu?</a>
                          </form>
                    </div>
                    <div class="col-md-6 p-3" style="background-color: white; border-left: 10px solid #f5f5f5">
                        <h5 style="background-color: #333; padding: 12px; color: #f8694d">ĐĂNG KÝ</h5>
                        <small class="form-text text-muted mb-3">Tạo tài khoản để quản mua hàng, và các thông tin thanh toán, gửi hàng một cách đơn giản hơn</small>
                        <a href="{{ route('dang-ky') }}" class="btn btn-sm btn-secondary"><i class="fas fa-user"></i> TẠO TÀI KHOẢN</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('frontend.footer')
    
    {{-- ### --}}
    <script src="/public/frontend/js/jquery-3.4.1.min.js"></script>
    <script src="/public/frontend/js/jquery-ui.min.js"></script>
    <script src="/public/frontend/js/bootstrap.bundle.min.js"></script>
    <script src="/public/frontend/js/myScript.js"></script>
    <script>
        $('#searchSP').on('keyup',function(){
                $value = $(this).val();
                $.ajax({
                    type: 'post',
                    url: '/tim-ten-san-pham',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'value': $value
                    },
                    success:function(reponse){
                        $('#change-tenSP').html(reponse);
                    }
                });
            });
    </script>
</body>
</html>