<!DOCTYPE html>
<html lang="en">
<head>
    <base href="{{ asset("") }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng ký tài khoản leo-food</title>
    <link rel="shortcut icon" href="/public/frontend/images/title2.jpg">
    <link rel="stylesheet" href="/public/frontend/css/style.css">
    <link rel="stylesheet" href="/public/frontend/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/frontend/fonts/css/all.css">
    <style>
        body {
            background-color: #f5f5f5;
        }
        #btn-dangnhap:hover{
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
                <h5>ĐĂNG KÝ</h5>
            </div>
            <div class="col-md-12 mt-4 p-0" style="background-color: white;">
                <div style="padding: 30px 300px">
                    <h5 style="background-color: #333; padding: 12px; color: #f8694d; margin-bottom: 0; text-align: center; border-top-left-radius: 4px; border-top-right-radius: 4px">ĐIỀN THEO MẪU DƯỚI ĐÂY ĐỂ ĐĂNG KÝ</h5>
                    <form onsubmit="return kiemTraDangKy()" action="{{ route('dang-ky-tai-khoan') }}" method="POST" style="padding: 20px; border: 1px solid #333; border-bottom-left-radius: 4px; border-bottom-right-radius: 4px">
                        @csrf
                        <div class="form-group">
                            <h6>Họ và tên</h6>
                            <input type="text" class="form-control form-control-sm" name="ten_tv" placeholder="Nhập họ và tên" required>
                        </div>
                        <div class="form-group">
                            <h6>Email</h6>
                            <input type="email" class="form-control form-control-sm" name="email_tv" placeholder="Nhập email" required>
                        </div>
                        <div class="form-group">
                            <h6>SĐT</h6>
                            <input type="text" class="form-control form-control-sm" name="sdt_tv" placeholder="Nhập số điện thoại" required>
                        </div>
                        <div class="form-group">
                            <h6>Mật khẩu</h6>
                            <input id="matkhau" type="password" class="form-control form-control-sm" name="matkhau" placeholder="Mật khẩu từ 6 đến 32 ký tự" minlength="6" maxlength="32" required>
                        </div>
                        <div class="form-group mb-4">
                            <h6>Nhập lại mật khẩu</h6>
                            <input id="matkhau2" type="password" class="form-control form-control-sm" name="matkhau2" placeholder="Nhập lại mật khẩu từ 6 đến 32 ký tự" required>
                            <small id="not-match" class="form-text" style="color: red"></small>
                        </div>
                        <button type="submit" class="btn btn-sm btn-secondary"><i class="fas fa-user"></i> ĐĂNG KÝ TÀI KHOẢN</button>
                        <span>hoặc <a id="btn-dangnhap" href="{{ route('dang-nhap') }}">Đăng nhập</a></span>
                    </form>
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
        function kiemTraDangKy(){
            var ok = true;
            var matKhau = document.getElementById('matkhau').value;
            var nhapLaiMatKhau = document.getElementById('matkhau2').value;
            if(matKhau != nhapLaiMatKhau){
                document.getElementById('not-match').innerHTML =
                "<i class='fa fa-exclamation-triangle'></i> Nhập lại mật khẩu chưa khớp";
                document.getElementById("not-match").style.marginLeft = "3%";
                ok = false;
            }
            return ok;
        }
    </script>
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