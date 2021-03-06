<div class="col-md-12" id="text">TẤT CẢ SẢN PHẨM</div>
<div class="col-md-12" style="background-color: white">
    @foreach ($loaisanpham as $item)
    @endforeach
    <div class="row">
        <div class="col-md-12 p-0">
            <p>
                <a class="btn btn-sm btn-light" href="" style="border-radius: 0; background-color: #dae0e5; border: 1px solid #dae0e5;">
                    {{ $item->ten_loaisp }} <i class="far fa-times-circle"></i>
                </a>
            </p>
        </div>
    </div>
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