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
    @if (session()->has('fail'))
        <div class="alert alert-danger" role="alert" style="border-radius: 0">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Thông báo!</strong>
            {{ session('fail') }}
        </div>
    @endif
    <div class="form-gap"></div>
    <div class="row">
		<div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                  <h2 class="text-center">Quên mật khẩu?</h2>
                  <p>Bạn có thể đặt lại mật khẩu ở đây.</p>
                  <div class="panel-body">
    
                    <form action="{{ route('chuoi-bi-mat') }}" id="register-form" role="form" autocomplete="off" class="form" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                            <input id="email" name="email" placeholder="Nhập email" class="form-control"  type="email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Tiếp tục" type="submit">
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
</body>
</html>