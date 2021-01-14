<head>
    <title>In đơn hàng leo-food</title>
    <style>
        body{
            font-family: DejaVu Sans;
        }
    </style>
</head>
@foreach ($thongtindonhang as $dh)
@endforeach
<div style="float: left">
    <img src="{{ asset("/public/frontend/images/title2.jpg") }}" style="width: 100px; height: 100px; border-radius: 50px"><br>
    <span>LeoFood Shop</span><br>
    <span>Email: leofood3@gmail.com</span><br>
    <span>Điện thoại: 033-2370-223</span>
</div>
<div style="float: right">
    <span>Hóa đơn: #{{ $dh->ma_dh }}</span><br>
    <span>Ngày mua: {{ $dh->created_at }}</span>
</div>
<p style="clear: both"></p>
<div style="padding: 0 0 40px 0; text-align: right">
    <span>Người đặt: {{ $dh->ten_nn }}</span><br>
    <span>Điện thoại: {{ $dh->sdt_nn }}</span><br>
    <span>Địa chỉ: {{ $dh->diachi_nn }}</span>
</div>

<table style="width: 100%">
    @if (session()->has('giamgia'))
        <tr><td colspan="3" style="color: green; padding-bottom: 5px">Bạn đã được giảm 5% vào đơn hàng</td></tr>
    @endif
    <tr>
        <th style="text-align: left">Số lượng</th>
        <th style="padding: 0 0 0 100px; text-align: left">Đơn giá</th>
        <th style="text-align: left">Thành tiền</th>
    </tr>
    <tr><td colspan="3"><hr></td></tr>
    @foreach ($chitietdonhang as $ctdh)
            <tr>
                <td colspan="3">
                    {{ $ctdh->sanpham->ten_sp }}
                    @foreach ($sanphamkhuyenmai as $spkm)
                        @if ($ctdh->ma_sp == $spkm->ma_sp && date('Y-m-d H:i:s', strtotime($dh->created_at)) >= date('Y-m-d H:i:s', strtotime($spkm->khuyenmai->ngay_bd)) && date('Y-m-d H:i:s', strtotime($dh->created_at)) <= date('Y-m-d H:i:s', strtotime($spkm->khuyenmai->ngay_kt)))
                            @if($spkm->khuyenmai->loai_km == 1)
                                <small style="color: red">(-{{ $spkm->khuyenmai->gia_tri_km }}%)</small>
                            @else
                                <small style="color: red">(-{{ number_format($spkm->khuyenmai->gia_tri_km,0,'.','.') }}<sup>VNĐ</sup>)</small>
                            @endif
                        @endif
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>x {{ $ctdh->soluong }}</td>
                <td style="padding: 0 0 0 100px">{{ number_format($ctdh->sanpham->gia_sp,0,'.','.') }}<sup>VNĐ</sup></td>
                <td>
                    <span>{{ number_format($ctdh->sanpham->gia_sp * $ctdh->soluong,0,'.','.') }}<sup>VNĐ</sup></span>
                    @foreach ($sanphamkhuyenmai as $spkm)
                        @if ($ctdh->ma_sp == $spkm->ma_sp && date('Y-m-d H:i:s', strtotime($dh->created_at)) >= date('Y-m-d H:i:s', strtotime($spkm->khuyenmai->ngay_bd)) && date('Y-m-d H:i:s', strtotime($dh->created_at)) <= date('Y-m-d H:i:s', strtotime($spkm->khuyenmai->ngay_kt)))
                            @if($spkm->khuyenmai->loai_km == 1)
								<small style="color: red">({{ number_format(($ctdh->sanpham->gia_sp - (($ctdh->sanpham->gia_sp * $spkm->khuyenmai->gia_tri_km) / 100)) * $ctdh->soluong,0,'.','.') }}<sup>VNĐ</sup>)</small>
                            @else
							    <small style="color: red">({{ number_format(($ctdh->sanpham->gia_sp - $spkm->khuyenmai->gia_tri_km) * $ctdh->soluong,0,'.','.') }}<sup>VNĐ</sup>)</small>
                            @endif
                        @endif
                    @endforeach
                </td>
            </tr>
            <tr><td colspan="3"><hr></td></tr>  
        @endforeach
</table>
<div style="float: right; padding-top: 20px">
    <span>Tạm tính: {{ number_format($dh->tongtien - 15000,0,'.','.') }}<sup>VNĐ</sup></span><br>
    <span>Phí giao hàng: {{ number_format(15000,0,'.','.') }}<sup>VNĐ</sup></span><br>
    <span>Tổng tiền: <span style="color: red; font-size: 20px; font-weight: bold">{{ number_format($dh->tongtien,0,'.','.') }}<sup>VNĐ</sup></span></span>
</div>