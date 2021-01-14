<h4>THÔNG TIN ĐƠN HÀNG CỦA BẠN</h4>
@foreach ($thongtindonhang as $dh)
@endforeach
<table bgcolor="#DDD" style="padding: 15px">
    @if (session()->has('giamgia'))
        <tr><td colspan="3" style="color: green; padding-bottom: 5px;">Bạn đã được giảm 5% vào đơn hàng</td></tr>
    @endif
    <tr>
        <td colspan="3" style="padding-bottom: 15px">
            <span>Người đặt: {{ $dh->ten_nn }}</span><br>
            <span>Điện thoại: {{ $dh->sdt_nn }}</span><br>
            <span>Địa chỉ: {{ $dh->diachi_nn }}</span><br>
            <span>Thời gian đặt hàng: {{ $dh->created_at }}</span><br>
            <span>Thời gian bạn nhận hàng: {{ $thoigiannhanhang }}</span>
        </td>
    </tr>
    <tr>
        <th style="text-align: left">Số lượng</th>
        <th style="padding: 0 100px; text-align: left">Đơn giá</th>
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
            <td style="padding: 0 100px">{{ number_format($ctdh->sanpham->gia_sp,0,'.','.') }}<sup>VNĐ</sup></td>
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
    <tr>
        <td colspan="3" style="text-align: right; padding-top: 15px">
            <span>Tạm tính: {{ number_format($dh->tongtien - 15000,0,'.','.') }}<sup>VNĐ</sup></span><br>
            <span>Phí giao hàng: {{ number_format(15000,0,'.','.') }}<sup>VNĐ</sup></span><br>
            <span>Tổng tiền: <span style="color: red; font-size: 20px; font-weight: bold">{{ number_format($dh->tongtien,0,'.','.') }}<sup>VNĐ</sup></span></span>
        </td>
    </tr>
</table>