<!DOCTYPE html>
<html lang="en">
<head>
    <base href="{{ asset("") }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đơn hàng của bạn leo-food</title>
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
                <h5>ĐƠN HÀNG CỦA BẠN</h5>
            </div>
            <div id="change-donhang" class="col-md-12 p-0">
                <div class="mt-4">
                    <nav class="nav nav-pills flex-column flex-sm-row" style="background-color: white">
                        <a class="flex-sm-fill text-sm-center nav-link" style="border-bottom: 2px solid #17a2b8; color: #17a2b8; border-radius: 0;"><b>Tất cả</b></a>
                        <a class="flex-sm-fill text-sm-center nav-link" onclick="return donHangChoXN()" style="color: #17a2b8; cursor: pointer"><b>Chờ xác nhận</b></a>
                        <a class="flex-sm-fill text-sm-center nav-link" onclick="return donHangDangGiao()" style="color: #17a2b8; cursor: pointer"><b>Đang giao</b></a>
                        <a class="flex-sm-fill text-sm-center nav-link" onclick="return donHangDaGiao()" style="color: #17a2b8; cursor: pointer"><b>Đã giao</b></a>
                    </nav>
                </div>
                @foreach ($donhang as $item)
                @endforeach
                @if (!empty($item->ma_dh))
                    @foreach ($donhang as $dh)
                    <div class="col-md-12 mt-4 p-0" style="background-color: white;">
                        <div class="card" style="border: 0">
                            <div class="card-header" style="background-color: white;">
                                <table style="width: 100%">
                                    <tr>
                                        <td>
                                            <button class="btn btn-sm btn-danger" style="border: none; background-color: #f9694e;padding: 0px 8px"><i class="fas fa-comment-dots"></i> chat bot</button>
                                            <button class="btn btn-sm btn-dark" style="border: none;padding: 0px 8px"><i class="fas fa-store" style="font-size: 12px"></i> xem shop</button>
                                        </td>
                                        <td style="text-align: right;">
                                            @if ($dh->trang_thai_dh == 0)
                                                <span style="color: goldenrod"><i class="fas fa-clipboard-check"></i> CHỜ XÁC NHẬN</span>
                                            @elseif($dh->trang_thai_dh == 1)
                                                <span style="color: orangered"><i class="fas fa-truck-moving"></i> ĐANG GIAO</span>
                                            @else
                                                <span style="color: green"><i class="fas fa-check-circle"></i> ĐÃ GIAO</span>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="card-body">
                                @foreach ($chitietdonhang as $ctdh)
                                    @if ($ctdh->ma_dh == $dh->ma_dh)
                                        <div class="card mb-3" style="max-width: 100%; border: none; border-bottom: 1px solid #ccc; border-radius: 0">
                                            <div class="row no-gutters">
                                                <div class="col-md-2">
                                                    <img src="{{ $ctdh->sanpham->hinh_sp }}" class="card-img mb-3" style="width: 80%; height: 80px;">
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="card-body p-0 pt-3">
                                                        <div class="row" style="text-align: center">
                                                            <div class="col-md-3">
                                                                <h6 class="card-text">Tên sản phẩm
                                                                    @foreach ($sanphamkhuyenmai as $spkm)
                                                                        @if ($ctdh->ma_sp == $spkm->ma_sp && date('Y-m-d H:i:s', strtotime($dh->created_at)) >= date('Y-m-d H:i:s', strtotime($spkm->khuyenmai->ngay_bd)) && date('Y-m-d H:i:s', strtotime($dh->created_at)) <= date('Y-m-d H:i:s', strtotime($spkm->khuyenmai->ngay_kt)))
                                                                            @if($spkm->khuyenmai->loai_km == 1)
                                                                                <small style="color: red">(-{{ $spkm->khuyenmai->gia_tri_km }}%)</small>
                                                                            @else
                                                                                <small style="color: red">(-{{ number_format($spkm->khuyenmai->gia_tri_km,0,'.','.') }}<sup>VNĐ</sup>)</small>
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                </h6>
                                                                <p class="card-text"><small>{{ $ctdh->sanpham->ten_sp }}</small></p>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <h6 class="card-text">Số lượng</h6>
                                                                <p class="card-text"><small>x{{ $ctdh->soluong }} </small></p>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <h6 class="card-text">Đơn giá</h6>
                                                                <p class="card-text"><small>{{ number_format($ctdh->sanpham->gia_sp,0,'.','.') }}<sup>VNĐ</sup></small></p>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <h6 class="card-text">Thành tiền</h6>
                                                                <p class="card-text">
                                                                    <small>
                                                                        {{ number_format($ctdh->sanpham->gia_sp * $ctdh->soluong,0,'.','.') }}<sup>VNĐ</sup>
                                                                        @foreach ($sanphamkhuyenmai as $spkm)
                                                                            @if ($ctdh->ma_sp == $spkm->ma_sp && date('Y-m-d H:i:s', strtotime($dh->created_at)) >= date('Y-m-d H:i:s', strtotime($spkm->khuyenmai->ngay_bd)) && date('Y-m-d H:i:s', strtotime($dh->created_at)) <= date('Y-m-d H:i:s', strtotime($spkm->khuyenmai->ngay_kt)))
                                                                                @if($spkm->khuyenmai->loai_km == 1)
                                                                                    <span style="color: red">({{ number_format(($ctdh->sanpham->gia_sp - (($ctdh->sanpham->gia_sp * $spkm->khuyenmai->gia_tri_km) / 100)) * $ctdh->soluong,0,'.','.') }}<sup>VNĐ</sup>)</span>
                                                                                @else
                                                                                    <span style="color: red">({{ number_format(($ctdh->sanpham->gia_sp - $spkm->khuyenmai->gia_tri_km) * $ctdh->soluong,0,'.','.') }}<sup>VNĐ</sup>)</span>
                                                                                @endif
                                                                            @endif
                                                                        @endforeach
                                                                    </small>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                <div style="text-align: right">
                                    <p>Phí giao hàng: <span>15.000<sup>VNĐ</sup></span></p>
                                    <p>Tổng tiền: <span style="color: red; font-size: 22px">{{ number_format($dh->tongtien,0,'.','.') }}<sup>VNĐ</sup></span></p>
                                    <a href="" class="btn btn-sm btn-info pl-4 pr-4" data-toggle="modal" data-target="#FormChiTietDH{{ $dh->ma_dh }}">Xem chi tiết đơn hàng</a>
                                    @if ($dh->trang_thai_dh == 2)
                                        <a href="{{ route('xoa-dh-dg', $dh->ma_dh) }}" onclick="return XacNhanXoa()" class="btn btn-sm btn-danger">Xóa đơn hàng</a>
                                    @endif
                                </div>
                            </div>
                        </div> 
                    </div>
                    @endforeach
                @else
                    <div class="col-md-12 mt-4 p-0" style="background-color: white;">
                        <div style="text-align: center; padding: 80px 0">
                            <img src="/public/frontend/images/temp1.webp" style="width: 100px; height: 100px; margin: 0 auto">
                            <p style="margin-top: 10px">Chưa có đơn hàng!</p>
                        </div>
                    </div>
                @endif
            </div>
            {{--  Chi tiết đơn hàng  --}}
            @foreach ($donhang as $dh)
            <div class="modal fade" id="FormChiTietDH{{ $dh->ma_dh }}" data-backdrop="static" tabindex="-1">
                <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" >
                    <div class="modal-content" style="position: relative;">
                        <div class="modal-header" style="padding: 7px 0 0 15px; border-bottom: 1px solid #8BD816">
                            <h5 style="color: #8BD816; font-weight:bold">Xem chi tiết đơn hàng</h5>
                            <button type="button" class="close" data-dismiss="modal" style="position: absolute; top: 7px; right: 7px;">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-8">
                                    @foreach ($chitietdonhang as $ctdh)
                                        @if ($ctdh->ma_dh == $dh->ma_dh)
                                        <div class="card mb-3" style="max-width: 100%; border: none; border-bottom: 1px solid #ccc; border-radius: 0">
                                            <div class="row no-gutters">
                                                <div class="col-md-2">
                                                    <img src="{{ $ctdh->sanpham->hinh_sp }}" class="card-img mb-3" style="width: 80%; height: 80px">
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="card-body p-0 pt-3">
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <h6 class="card-text">Tên sản phẩm
                                                                    @foreach ($sanphamkhuyenmai as $spkm)
                                                                        @if ($ctdh->ma_sp == $spkm->ma_sp && date('Y-m-d H:i:s', strtotime($dh->created_at)) >= date('Y-m-d H:i:s', strtotime($spkm->khuyenmai->ngay_bd)) && date('Y-m-d H:i:s', strtotime($dh->created_at)) <= date('Y-m-d H:i:s', strtotime($spkm->khuyenmai->ngay_kt)))
                                                                            @if($spkm->khuyenmai->loai_km == 1)
                                                                                <small style="color: red">(-{{ $spkm->khuyenmai->gia_tri_km }}%)</small>
                                                                            @else
                                                                                <small style="color: red">(-{{ number_format($spkm->khuyenmai->gia_tri_km,0,'.','.') }}<sup>VNĐ</sup>)</small>
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                </h6>
                                                                <p class="card-text"><small>{{ $ctdh->sanpham->ten_sp }}</small></p>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <h6 class="card-text">Số lượng</h6>
                                                                <p class="card-text"><small>x{{ $ctdh->soluong }} </small></p>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <h6 class="card-text">Đơn giá</h6>
                                                                <p class="card-text">
                                                                    <small>
                                                                    {{ number_format($ctdh->sanpham->gia_sp,0,'.','.') }}<sup>VNĐ</sup>
                                                                    </small>
                                                                    @foreach ($sanphamkhuyenmai as $spkm)
																	@if($ctdh->sanpham->ma_sp == $spkm->ma_sp && date('Y-m-d H:i:s', strtotime($dh->created_at)) >= date('Y-m-d H:i:s', strtotime($spkm->khuyenmai->ngay_bd)) && date('Y-m-d H:i:s', strtotime($dh->created_at)) <= date('Y-m-d H:i:s', strtotime($spkm->khuyenmai->ngay_kt)))
																		@if($spkm->khuyenmai->loai_km == 1)
																			<small><i class="fa fa-arrow-right"></i> </small><span style="color: red;">{{ number_format($ctdh->sanpham->gia_sp - (($ctdh->sanpham->gia_sp * $spkm->khuyenmai->gia_tri_km) / 100),0,'.','.') }}<sup>VNĐ</sup></span>
																		@else
																			<small><i class="fa fa-arrow-right"></i> </small><span style="color: red;">{{ number_format($ctdh->sanpham->gia_sp - $spkm->khuyenmai->gia_tri_km,0,'.','.') }}<sup>VNĐ</sup></span>
																		@endif
																	@endif
																@endforeach
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="col-md-4">
                                    <div class="card" style="padding: 10px; background-color: #EEEEEE; border-radius: 3px;">
                                        <div class="card-body">
                                            <p><span style="color: black">Khách hàng:</span> <span>{{ $dh->ten_nn }}</span></p>
                                            <p><span style="color: black">Email:</span> <span>{{ $dh->email_nn }}</span></p>
                                            <p><span style="color: black">SĐT:</span> <span>{{ $dh->sdt_nn }}</span></p>
                                            <p><span style="color: black">Địa chỉ giao hàng:</span> <span>{{ $dh->diachi_nn }}</span></p>
                                            <p><span style="color: black">Phí giao hàng:</span> <span>{{ number_format(15000,0,'.','.') }}<sup>VNĐ</sup></span></p>
                                            <p><span style="color: black">Ngày đặt:</span> <span>{{ $dh->created_at }}</span></p>
                                            @if ($dh->trang_thai_tt == 2)
                                                <p><span style="color: black">Tình trạng:</span> <span style="color: green">Đã thanh toán VNPay</span></p>
                                            @elseif($dh->trang_thai_tt == 1)
                                                <p><span style="color: black">Tình trạng:</span> <span style="color: green">Đã thanh toán</span></p>
                                            @else
                                                <p><span style="color: black">Tình trạng:</span> <span style="color: red">Chưa thanh toán</span></p>
                                            @endif
                                            <p><span style="color: black">Tổng tiền:</span> <span style="color: red">{{ number_format($dh->tongtien,0,'.','.') }}<sup>VNĐ</sup></span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
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