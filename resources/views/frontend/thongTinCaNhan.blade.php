<!DOCTYPE html>
<html lang="en">
<head>
    <base href="{{ asset("") }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thông tin cá nhân leo-food</title>
    <link rel="shortcut icon" href="/public/frontend/images/title2.jpg">
    <link rel="stylesheet" href="/public/frontend/css/style.css">
    <link rel="stylesheet" href="/public/frontend/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/frontend/fonts/css/all.css">
    <style>
        body {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    @include('frontend.header')
    <div class="container mt-3" >
        <div class="row p-1">
            <div class="col-md-12 p-1" style="border-bottom: 1px solid grey; color: #f8694d">
                <h5>THÔNG TIN CÁ NHÂN</h5>
            </div>
            <div class="col-md-12 mt-4 p-0" style="background-color: white;">
                <form action="{{ route('cap-nhat-ttcn') }}" method="POST" onsubmit="return kiemTraMatKhau()" enctype="multipart/form-data">
                    @csrf
                    @foreach ($thanhvien as $data)
                    @endforeach
                    <div class="row p-3">
                        <div class="col-md-9 pt-2 pl-5 pr-5">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên</label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="ma_tv" value="{{ $data->ma_tv }}">
                                    <input type="text" name="ten_tv" class="form-control" value="{{ $data->ten_tv }}" required placeholder="Họ tên của bạn">
                                    <small class="form-text"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">SĐT</label>
                                <div class="col-sm-9">
                                    <input type="text" name="sdt_tv" class="form-control" value="{{ $data->sdt_tv }}" required placeholder="SĐT của bạn">
                                    <small class="form-text"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Mật khẩu</label>
                                <div class="col-sm-9">
                                    <input id="matkhau" type="password" class="form-control" name="matkhau" placeholder="Nhập mật khẩu hiện tại của bạn">
                                    <span class="form-text">
                                        @if (session()->has('mktb'))
                                            <div class="alert alert-danger" id="danger-alert">
                                                <strong><i class='fas fa-exclamation-triangle'></i> Thông báo! </strong>
                                                {{ session('mktb') }}
                                            </div>
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Mật khẩu mới</label>
                                <div class="col-sm-9">
                                    <input id="matkhaumoi1" type="password" class="form-control" name="matkhaumoi1" minlength="6" maxlength="32" placeholder="Nhập mật khẩu mới">
                                    <small class="form-text"></small>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nhập lại mật khẩu mới</label>
                                <div class="col-sm-9">
                                    <input id="matkhaumoi2" type="password" class="form-control" name="matkhaumoi2" placeholder="Nhập lại mật khẩu mới">
                                    <small id="message" class="form-text" style="color: red"></small>
                                </div>
                              </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-md-6 pr-1">
                                            <button class="btn btn-primary w-100" type="submit">Cập nhật</button>
                                        </div>
                                        <div class="col-md-6 pl-1">
                                            <button class="btn btn-light w-100" type="reset" style="background-color: #e9ecef; border: 1px solid #ced4da">Đặt lại</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 pt-1" style="text-align: center">
                            <p><img id="hinh" src="{{ $data->hinh_tv }}" style="width: 220px; height: 207px; border-radius: 50%; border: 2px solid gray"></p>
                            <div class="upload-btn-wrapper">
                                <button class="btnImg">Chọn ảnh</button>
                                <input type="file" name="hinh_tv" onchange="return changePicture()">
                            </div>
                        </div>
                    </div>
                </form>
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