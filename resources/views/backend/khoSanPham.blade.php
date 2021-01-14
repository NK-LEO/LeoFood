<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LeoFood - Quản lý số lượng sản phẩm</title>
	<base href="{{ asset('') }}">
	<link href="public/backend/css/bootstrap.min.css" rel="stylesheet">
	<link href="public/backend/css/font-awesome.min.css" rel="stylesheet">
	<link href="public/backend/css/datepicker3.css" rel="stylesheet">
	<link href="public/backend/css/styles.css" rel="stylesheet">
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
</head>
<body>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href=""><span>Leo</span>Food</a>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="{{ session('hinh_tv') }}" class="img-responsive">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name">{{ session('ten_tv') }}</div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>
					@if (session('vaitro') == 2)
						Chủ cửa hàng
					@else
						Nhân viên
					@endif
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
		<form role="search">
			<div class="form-group">
				{{-- <input type="text" class="form-control" placeholder="Search"> --}}
			</div>
		</form>
		<ul class="nav menu">
			@if(session()->has('vaitro') && session('vaitro') == 2)
				<li><a href="{{ route('admin') }}"><em class="fa fa-dashboard"></em> Dashboard</a></li>
			@endif
			<li><a href="{{ route('admin-slideshow') }}"><em class="fa fa-toggle-off"></em> Khuyến mãi</a></li>
			<li><a href="{{ route('admin-product') }}"><em class="fa fa-clone"></em> Sản phẩm</a></li>
			<li><a href="{{ route('admin-statistical-product') }}"><i class="fa fa-bar-chart"></i> Thống kê sản phẩm</a></li>
			<li class="active"><a href="{{ route('admin-warehouse-product') }}"><i class="fa fa-briefcase"></i> Kho sản phẩm</a></li>
			<li><a href="{{ route('admin-don-hang') }}"><em class="fa fa-opencart"></em> Đơn hàng</a></li>
			<li><a href="{{ route('dang-xuat') }}"><em class="fa fa-power-off"></em> Logout</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Sản phẩm trong kho</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h5 class="page-header">
					@if (session('tb'))
						<div class="alert alert-danger" id="danger-alert">
						<strong><i class='fa fa-exclamation-triangle'></i> Thông báo! </strong>
						{{ session('tb') }}
						</div>
					@endif
				</h5>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default articles">
					<div class="panel-heading">
						<span style="font-size: 17px; font-weight: bold; color: #30a5ff">CHI TIẾT SẢN PHẨM TRONG KHO</span>
						<span class="pull-right clickable panel-toggle panel-button-tab-left">
							<em class="fa fa-toggle-up"></em>
						</span>
					</div>
					<div class="panel-body articles-container">
						{{-- <div>
							@foreach ($ngaynhapsanpham as $spnhap)
								<p>{{ (strtotime($spnhap->ngay_het_han) - strtotime($ngayhientai)) / (strtotime($spnhap->ngay_het_han) - strtotime($spnhap->ngay_nhap)) }} - {{ $spnhap->ma_sp }}</p>
							@endforeach
						</div> --}}
						<form id="form-tim-sp-kho">
							@csrf
							<table style="float: right">
								<tr>
									<td>
										<input type="text" name="ten_sp" required placeholder="Nhập tên sản phẩm"
											style="padding: 3px;height: 30px; width: 250px; outline: none">
									</td>
									<td>
										<button type="submit" class="btn btn-sm btn-info"
											style="height: 30px; border-radius: 0; outline: none"><i
												class="fa fa-search"></i> Tìm kiếm</button>
									</td>
								</tr>
							</table>
						</form>
						<div style="clear: both"></div>
						<div class="article">
							<div class="col-xs-12">
								<div id="change-sanphamkho" class="row">
                                    <section class="wrapper">
										<div class="table-agile-info">
											<div class="panel panel-default">
												<div>
													<table class="table" ui-jq="footable" ui-options='{
														"paging": {
														"enabled": true
														},
														"filtering": {
														"enabled": true
														},
														"sorting": {
														"enabled": true
														}}' style="width: 100%;">
														<thead>
															<tr >
																<th style="text-align: center">STT</th>
																<th style="text-align: center">TÊN SẢN PHẨM</th>
																<th style="text-align: center">HÌNH ẢNH</th>
																<th style="text-align: center">TỔNG NHẬP</th>
																<th style="text-align: center">ĐÃ BÁN</th>
																<th style="text-align: center">BỊ HỎNG</th>
																<th style="text-align: center">CÒN LẠI</th>
																<th style="text-align: center">LỰA CHỌN</th>
															</tr>
														</thead>
														<tbody>
															@php
															$i=1;
															@endphp
																@foreach ($sanpham as $sp)
																<tr>
																	<td style="height: 50px; line-height: 50px; text-align: center">
																		{{ $i }}
																	</td>
																	<td style="height: 50px; line-height: 50px; text-align: center">
																		{{ $sp->ten_sp }}
																	</td>
																	<td style="height: 50px; line-height: 50px; text-align: center">
																		<img src="{{ $sp->hinh_sp }}" style="width: 75px; height: 50px">
																	</td>
																	<td style="height: 50px; line-height: 50px; text-align: center">
																		@foreach ($ngaynhapsanpham2 as $spnhap2)
																			@if ($spnhap2->ma_sp == $sp->ma_sp)
																				{{ $spnhap2->tongsoluongnhap }}
																			@endif
																		@endforeach
																	</td>
																	<td style="height: 50px; line-height: 50px; text-align: center">
																		@foreach ($ngaynhapsanpham2 as $spnhap2)
																			@if ($spnhap2->ma_sp == $sp->ma_sp)
																				{{ $spnhap2->tongsoluongnhap - ($spnhap2->tongsoluonghong + $sp->soluong_sp) }}
																			@endif
																		@endforeach
																	</td>
																	<td style="height: 50px; line-height: 50px; text-align: center">
																		@foreach ($ngaynhapsanpham2 as $spnhap2)
																			@if ($spnhap2->ma_sp == $sp->ma_sp)
																				{{ $spnhap2->tongsoluonghong }}
																			@endif
																		@endforeach
																	</td>
																	<td style="height: 50px; line-height: 50px; text-align: center">
																		{{ $sp->soluong_sp }}
																	</td>
																	<td style="height: 50px; line-height: 50px; text-align: center">
																		<a href="" class="btn btn-sm btn-default" data-toggle="modal" data-target="#ThemSLSPKho{{ $sp->ma_sp }}" style="padding: 2px 7px 0px 7px; outline: none; background-color: silver">
																			<i class="fa fa-plus-square"></i>
																		</a>
																		<a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#XemChiTietSPKho{{ $sp->ma_sp }}" style="padding: 2px 7px 0px 7px; outline: none;">
																			<em class="fa fa-eye"></em>
																		</a>
																	</td>
																	@php
																	$i++;
																	@endphp
																</tr>
																@endforeach
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</section>
                                </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		{{--  Thêm số lượng sản phẩm kho  --}}
		@foreach ($sanpham as $item)
			<div class="modal fade" id="ThemSLSPKho{{ $item->ma_sp }}" data-backdrop="static" tabindex="-1">
				<div class="modal-dialog modal-dialog-centered" >
					<div class="modal-content" style="position: relative;">
						<div class="modal-header" style="padding: 7px 0 0 15px; border-bottom: 1px solid silver">
							<h5 style="font-weight:bold">Thêm số lượng sản phẩm trong kho</h5>
							<button type="button" class="close" data-dismiss="modal" style="position: absolute; top: 7px; right: 7px;">
								<span>&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<img src="{{ $item->hinh_sp }}" style="width: 100%; border-radius: 4px">
									</div>
									<div class="col-md-8">
										<label>TÊN SẢN PHẨM: </label>
										<span>{{ $item->ten_sp }}</span><br>
										<form action="{{ route('admin-insert-warehouse-product') }}"  method="POST">
											@csrf
											<input type="hidden" name="ma_sp" value="{{ $item->ma_sp }}">
											<div class="row">
												<div class="form-group col-md-5" style="padding-right: 5px">
													<label>Số lượng</label>
													<input type="number" min="1" name="soluong_nhap" class="form-control" required placeholder="Nhập số lượng" style="padding: 10px;">
												</div>
												<div class="form-group col-md-7" style="padding-left: 0">
													<label>Ngày hết hạn</label>
													<input type="datetime-local" class="form-control" required name="ngay_het_han">
												</div>
											</div>
											<button type="submit" class="btn btn-default" style="background-color: silver; width: 100%">
												<i class="fa fa-plus-circle"></i> Thêm
											</button>
										</form>			
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endforeach
		{{-- Xem chi tiết sản phẩm kho --}}
		@foreach ($sanpham as $item)
			<div class="modal fade" id="XemChiTietSPKho{{ $item->ma_sp }}" data-backdrop="static" data-keyboard="false" tabindex="-1">
				<div class="modal-dialog modal-dialog-centered modal-lg" >
					<div class="modal-content" style="position: relative;">
						<div class="modal-header" style="padding: 7px 0 0 15px; border-bottom: 1px solid #8BD816">
							<h5 style="color: #8BD816; font-weight: bold">Xem chi tiết sản phẩm trong kho</h5>
							<button onclick="return loadPage()" type="button" class="close" data-dismiss="modal" style="position: absolute; top: 7px; right: 7px;">
								<span>&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-md-4">
									<img src="{{ $item->hinh_sp }}" style="width: 100%; height: 270px; border-radius: 4px">
								</div>
								<div class="col-md-8">
									<label>TÊN SẢN PHẨM: </label>
									<span>{{ $item->ten_sp }}</span>
									<table class="table" ui-jq="footable" ui-options='{
										"paging": {
										"enabled": true
										},
										"filtering": {
										"enabled": true
										},
										"sorting": {
										"enabled": true
										}}'>
										<thead>
											<tr>
												<div>												
													<th style="text-align: center">LẦN NHẬP</th>								
													<th style="text-align: center">NGÀY NHẬP</th>								
													<th style="text-align: center">SỐ LƯỢNG NHẬP</th>											
													<th style="text-align: center">NGÀY HẾT HẠN</th>											
													<th style="text-align: center">SỐ LƯỢNG HỎNG</th>											
												</div>
											</tr>
										</thead>
										<tbody>
											@php
												$i=1;
											@endphp
											@foreach ($ngaynhapsanpham as $spnhap)
												@if ($spnhap->ma_sp == $item->ma_sp)
													<tr>
														<div>												
															<td style="text-align: center">{{ $i }}
																<p>
																	{{-- @if (date('Y-m-d H:i:s') < date('Y-m-d H:i:s', strtotime($spnhap->ngay_het_han)))
																		<small style="color: green">(còn hạn)</small>
																	@else
																		<small style="color: red">(hết hạn)</small>
																	@endif --}}
																	@php
																		$temp = (strtotime($spnhap->ngay_het_han) - strtotime($ngayhientai)) / (strtotime($spnhap->ngay_het_han) - strtotime($spnhap->ngay_nhap));
																		$time = 0.1;
																	@endphp
																	@if ($temp > $time)
																		<small style="color: green">(còn hạn)</small>
																	@elseif($temp < 0)
																		<small style="color: red">(hết hạn)</small>
																	@else
																		<small style="color: coral">(Sắp hết hạn)</small>
																	@endif
																</p>
															</td>								
															<td style="text-align: center">
																{{ date("d-m-Y H:i:s", strtotime($spnhap->ngay_nhap)) }}											
															<td style="text-align: center">
																{{--  <form action="{{ route('admin-edit-warehouse-product') }}" method="POST">
																	@csrf
																	<input type="hidden" name="ngay_nhap" value="{{ $spnhap->ngay_nhap }}">
																	<input type="number" min="1" name="soluong_sp" value="{{ $spnhap->soluong_sp }}" style="text-align: center; width: 50%">
																	<button>sumit</button>
																</form>  --}}
																<input onchange="return capNhatSLSPKho('{{ $spnhap->ngay_nhap }}', this.value)" type="number" min="1" value="{{ $spnhap->soluong_nhap }}" style="text-align: center; width: 50%">
															</td>
															<td style="text-align: center">
																{{ date("d-m-Y H:i:s", strtotime($spnhap->ngay_het_han)) }}
															</td>
															<td style="text-align: center">
																{{ $spnhap->soluong_hong }}
																{{-- <input onchange="return capNhatSLSPHong('{{ $spnhap->ngay_nhap }}', this.value)" type="number" min="0" value="{{ $spnhap->soluong_hong }}" style="text-align: center; width: 50%"> --}}
															</td>
														</div>
														@php
															$i++;
														@endphp
													</tr>
												@endif
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endforeach

		
	</div>	<!--/.main-->
	  

	<script src="public/backend/js/jquery-1.11.1.min.js"></script>
	<script src="public/backend/js/bootstrap.min.js"></script>
	{{-- <script src="public/backend/js/chart.min.js"></script>
	<script src="public/backend/js/chart-data.js"></script>
	<script src="public/backend/js/easypiechart.js"></script>
	<script src="public/backend/js/easypiechart-data.js"></script> --}}
	<script src="public/backend/js/bootstrap-datepicker.js"></script>
	<script src="public/backend/js/custom.js"></script>
	<script src="public/backend/js/myScript.js"></script>
	<script>
		$("#form-tim-sp-kho").on("submit", function () {
			event.preventDefault();
			$.ajax({
				url: "/admin/tim-san-pham-kho",
				type: "post",
				data: $("#form-tim-sp-kho").serialize(),
			}).done(function (reponse) {
				$("#change-sanphamkho").html(reponse);
			});
		});
		//
		$(document).ready(function () {
			$("#danger-alert")
				.fadeTo(5000, 500)
				.slideUp(500, function () {
					$("#danger-alert").slideUp(500);
				});
		});
	</script>
	<script>
		function capNhatSLSPKho(ngay_nhap, soluong_nhap){
			$.ajax({
			url: "admin/edit-warehouse-product",
			type: "post",
			data: {
				_token: "{{ csrf_token() }}",
				ngay_nhap: ngay_nhap,
				soluong_nhap: soluong_nhap,
			},
			}).done(function (reponse) {
				// $("#change-sp").html(reponse);
			});
		}
		function capNhatSLSPHong(ngay_nhap, soluong_hong){
			$.ajax({
			url: "admin/edit-warehouse-product-broken",
			type: "post",
			data: {
				_token: "{{ csrf_token() }}",
				ngay_nhap: ngay_nhap,
				soluong_hong: soluong_hong,
			},
			}).done(function (reponse) {
				
			});
		}
		function loadPage(){
			location.reload();
		}
	</script>
</body>
</html>
