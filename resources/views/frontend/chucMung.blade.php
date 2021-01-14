<!DOCTYPE html>
<html lang="en">
<head>
    <base href="{{ asset("") }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đặt hàng thành công leo-food</title>
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
                <h5>ĐẶT HÀNG THÀNH CÔNG</h5>
            </div>
            <div class="col-md-12 mt-4 p-0" style="background-color: white;">
                <div style="text-align: center; padding: 20px 0">
                    <img src="/public/frontend/images/chucmung.jpg" style="width: 500px; height: 300px">
                    {{-- <p class="mt-3"><h6>Chúc mừng bạn đã đặt hàng thành công</h6></p> --}}
                    <p class="mt-3"><h5 style="color: #17a2b8">Chúc mừng bạn đã đặt hàng thành công</h5></p>
                    <a href="" class="btn btn-warning">Hãy tiếp tục mua sắm nào !!!</a>
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