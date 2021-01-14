<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đặt lại mật khẩu leo-food</title>
    <link rel="shortcut icon" href="/public/frontend/images/title2.jpg">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <style>
        .form-gap {
            padding-top: 100px;
        }
    </style>
</head>
<body>
    @if (session()->has('saichuoibimat'))
        <div class="alert alert-danger" role="alert" style="border-radius: 0">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Thông báo!</strong>
            {{ session('saichuoibimat') }}
        </div>
    @endif
    <div class="form-gap"></div>
    <div class="row">
		<div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                  <h2 class="text-center">Đặt lại mật khẩu?</h2>
                  <p>Vui lòng kiểm tra lại email của bạn để biết được chuỗi bí mật.</p>
                  <div class="panel-body">
                    <form onsubmit="return kiemTraMatKhau()" action="{{ route('luu-mat-khau') }}" id="register-form" role="form" autocomplete="off" class="form" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-text-width"></i></i></span>
                            <input name="chuoi_bi_mat" placeholder="Nhập chuỗi bí mật gồm 8 ký tự" class="form-control" type="text" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input id="matkhau1" name="mat_khau_moi" placeholder="Nhập mật khẩu mới" class="form-control" type="password" minlength="6" maxlength="32" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input id="matkhau2" name="xac_nhan_mkm" placeholder="Xác nhận lại mật khẩu" class="form-control" onclick="return document.getElementById('message').innerHTML =''"  type="password" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <small style="color: red" id="message"></small>
                            </div>
                        </div>
                        <div class="form-group">
                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Đặt lại mật khẩu" type="submit">
                        </div> 
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
    {{-- ### --}}
    <script src="/public/frontend/js/jquery-3.4.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script>
        function kiemTraMatKhau(){
            var ok = true;
            var matkhau1 = document.getElementById("matkhau1").value;
            var matkhau2 = document.getElementById("matkhau2").value;
            if(matkhau2 != matkhau1){
                document.getElementById("message").innerHTML = "<i class='fa fa-exclamation-triangle'></i> Xác nhận mật khẩu chưa khớp";
                ok = false;
            }
            return ok;
        }
    </script>
</body>
</html>