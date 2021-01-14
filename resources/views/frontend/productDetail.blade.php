<!DOCTYPE html>
<html lang="en">
<head>
    <base href="{{ asset("") }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chi tiết sản phẩm leo-food</title>
    <link rel="shortcut icon" href="/public/frontend/images/title2.jpg">
    <link rel="stylesheet" href="/public/frontend/css/style.css">
    <link rel="stylesheet" href="/public/frontend/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/frontend/fonts/css/all.css">
    <link rel="stylesheet" href="/public/frontend/css/sweetalert.css">
    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <style>
        body {
            background-color: #f5f5f5;
        }
        .trangThaiBL option{
			background-color: white;
			color: black;
		}
        #xoabl:hover{
            text-decoration: none;
        }
    </style>
</head>
<body>
    @include('frontend.header')
    <div class="container mt-3">
        <div class="row p-1">
            <div class="col-md-12 p-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="border-radius: 0">
                      <li class="breadcrumb-item"><a href="">Trang chủ</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Chi tiết sản phẩm</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12">
                @foreach ($sanpham as $item)
                    
                @endforeach
                <div class="row p-3" style="background-color: white">
                    <div class="col-md-5 p-0">
                        <img src="{{ $item->hinh_sp }}" style="width: 100%">
                    </div>
                    <div class="col-md-7 p-0 pl-3">
                        <h3>{{ $item->ten_sp }}</h3>
                        <p>{{ $item->chitiet_sp }}</p>
                        @foreach ($thanhphandinhduong as $tpdd)
                            @foreach ($chitiettpdd as $cttpdd)
                                @if ($cttpdd->ma_tpdd == $tpdd->ma_tpdd)
                                    <span>{{ $tpdd->ten_tpdd }}: {{ $cttpdd->gia_tri }}, </span>
                                @endif
                            @endforeach
                        @endforeach
                        <p></p>
                        @if ($item->soluong_sp > 0)
                            <p>Tình trạng: còn hàng</p>
                        @else
                            <p>Tình trạng: <span style="color: red">sản phẩm tạm thời hết hàng</span></p>
                        @endif
                        <p>Giá: 
                            <span>{{ number_format($item->gia_sp,0,'.','.') }}<sup>VNĐ</sup></span>
                            @foreach ($sanphamkhuyenmai as $spkm)
                                @if($item->ma_sp == $spkm->ma_sp && date('Y-m-d H:i:s') >= date('Y-m-d H:i:s', strtotime($spkm->khuyenmai->ngay_bd)) && date('Y-m-d H:i:s') <= date('Y-m-d H:i:s', strtotime($spkm->khuyenmai->ngay_kt)))
                                    <span style="position: absolute; top: 0; right: 0; padding: 0 5px; background-color: Gold">
                                        @if ($spkm->khuyenmai->loai_km == 1)
                                            <small>Giảm {{ $spkm->khuyenmai->gia_tri_km }}%</small>
                                        @else
                                            <small>Giảm {{ number_format($spkm->khuyenmai->gia_tri_km,0,'.','.') }}<sup>VNĐ</sup></small>
                                        @endif
                                    </span>
                                    @if ($spkm->khuyenmai->loai_km == 1)
                                        <small><i class="fas fa-long-arrow-alt-right"></i> </small><span style="color: red; font-weight: bold">{{ number_format($item->gia_sp - (($item->gia_sp * $spkm->khuyenmai->gia_tri_km) / 100),0,'.','.') }}<sup>VNĐ</sup></span>
                                    @else
                                        <small><i class="fas fa-long-arrow-alt-right"></i> </small><span style="color: red; font-weight: bold">{{ number_format($item->gia_sp - $spkm->khuyenmai->gia_tri_km,0,'.','.') }}<sup>VNĐ</sup></span>
                                    @endif
                                @endif
                            @endforeach
                        </p>
                        {{--  <form action="{{ route('them-sp-gio-hang') }}" method="POST">
                            @csrf
                            <input type="hidden" name="ma_sp" value="{{ $item->ma_sp }}">
                            <button type="submit" class="btn btn-sm btn-outline-success mr-1">
                                <i class="fas fa-cart-plus"></i> Thêm vào giỏ hàng</a>
                            </button>
                        </form>  --}}
                        @if ($item->soluong_sp > 0)
                            <button onclick="return themSPVaoGIo({{ $item->ma_sp }})" type="submit" class="btn btn-sm btn-outline-success mr-1">
                                <i class="fas fa-cart-plus"></i> Thêm vào giỏ hàng</a>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div id="location" class="row p-1 mt-3">
            <div class="col-md-12 pt-3" style="background-color: white">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <a class="nav-link active" data-toggle="tab" href="#binh-luan" role="tab" aria-selected="true" style="font-weight: bold">Bình luận</a>
                    </li>
                    <li class="nav-item" role="presentation">
                      <a id="danh_gia" class="nav-link" data-toggle="tab" href="#danh-gia" role="tab" aria-selected="false" style="font-weight: bold">Đánh giá</a>
                    </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                    {{--  Bình luận  --}}
                    <div class="tab-pane fade show active" id="binh-luan" role="tabpanel" style="margin-top: 20px">
                        <div id="change-binhluan">
                            @foreach ($binhluan as $bl)
                                @if(session()->has('vaitro') && session('vaitro')!=0)
                                    <div class="media mb-4">
                                        <img src="{{ $bl->thanhvien->hinh_tv }}" class="mr-3" style="width: 64px; height: 64px; border-radius: 50%">
                                        <div class="media-body">
                                            <div style="background-color: #e9ecef; padding: 10px; border-radius: 5px;">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h5 class="mt-0">{{ $bl->thanhvien->ten_tv }}</h5>
                                                    </div>
                                                    <div class="col-md-6" style="text-align: right">
                                                        <small><i class="far fa-clock" style="font-size: 12px"></i> {{ $bl->created_at }}</small>
                                                    </div>
                                                    <div class="col-md-10">
                                                        {{ $bl->noidung_bl }}
                                                    </div>
                                                    <div class="col-md-2" style="text-align: right">
                                                        @php
                                                            if($bl->trang_thai_bl == 0){
                                                                $bg = "background-color: #8ad919";
                                                            }else {
                                                                $bg = "background-color: #f0ad4e";
                                                            }
                                                        @endphp
                                                        <select class="trangThaiBL" id="trangThaiBL{{ $bl->ma_bl }}" onchange="return changeBackgroundBL({{ $bl->ma_bl }}, this.value)" style="cursor: pointer; border-radius: 3px; border: none; outline: none; {{ $bg }}">
                                                            @if ($bl->trang_thai_bl == 0)
                                                                <option value="0" selected>Hiện</option>
                                                                <option value="1">Ẩn</option>
                                                            @else
                                                                <option value="0">Hiện</option>
                                                                <option value="1" selected>Ẩn</option>
                                                            @endif
                                                        </select>
                                                        <a onclick="return XacNhanXoa()" href="{{ route('admin-xoa-binh-luan', $bl->ma_bl) }}" id="xoabl" style="color: white; padding: 0 5px; border-radius: 3px; background-color: #dc3545">Xóa</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="change-phanhoi">
                                                @foreach ($phanhoi as $ph)
                                                    @if ($bl->ma_bl == $ph->ma_bl)
                                                        <div class="media mt-3">
                                                            <img src="{{ $ph->thanhvien->hinh_tv }}" class="mr-3" style="width: 64px; height: 64px; border-radius: 50%">
                                                            <div class="media-body" style="background-color: #e9ecef; padding: 10px; border-radius: 5px">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <h5 class="mt-0">{{ $ph->thanhvien->ten_tv }}</h5>
                                                                    </div>
                                                                    <div class="col-md-6" style="text-align: right">
                                                                        <small><i class="far fa-clock" style="font-size: 12px"></i> {{ $ph->created_at }}</small>
                                                                    </div>
                                                                    <div class="col-md-12">{{ $ph->noidung_ph }}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <form action="{{ route('phan-hoi') }}" method="POST" style="margin-top: 10px;">
                                                @csrf
                                                <div class="form-group">
                                                    <input type="hidden" name="ma_tv" value="{{ session('ma_tv') }}">
                                                    <input type="hidden" name="ma_bl" value="{{ $bl->ma_bl }}">
                                                    <input type="hidden" name="ma_sp" value="{{ $item->ma_sp }}">
                                                    <input id="noidung_ph" class="form-control" name="noidung_ph" required placeholder="Viết phản hồi...">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @else
                                    @if($bl->trang_thai_bl == 0)
                                        <div class="media mb-4">
                                            <img src="{{ $bl->thanhvien->hinh_tv }}" class="mr-3" style="width: 64px; height: 64px; border-radius: 50%">
                                            <div class="media-body">
                                                <div style="background-color: #e9ecef; padding: 10px; border-radius: 5px">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <h5 class="mt-0">{{ $bl->thanhvien->ten_tv }}</h5>
                                                        </div>
                                                        <div class="col-md-6" style="text-align: right">
                                                            <small><i class="far fa-clock" style="font-size: 12px"></i> {{ $bl->created_at }}</small><br>
                                                        </div>
                                                        <div class="col-md-12">
                                                            {{ $bl->noidung_bl }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="change-phanhoi">
                                                    @foreach ($phanhoi as $ph)
                                                        @if ($bl->ma_bl == $ph->ma_bl)
                                                            <div class="media mt-3">
                                                                <img src="{{ $ph->thanhvien->hinh_tv }}" class="mr-3" style="width: 64px; height: 64px; border-radius: 50%">
                                                                <div class="media-body" style="background-color: #e9ecef; padding: 10px; border-radius: 5px">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <h5 class="mt-0">{{ $ph->thanhvien->ten_tv }}</h5>
                                                                        </div>
                                                                        <div class="col-md-6" style="text-align: right">
                                                                            <small><i class="far fa-clock" style="font-size: 12px"></i> {{ $ph->created_at }}</small>
                                                                        </div>
                                                                        <div class="col-md-12">{{ $ph->noidung_ph }}</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <form action="{{ route('phan-hoi') }}" method="POST" style="margin-top: 10px;">
                                                    @csrf
                                                    <div class="form-group">
                                                        <input type="hidden" name="ma_tv" value="{{ session('ma_tv') }}">
                                                        <input type="hidden" name="ma_bl" value="{{ $bl->ma_bl }}">
                                                        <input type="hidden" name="ma_sp" value="{{ $item->ma_sp }}">
                                                        <input id="noidung_ph" class="form-control" name="noidung_ph" required placeholder="Viết phản hồi...">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                        <div class="col-md-12 p-0 mb-3">
                            <form id="form-them-bl">
                                @csrf
                                <div class="form-group">
                                    <textarea id="noidung_bl" class="form-control" name="noidung_bl" rows="5" required placeholder="Viết bình luận..."></textarea>
                                    <input type="hidden" name="ma_sp" value="{{ $item->ma_sp }}">
                                </div>
                                <button id="binhLuan" type="submit" class="btn btn-primary w-100">Gửi bình luận</button>
                            </form>
                        </div>
                    </div>
                    {{--  Đánh giá  --}}
                    <div class="tab-pane fade" id="danh-gia" role="tabpanel" style="margin-top: 20px">
                        <div id="change-danhgia">
                            <div class="row">
                                <div class="col-md-2">
                                    <i class="fas fa-star" style="position: relative;font-size: 100px; color: #ffcc00;"></i>
                                    <b style="position: absolute; left: 27%; top: 27%; color: white; font-size: 30px">{{ number_format($sosao,1,'.','.') }}</b>
                                </div>
                                <div class="col-md-10" style="padding: 0">
                                    @if ($danhgia != null)
                                        @foreach ($danhgia as $key => $item)
                                            @php
                                                $phantram = ($item['luot_danh_gia']/$tongsoluotdanhgia)*100;
                                            @endphp
                                            <div class="row">
                                                <div class="col-md-1" >
                                                    {{ $key }} <i class="fas fa-star" style="color: #ccc"></i>
                                                </div>
                                                <div class="col-md-9 pt-1">
                                                    <div class="progress">
                                                        <div class="progress-bar bg-warning" style="width: {{ $phantram }}%" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2" >
                                                    <small>{{ $item['luot_danh_gia'] }} đánh giá</small>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="row">
                                                <div class="col-md-1" >
                                                    {{ $i }} <i class="fas fa-star" style="color: #ccc"></i>
                                                </div>
                                                <div class="col-md-9 pt-1">
                                                    <div class="progress">
                                                        <div class="progress-bar bg-warning" style="width: 0%" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2" >
                                                    <small>0 đánh giá</small>
                                                </div>
                                            </div>
                                        @endfor
                                    @endif
                                </div>
                            </div>
                            <hr>
                            @foreach ($nguoidanhgia as $d)
                                <div style="margin-bottom: 10px;">
                                    <small>
                                        <b>{{ $d->thanhvien->ten_tv }}</b> 
                                        <span style="color: green"><i class="far fa-check-circle"></i> Đã mua hàng</span>
                                    </small><br>
                                    <small style="font-size: 10px">
                                        <ul style="margin-bottom: 0;">
                                            @for($i=1; $i<=5; $i++)
                                                @php
                                                    if($i <= $d->so_sao){
                                                        $color = 'color: #ffcc00';
                                                    }
                                                    else{
                                                        $color = 'color: #ccc';
                                                    }
                                                @endphp
                                                <li style="display: inline; {{ $color }};">
                                                    <i class="fas fa-star"></i>
                                                </li>
                                            @endfor
                                        </ul>
                                    </small>
                                    <small style="color: grey"><i class="far fa-clock" style="font-size: 12px"></i> {{ $d->created_at }}</small>
                                </div>
                            @endforeach
                            <hr>
                        </div>
                        <h5>Đánh giá sản phẩm</h5>
                        {{-- <form action="{{ route('danh-gia') }}" method="POST"> --}}
                         <form id="form-them-dg"> 
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <select name="so_sao" id="mySelectStar" class="form-control">
                                        <option value="0">Chọn số sao...</option>
                                        <option value="5">5 sao</option>
                                        <option value="4">4 sao</option>
                                        <option value="3">3 sao</option>
                                        <option value="2">2 sao</option>
                                        <option value="1">1 sao</option>
                                    </select>
                                    <small id="require-star" style="color: red"></small>
                                </div>
                                <div class="form-group col-md-2">
                                    @foreach ($sanpham as $item)
                                    @endforeach
                                    <input type="hidden" name="ma_sp" value="{{ $item->ma_sp }}">
                                    <button id="danhGia" type="submit" class="btn btn-info">Gửi đánh giá</button>
                                </div>
                              </div>
                        </form>
                    </div>
                  </div>
            </div>
        </div>
        <div class="row p-1 mt-3">
            <div class="col-md-12 pt-3" style="background-color: white">
                <h4>SẢN PHẨM LIÊN QUAN</h4>
                <div class="row p-2 pb-4">
                    @foreach ($sanphamlienquan as $sp)
                        @if ($sp->soluong_sp > 0)
                            <div class="col-md-3 p-1">
                                <div class="card">
                                    <img src="{{ $sp->hinh_sp }}" class="card-img-top" style="height: 200px">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $sp->ten_sp }}</h5>
                                        <p>
                                            @foreach ($danhgia2 as $dg)
                                                @if ($dg->ma_sp == $sp->ma_sp)
                                                    <b style="position: absolute; left: 0; top: 0; padding: 0 5px; background-color: #8BD816; color: white;">
                                                        <small>{{ number_format($dg->so_sao,1,'.','.') }}<i class="fas fa-star"></i></small>
                                                    </b>
                                                @endif
                                            @endforeach
                                        </p>
                                        <p class="card-text mt-2">Giá: 
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
                                                    <button onclick="return themSPVaoGIo({{ $sp->ma_sp }})" class="btn btn-sm btn-outline-success mr-1">
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
                        @else
                            <div class="col-md-3 p-1">
                                <div class="card" style="filter:brightness(80%);">
                                    <img src="{{ $sp->hinh_sp }}" class="card-img-top" style="height: 200px">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $sp->ten_sp }}</h5>
                                        <p>
                                            @foreach ($danhgia2 as $dg)
                                                @if ($dg->ma_sp == $sp->ma_sp)
                                                    <b style="position: absolute; left: 0; top: 0; padding: 0 5px; background-color: #8BD816; color: white">
                                                        <small>{{ number_format($dg->so_sao,1,'.','.') }}<i class="fas fa-star"></i></small>
                                                    </b>
                                                @endif
                                            @endforeach
                                        </p>
                                        <p class="card-text mt-2">Giá: 
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
                                        <p style="position: absolute; text-align: center; padding-bottom: 2px; left: 0; top: 100px; width: 100%; background-color: white">
                                            <small><b>Hết hàng</b></small>
                                        </p>
                                        <table>
                                            <tr>
                                                <td>
                                                    <button style="cursor: no-drop" class="btn btn-sm btn-outline-success mr-1">
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
    @include('frontend.footer')
    {{-- ### --}}
    <script src="/public/frontend/js/jquery-3.4.1.min.js"></script>
    <script src="/public/frontend/js/jquery-ui.min.js"></script>
    <script src="/public/frontend/js/bootstrap.bundle.min.js"></script>
    <script src="/public/frontend/js/myScript.js"></script>
    <script src="/public/frontend/js/sweetalert.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
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

        function changeBackgroundBL(ma_bl, value){
            $.ajax({
				type: "post",
				url: "/admin/thay-doi-trang-thai-bl",
				data: {
					_token: "{{ csrf_token() }}",
					ma_bl: ma_bl,
					trang_thai_bl: value,
				}
			});
        	if(value == 0){
				document.getElementById("trangThaiBL" + ma_bl).style.backgroundColor = "#8ad919";
			}else{
				document.getElementById("trangThaiBL" + ma_bl).style.backgroundColor = "#f0ad4e";
			}
		}
    </script>
    {{-- <script>
        $(document).ready(function(){
            $('#noidung_ph').keypress(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if (keycode == '13') {
                    event.preventDefault();
                    $.ajax({
                        url: '/phan-hoi',
                        type: 'post',
                        data: $('#form-them-ph').serialize(),
                    })
                    .done(function(reponse){
                        console.log(reponse);
                        $('#noidung_ph').val('');
                        $('#change-phanhoi').html(reponse);
                    });
                }
            });
        });
    </script> --}}
</body>
</html>