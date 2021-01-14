<!DOCTYPE html>
<html lang="en">
<head>
    <base href="{{ asset("") }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{--  <meta name="csrf-token" content="{{ csrf_token() }}">  --}}
    <title>leo-food</title>
    <link rel="shortcut icon" href="/public/frontend/images/title2.jpg">
    <link rel="stylesheet" href="/public/frontend/css/style.css">
    <link rel="stylesheet" href="/public/frontend/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/frontend/fonts/css/all.css">

    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>

    {{-- Chatbot --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="/public/frontend/css/styleChatBot.css"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>

    <style>
        body {
            background-color: #f5f5f5;
        }
        #formFilter table tr th, #formFilter table tr td{
            font-size: 15px;
        }
        #formFilter table tr td input[type="radio"]:hover{
            cursor: pointer;
        }
    </style>
</head>
<body>
    @include('frontend.header')
    <div class="container pt-3">
        {{--  #1  --}}
        <div class="row">
            <div class="col-md-3 p-1">
                <ul class="danhmuc">
                    <li id="danhmuc-li-I">
                        <i class="fas fa-bars mr-2"></i> DANH MỤC
                    </li>
                    <div id="danhmuccon">
                        @foreach ($loaisanpham as $item)
                            <a onclick="return locLoaiSP({{ $item->ma_loaisp }})" style="cursor: pointer" class="tag-a">
                                <li>
                                    {{ $item->ten_loaisp }}
                                </li>
                            </a>
                        @endforeach
                    </div>
                </ul>
            </div>
            <div class="col-md-9 p-1">
                <div id="slides" class="carousel slide" data-ride="carousel">
                    @php
					$i=0;
					@endphp
					<div class="carousel-inner">
						@foreach ($slideshow as $item)
						@if ($i==0)
						<div class="carousel-item active">
							<img src="{{ $item->hinh_slides }}" class="d-block w-100">
						</div>
						@else
						<div class="carousel-item">
							<img src="{{ $item->hinh_slides }}" class="d-block w-100">
						</div>
						@endif
						@php
						$i++;
						@endphp
						@endforeach
						<ol class="carousel-indicators">
							@for($j=0;$j<$i;$j++) @if ($j==0) <li data-target="#slides" data-slide-to="0"
								class="active">
								</li>
								@else
								<li data-target="#slides" data-slide-to="{{ $j }}"></li>
								@endif
							@endfor
						</ol>
					</div>
					<a class="carousel-control-prev" href="#slides" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#slides" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
                </div>
            </div>
        </div>

        {{--  #2  --}}
        <div id="change-sanpham" class="row pl-1 pr-1">
            <div class="col-md-12" id="text">TẤT CẢ SẢN PHẨM</div>
            <div class="col-md-12" style="background-color: white">
                <div class="row">
                    <div class="col-md-12 p-0">
                        <p>
                            <a class="btn btn-sm btn-light" data-toggle="collapse" href="#filter" style="border-radius: 0; background-color: #dae0e5; border: 1px solid #dae0e5;">
                                <i class="fas fa-filter" style="color: grey; width: 80px;"> Tìm kiếm</i>
                            </a>
                        </p>
                    </div>
                    <form id="formFilter" style="width: 100%">
                        @csrf
                        <div class="col-md-12 collapse" id="filter">
                            <div class="card card-body" style="border-radius: 0; border: none; background-color: #f5f5f5;">
                                <table>
                                    <tr>
                                        <th>Chọn mức giá:</th>
                                        <td>
                                            <input type="radio" name="gia" value="1">
                                            Dưới 50.000<sup>VNĐ</sup>
                                        </td>
                                        <td>
                                            <input type="radio" name="gia" value="2">
                                            Từ 50 - 100.000<sup>VNĐ</sup>
                                        </td>
                                        <td>
                                            <input type="radio" name="gia" value="3">
                                            Từ 100 - 150.000<sup>VNĐ</sup>
                                        </td>
                                        <td>
                                            <input type="radio" name="gia" value="4">
                                            Từ 150 - 200.000<sup>VNĐ</sup>
                                        </td>
                                        <td>
                                            <input type="radio" name="gia" value="5">
                                            Trên 200.000<sup>VNĐ</sup>
                                        </td>
                                    </tr>
                                    <tr><td colspan="6"><br></td></tr>
                                    <tr>
                                        <th>Sắp xếp giá:</th>
                                        <td colspan="5">
                                            <select name="sapXep" class="form-control form-control-sm">
                                                <option value="0">Chọn...</option>
                                                <option value="6">Giá từ thấp đến cao</option>
                                                <option value="7">Giá từ cao đến thấp</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr><td colspan="6"><br></td></tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="5">
                                            <button type="submit" class="btn btn-sm btn-info w-25"><i class="fas fa-sync-alt"></i> Xem</button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="change-locsanpham">
                    <div class="row p-2 pb-4">
                        @foreach ($sanpham as $sp)
                            @if ($sp->soluong_sp > 0)
                                <div class="col-md-3 p-1">
                                    <div class="card">
                                        <img src="{{ $sp->hinh_sp }}" class="card-img-top" style="height: 200px">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $sp->ten_sp }}</h5>
                                            <p>
                                                @foreach ($danhgia as $dg)
                                                    @if ($dg->ma_sp == $sp->ma_sp)
                                                        <b style="position: absolute; left: 0; top: 0; padding: 0 5px; background-color: #8BD816; color: white;">
                                                            <small>{{ number_format($dg->so_sao,1,'.','.') }}<i class="fas fa-star"></i></small>
                                                        </b>
                                                        {{--  <ul style="margin-bottom: 0;">
                                                            @for($i=1; $i<=5; $i++)
                                                                @foreach ($danhgia as $dg)
                                                                    @if ($dg->ma_sp == $sp->ma_sp)
                                                                        @php
                                                                            $sosao = number_format($dg->so_sao,1,'.','.');
                                                                            if($i <= $sosao){
                                                                                $color = 'color: #ffcc00';
                                                                            }
                                                                            else{
                                                                                $color = 'color: #ccc';
                                                                            }
                                                                        @endphp
                                                                    @endif
                                                                @endforeach
                                                                <li style="display: inline; {{ $color }}">
                                                                    <i class="fas fa-star"></i>
                                                                </li>
                                                            @endfor
                                                        </ul>  --}}
                                                    @endif
                                                @endforeach
                                            </p>
                                            {{--  <small>
                                                <ul style="margin-bottom: 0;">
                                                    @for($i=1; $i<=5; $i++)
                                                        <li style="display: inline; color: #ccc">
                                                            <i class="fas fa-star"></i>
                                                        </li>
                                                    @endfor
                                                </ul>
                                            </small>  --}}
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
                    <small>{{$sanpham->links("pagination::bootstrap-4")}}</small>
                </div>
            </div>
        </div>
        
        {{-- Chatbot --}}
        <div class="container">
            <div class="widget" style="bottom: 7%">
               <div class="chat_header">
                  <!--Add the name of the bot here -->
                  <span style="color:white;margin-left: 5px;">ChatBot </span>
                  <span style="color:white;margin-right: 5px;float:right;margin-top: 5px;" id="close">
                  <i class="material-icons">close</i>
                  </span>
               </div>
               <!--Chatbot contents goes here -->
               <div class="chats" id="chats">
                  <div class="clearfix"></div>
               </div>
               <!--user typing indicator -->
               <div class="keypad" >
                  <input type="text" id="keypad" class="usrInput browser-default" placeholder="Type a message..." autocomplete="off">
               </div>
            </div>
            <!--bot widget -->
            <div class="profile_div" id="profile_div" style="bottom: 7%">
               <img class="imgProfile" src="/public/frontend/images/bot.jpg" style="width: 45px; height: 45px"/>
            </div>
         </div>
        
        {{--  #3  --}}
        <a onclick="return topFunction()" id="btn-back-top" style="cursor: pointer"><i class="fas fa-angle-double-up"></i></a>
    </div>
    @include('frontend.footer')
    {{-- ### --}}
    <script src="/public/frontend/js/jquery-3.4.1.min.js"></script>
    <script src="/public/frontend/js/jquery-ui.min.js"></script>
    {{-- <script src="/public/frontend/js/popper.min.js"></script> --}}
    <script src="/public/frontend/js/bootstrap.bundle.min.js"></script>
    <script src="/public/frontend/js/myScript.js"></script>
    <script src="/public/frontend/js/scriptChatBot.js"></script>
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
    <script>
        //Get the button
        var mybutton = document.getElementById("btn-back-top");
        
        // When the user scrolls down 50px from the top of the document, show the button
        window.onscroll = function() {scrollFunction()};
        
        function scrollFunction() {
        if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
        }
        
        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            $("html, body").animate(
                {
                    scrollTop: 0
                },
                1000
            );
        }
        </script>
</body>
</html>