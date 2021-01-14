<div class="mt-4">
    <nav class="nav nav-pills flex-column flex-sm-row" style="background-color: white">
        <a class="flex-sm-fill text-sm-center nav-link" onclick="return tatCaDonHang()" style="color: #17a2b8; cursor: pointer"><b>Tất cả</b></a>
        <a class="flex-sm-fill text-sm-center nav-link" onclick="return donHangChoXN()" style="color: #17a2b8; cursor: pointer"><b>Chờ xác nhận</b></a>
        <a class="flex-sm-fill text-sm-center nav-link" onclick="return donHangDangGiao()" style="color: #17a2b8; cursor: pointer"><b>Đang giao</b></a>
        <a class="flex-sm-fill text-sm-center nav-link" style="border-bottom: 2px solid #17a2b8; color: #17a2b8; border-radius: 0;"><b>Đã giao</b></a>
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
                                    <img src="{{ $ctdh->sanpham->hinh_sp }}" class="card-img mb-3" style="width: 80%; height: 80px">
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