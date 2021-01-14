<!DOCTYPE html>
<html lang="en">
<head>
    <base href="{{ asset("") }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tìm kiếm sản phẩm leo-food</title>
    <link rel="shortcut icon" href="/public/frontend/images/title2.jpg">
    <link rel="stylesheet" href="/public/frontend/css/style.css">
    <link rel="stylesheet" href="/public/frontend/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/frontend/fonts/css/all.css">
    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
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
                <h5>KẾT QUẢ TÌM KIẾM : " <i>{{ $tenTimKiem }}</i> "</h5>
            </div>
            <div class="col-md-12 mt-4 p-0" style="background-color: white;">
                <div class="col-md-12" id="text">LEOFOOD</div>
                <div class="col-md-12" style="background-color: white">
                    <div class="row p-2 pb-4">
                        @foreach ($sanpham as $sp)
                            @if ($sp->soluong_sp > 0)
                                <div class="col-md-3 p-1">
                                    <div class="card" style="position: relative">
                                        <img src="{{ $sp->hinh_sp }}" class="card-img-top" style="height: 200px">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $sp->ten_sp }}</h5>
                                            <p>
                                                @foreach ($danhgia as $dg)
                                                    @if ($dg->ma_sp == $sp->ma_sp)
                                                        <b style="position: absolute; left: 0; top: 0; padding: 0 5px; background-color: #8BD816; color: white">
                                                            <small>{{ number_format($dg->so_sao,1,'.','.') }}<i class="fas fa-star"></i></small>
                                                        </b>
                                                    @endif
                                                @endforeach
                                            </p>
                                            <p class="card-text">Giá: 
                                                <span>{{ number_format($sp->gia_sp,0,'.','.') }}<sup>VNĐ</sup></span>
                                                @foreach ($sanphamkhuyenmai as $spkm)
                                                    @if($sp->ma_sp == $spkm->ma_sp && date('Y-m-d H:i:s') >= date('Y-m-d H:i:s', strtotime($spkm->khuyenmai->ngay_bd)) && date('Y-m-d H:i:s') <= date('Y-m-d H:i:s', strtotime($spkm->khuyenmai->ngay_kt)))
                                                        <span style="position: absolute; top: 0; right: 0; padding: 0 5px; background-color: Gold">
                                                            @if ($spkm->khuyenmai->loai_km == 1)
                                                                <small>Giảm {{ $spkm->khuyenmai->gia_tri_km }}%</small>
                                                            @else
                                                                <small>Giảm {{ number_format($spkm->khuyenmai->gia_tri_km,0,'.','.') }}<sup>VNĐ</sup></small>
                                                            @endif
                                                        </span>
                                                        @if ($spkm->khuyenmai->loai_km == 1)
                                                            <small><i class="fas fa-long-arrow-alt-right"></i> </small><span style="color: red; font-weight: bold">{{ number_format($sp->gia_sp - (($sp->gia_sp * $spkm->khuyenmai->gia_tri_km) / 100),0,'.','.') }}<sup>VNĐ</sup></span>
                                                        @else
                                                            <small><i class="fas fa-long-arrow-alt-right"></i> </small><span style="color: red; font-weight: bold">{{ number_format($sp->gia_sp - $spkm->khuyenmai->gia_tri_km,0,'.','.') }}<sup>VNĐ</sup></span>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </p>
                                            <table>
                                                <tr>
                                                    <td>
                                                        <button onclick="return themSPVaoGIo({{ $sp->ma_sp }})" type="submit" class="btn btn-sm btn-outline-success mr-1">
                                                            <i class="fas fa-cart-plus"></i> Mua</a>
                                                        </button>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('chi-tiet-san-pham',$sp->ma_sp) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-plus-circle"></i>
                                                            Xem chi tiết</a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach  
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
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
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
    <script>
        function themSPVaoGIo(ma_sp){
            $.ajax({
                url: '/them-sp-gio-hang',
                type: 'post',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'ma_sp': ma_sp
                },
            })
            .done(function(reponse){
                alertify.success('Đã thêm vào giỏ');
            });
        }
    </script>
</body>
</html>