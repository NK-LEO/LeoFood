<!DOCTYPE html>
<html lang="en">
<head>
    <base href="{{ asset("") }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liên hệ leo-food</title>
    <link rel="shortcut icon" href="/public/frontend/images/title2.jpg">
    <link rel="stylesheet" href="/public/frontend/css/style.css">
    <link rel="stylesheet" href="/public/frontend/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/frontend/fonts/css/all.css">
</head>
<body>
    @include('frontend.header')
    <div class="container mt-3">
        <div class="row p-1">
            <div class="col-md-12 p-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="border-radius: 0">
                      <li class="breadcrumb-item"><a href="">Trang chủ</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Liên hệ</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12 p-0">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1964.3389561143483!2d105.76725759840427!3d10.043414794819471!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0881024c631e7%3A0x3aef08348dc0699!2zSOG6u20gMzU5LCBBbiBIw7JhLCBOaW5oIEtp4buBdSwgQ-G6p24gVGjGoSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1567008155110!5m2!1svi!2s" width="100%" height="500px" frameborder="0" style="border:5px solid #F0F4F7;" allowfullscreen=""></iframe>
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