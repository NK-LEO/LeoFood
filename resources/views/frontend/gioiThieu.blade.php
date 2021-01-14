<!DOCTYPE html>
<html lang="en">
<head>
    <base href="{{ asset("") }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Giới thiệu leo-food</title>
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
                      <li class="breadcrumb-item active" aria-current="page">Giới thiệu</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12 p-0">
                <div class="card-group content-goi-thieu">
                    <div class="card">
                        <img src="public/frontend/images/ff.gif" class="card-img-top img-left-right">
                        <label></label>
                        <div class="card-body">
                            <h5 class="card-title">ĐÔI NÉT VỀ LEOFOOD</h5>
                            <p class="card-text">
                                Với đội ngũ nhân viên trẻ được đào tạo chuyên nghiệp, năng động dưới sự dẫn dắt của chủ đầu tư có hơn 20 năm kinh nghiệm trong lĩnh vực làm bánh, chúng tôi luôn chủ động trong việc kiểm soát chất lượng đầu vào và đầu ra sản phẩm một cách toàn diện nhất nhằm đem đến tay người tiêu dùng sản phẩm tốt nhất
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <img src="public/frontend/images/exam.gif" class="card-img-top img-center">
                        <label></label>
                        <div class="card-body">
                            <h5 class="card-title">TRIẾT LÝ CỦA CHÚNG TÔI</h5>
                            <p class="card-text">
                                Sức khỏe khách hàng luôn được uư tiên và đặt lên hàng đầu.
                                Khách hàng là giá trị cơ bản nhất của công ty để tồn tại và phát triển bền vững.
                                Mang lại cho khách hàng những sản phẩm tốt nhất, chất lượng nhất, đảm bảo vệ sinh an toàn thực phẩm cùng với giá thành tốt nhất
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <img src="public/frontend/images/rokket.gif" class="card-img-top img-left-right">
                        <label></label>
                        <div class="card-body">
                            <h5 class="card-title">ĐỊNH HƯỚNG PHÁT TRIỂN</h5>
                            <p class="card-text">
                                Giữ vững và ngày càng tăng tốc độ phát triển trên mọi chỉ tiêu: doanh số, thị phần, nhân lực, giá trị thương hiệu, chất lượng sản phẩm, số lượng sản phẩm.
                                Phát huy và nâng cao thế mạnh sẵn có của công ty về quản lý, sản xuất,…lên một tầm cao mới để đáp ứng với những nhu cầu ngày càng cao của khách hàng
                            </p>
                        </div>
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