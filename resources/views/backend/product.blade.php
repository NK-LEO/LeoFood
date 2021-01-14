<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LeoFood - Product</title>
	<base href="{{ asset('') }}">
	<link href="public/backend/css/bootstrap.min.css" rel="stylesheet">
	<link href="public/backend/css/font-awesome.min.css" rel="stylesheet">
	<link href="public/backend/css/datepicker3.css" rel="stylesheet">
	<link href="public/backend/css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/frontend/css/sweetalert.css">
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
			<li class="active"><a href="{{ route('admin-product') }}"><em class="fa fa-clone"></em> Sản phẩm</a></li>
			<li><a href="{{ route('admin-statistical-product') }}"><i class="fa fa-bar-chart"></i> Thống kê sản phẩm</a></li>
			<li><a href="{{ route('admin-warehouse-product') }}"><i class="fa fa-briefcase"></i> Kho sản phẩm</a></li>
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
				<li class="active">Sản phẩm</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h3 class="page-header">
					
				</h3>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default articles">
					<div class="panel-heading">
						<span style="font-size: 17px; font-weight: bold; color: #30a5ff">THÔNG TIN LOẠI SẢN PHẨM</span>
						<ul class="pull-right panel-settings panel-button-tab-right">
							<li class="dropdown">
								<a class="pull-right dropdown-toggle" data-toggle="modal" data-target="#FormThemLoaiSP" href="">
									<i class="fa fa-plus-square"></i>
								</a>
							</li>
						</ul>
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body articles-container">
						<div class="article">
							<div class="col-xs-12">
								<div class="row">
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
														}}'>
														<thead>
															<tr>
																<div class="row">												
																	<th class="col-md-2">STT</th>								
																	<th class="col-md-2">TÊN lOẠI SẢN PHẨM</th>												
																	<th class="col-md-8" style="text-align: right">LỰA CHỌN</th>
																</div>
															</tr>
														</thead>
														<tbody>
															@php
																$i=1;
															@endphp
															@foreach ($loaisanpham as $d)
																<tr>
																	<div class="row">												
																		<td class="col-md-2">{{ $i }}</td>								
																		<td class="col-md-2">{{ $d->ten_loaisp }}</td>												
																		<td class="col-md-8" style="text-align: right;">
																			<a href="" class="btn btn-sm btn-primary" style="padding: 2px 7px 0px 7px; outline: none" data-toggle="modal" data-target="#FormSuaLoaiSP{{ $d->ma_loaisp }}">
																				<em class="fa fa-edit"></em>
																			</a>
																			<a href="" class="btn btn-sm btn-danger" style="padding: 0px; outline: none;">
																				<form action="{{ route('admin-xoa-loaisp') }}" method="POST" onsubmit="return XacNhanXoa();">
																					@csrf
																					<input type="hidden" name="ma_loaisp" value="{{ $d->ma_loaisp }}">
																					<button type="submit" class="btn btn-sm btn-danger" style="padding: 0px 7px; outline: none;">
																						<em class="fa fa-trash"></em>
																					</button>
																				</form>
																				
																			</a>
																		</td>
																	</div>
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

			<div class="col-md-12">
				<div class="panel panel-default articles">
					<div class="panel-heading">
						<span style="font-size: 17px; font-weight: bold; color: #30a5ff">THÀNH PHẦN DINH DƯỠNG</span>
						<ul class="pull-right panel-settings panel-button-tab-right">
							<li class="dropdown">
								<a class="pull-right dropdown-toggle" data-toggle="modal" data-target="#FormThemTPDD" href="">
									<i class="fa fa-plus-square"></i>
								</a>
							</li>
						</ul>
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body articles-container">
						<div class="article">
							<div class="col-xs-12">
								<div class="row">
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
														}}'>
														<thead>
															<tr>
																<div class="row">												
																	<th class="col-md-2">STT</th>								
																	<th class="col-md-3">TÊN THÀNH PHẦN DINH DƯỠNG</th>												
																	<th class="col-md-7" style="text-align: right">LỰA CHỌN</th>
																</div>
															</tr>
														</thead>
														<tbody>
															@php
																$i=1;
															@endphp
															@foreach ($thanhphandinhduong as $tpdd)
																<tr>
																	<div class="row">												
																		<td class="col-md-2">{{ $i }}</td>								
																		<td class="col-md-2">{{ $tpdd->ten_tpdd }}</td>												
																		<td class="col-md-8" style="text-align: right;">
																			<a href="" class="btn btn-sm btn-primary" style="padding: 2px 7px 0px 7px; outline: none" data-toggle="modal" data-target="#FormSuaTPDD{{ $tpdd->ma_tpdd }}">
																				<em class="fa fa-edit"></em>
																			</a>
																			<a href="" class="btn btn-sm btn-danger" style="padding: 0px; outline: none;">
																				<form action="{{ route('admin-xoa-tpdd') }}" method="POST" onsubmit="return XacNhanXoa();">
																					@csrf
																					<input type="hidden" name="ma_tpdd" value="{{ $tpdd->ma_tpdd }}">
																					<button type="submit" class="btn btn-sm btn-danger" style="padding: 0px 7px; outline: none;">
																						<em class="fa fa-trash"></em>
																					</button>
																				</form>
																			</a>
																		</td>
																	</div>
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

			<div class="col-md-12">
				<div class="panel panel-default articles">
					<div class="panel-heading">
						<span style="font-size: 17px; font-weight: bold; color: #30a5ff">THÔNG TIN SẢN PHẨM</span>
						<ul class="pull-right panel-settings panel-button-tab-right">
							<li class="dropdown">
								<a class="pull-right dropdown-toggle" data-toggle="modal" data-target="#FormThemSP" href="">
									<i class="fa fa-plus-square"></i>
								</a>
							</li>
						</ul>
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
						<div class="panel-body articles-container">
							<div class="row">
								<div class="col-md-6">
									<form action="{{ route('admin-import-sp') }}" method="POST" enctype="multipart/form-data">
										@csrf
										<input type="file" accept=".xlsx" name="file" required><br>
										<input type="submit" value="Import file Excel" class="btn btn-sm btn-warning">
									</form>
								</div>
								<div class="col-md-6" style="text-align: right">
									<form id="form-tim-sp">
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
															class="fa fa-search"></i> Tìm kiếm sản phẩm</button>
												</td>
											</tr>
										</table>
									</form>
									<div style="clear: both"><br></div>
									<form action="{{ route('admin-export-sp') }}" method="POST">
										@csrf
										<input type="submit" value="Export file Excel" class="btn btn-sm btn-success">
									</form>
								</div>
							</div>
						<div class="article">
							<div class="col-xs-12">
								<div id="change-sanpham" class="row">
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
														}}'>
														<thead>
															<tr class="row">
																<th class="col-md-2">STT</th>
																<th class="col-md-2">HÌNH ẢNH</th>
																<th class="col-md-3">TÊN</th>
																<th class="col-md-3">GIÁ</th>
																<th class="col-md-2" style="text-align: right;">LỰA CHỌN</th>
															</tr>
														</thead>
														<tbody>
															@php
															$i=1;
															@endphp
															@foreach ($sanpham as $d)
															<tr class="row">
																<td class="col-md-2" style="height: 50px; line-height: 50px">
																	{{ $i }}
																</td>
																<td class="col-md-2" style="height: 50px; line-height: 50px">
																	<img src="{{ $d->hinh_sp }}" style="width: 75px; height: 50px">
																</td>
																<td class="col-md-3" style="height: 50px; line-height: 50px">
																	{{ $d->ten_sp }}
																</td>
																<td class="col-md-3" style="height: 50px; line-height: 50px">
																	{{ number_format($d->gia_sp,0,'.','.') }}<sup>VNĐ</sup>
																	@foreach ($sanphamkhuyenmai as $spkm)
																		@if($d->ma_sp == $spkm->ma_sp && date('Y-m-d H:i:s') >= date('Y-m-d H:i:s', strtotime($spkm->khuyenmai->ngay_bd)) && date('Y-m-d H:i:s') <= date('Y-m-d H:i:s', strtotime($spkm->khuyenmai->ngay_kt)))
																			@if ($spkm->khuyenmai->loai_km == 1)
																				<small> --> </small><span style="color: red; font-weight: bold">{{ number_format($d->gia_sp - (($d->gia_sp * $spkm->khuyenmai->gia_tri_km) / 100),0,'.','.') }}<sup>VNĐ</sup></span>
																			@else
																				<small> --> </small><span style="color: red; font-weight: bold">{{ number_format($d->gia_sp - $spkm->khuyenmai->gia_tri_km,0,'.','.') }}<sup>VNĐ</sup></span>
																			@endif
																		@endif
																	@endforeach
																</td>
																<td class="col-md-2" style="height: 50px; line-height: 50px;text-align: right">
																	<a href="" class="btn btn-sm btn-success" data-toggle="modal"
																	data-target="#XemChiTiet{{ $d->ma_sp }}" style="padding: 2px 7px 0px 7px; outline: none;">
																		<em class="fa fa-eye"></em>
																	</a>
																	<a href="" class="btn btn-sm btn-primary"
																		style="padding: 2px 7px 0px 7px; outline: none"
																		data-toggle="modal" data-target="#FormSuaSP{{ $d->ma_sp }}">
																		<em class="fa fa-edit"></em> </a>
																	<a href="" class="btn btn-sm btn-danger" style="padding: 0">
																		<form action="{{ route('admin-xoa-sp') }}" method="POST" onsubmit="return XacNhanXoa();">
																			@csrf
																			<input type="hidden" name="ma_sp" value="{{ $d->ma_sp }}">
																			<button type="submit" class="btn btn-sm btn-danger" style="padding: 0px 7px; outline: none">
																				<em class="fa fa-trash"></em>
																			</button>
																		</form>
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
									<small>{{$sanpham->links("pagination::bootstrap-4")}}</small>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		{{-- Thêm loại sản phẩm --}}
		<div class="modal fade" id="FormThemLoaiSP" data-backdrop="static" tabindex="-1">
			<div class="modal-dialog modal-dialog-centered" >
				<div class="modal-content" style="position: relative;">
					<div class="modal-header" style="padding: 7px 0 0 15px; border-bottom: 1px solid #8BD816">
						<h5 style="color: #8BD816; font-weight:bold">Thêm loại sản phẩm</h5>
						<button type="button" class="close" data-dismiss="modal" style="position: absolute; top: 7px; right: 7px;">
							<span>&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<form id="form-them-loaisp" action="{{ route('admin-them-loaisp') }}"  method="POST">
								@csrf
								<input type="text" name="ten_loaisp" class="form-control" required placeholder="Nhập tên loại sản phẩm" style="padding: 10px;">
								<button type="submit" class="btn btn-success" style="width: 100%; margin-top: 10px">
									<i class="fa fa-plus-circle"></i> Thêm mới loại sản phẩm
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		{{-- Sửa loại sản phẩm --}}
		@foreach ($loaisanpham as $d)
			<div class="modal fade" id="FormSuaLoaiSP{{ $d->ma_loaisp }}" data-backdrop="static" tabindex="-1">
				<div class="modal-dialog modal-dialog-centered" >
					<div class="modal-content" style="position: relative;">
						<div class="modal-header" style="padding: 7px 0 0 15px; border-bottom: 1px solid #30A5FF">
							<h5 style="color: #30A5FF; font-weight:bold">Cập nhật loại sản phẩm</h5>
							<button type="button" class="close" data-dismiss="modal" style="position: absolute; top: 7px; right: 7px;">
								<span>&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<form action="{{ route('admin-sua-loaisp') }}" method="POST">
									@csrf
									<input type="text" name="ten_loaisp" class="form-control" value="{{ $d->ten_loaisp }}" required placeholder="Tên loại sản phẩm">
									<input type="hidden" name="ma_loaisp" value="{{ $d->ma_loaisp }}">
									<button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 10px">
										<em class="fa fa-edit"></em> Cập nhật tên loại sản phẩm
									</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endforeach

		{{-- Thêm thành phần dinh dưỡng --}}
		<div class="modal fade" id="FormThemTPDD" data-backdrop="static" tabindex="-1">
			<div class="modal-dialog modal-dialog-centered" >
				<div class="modal-content" style="position: relative;">
					<div class="modal-header" style="padding: 7px 0 0 15px; border-bottom: 1px solid #8BD816">
						<h5 style="color: #8BD816; font-weight:bold">Thêm thành phần dinh dưỡng</h5>
						<button type="button" class="close" data-dismiss="modal" style="position: absolute; top: 7px; right: 7px;">
							<span>&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<form action="{{ route('admin-them-tpdd') }}" method="POST">
								@csrf
								<input type="text" name="ten_tpdd" class="form-control" required placeholder="Nhập tên thành phần dinh dưỡng" style="padding: 10px;">
								<button type="submit" class="btn btn-success" style="width: 100%; margin-top: 10px">
									<i class="fa fa-plus-circle"></i> Thêm mới thành phần dinh dưỡng
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		{{-- Sửa thành phần dinh dưỡng --}}
		@foreach ($thanhphandinhduong as $tpdd)
			<div class="modal fade" id="FormSuaTPDD{{ $tpdd->ma_tpdd }}" data-backdrop="static" tabindex="-1">
				<div class="modal-dialog modal-dialog-centered" >
					<div class="modal-content" style="position: relative;">
						<div class="modal-header" style="padding: 7px 0 0 15px; border-bottom: 1px solid #30A5FF">
							<h5 style="color: #30A5FF; font-weight:bold">Cập nhật thành phần dinh dưỡng</h5>
							<button type="button" class="close" data-dismiss="modal" style="position: absolute; top: 7px; right: 7px;">
								<span>&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<form action="{{ route('admin-sua-tpdd') }}" method="POST">
									@csrf
									<input type="text" name="ten_tpdd" class="form-control" value="{{ $tpdd->ten_tpdd }}" required placeholder="Tên thành phần dinh dưỡng">
									<input type="hidden" name="ma_tpdd" value="{{ $tpdd->ma_tpdd }}">
									<button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 10px">
										<em class="fa fa-edit"></em> Cập nhật tên loại sản phẩm
									</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endforeach

		{{-- Xem chi tiết sản phẩm --}}
		@foreach ($sanphamkhongphantrang as $item)
			<div class="modal fade" id="XemChiTiet{{ $item->ma_sp }}" tabindex="-1">
				<div class="modal-dialog modal-dialog-centered modal-lg" >
					<div class="modal-content" style="position: relative;">
						<div class="modal-header" style="padding: 7px 0 0 15px; border-bottom: 1px solid #8BD816">
							<h5 style="color: #8BD816; font-weight: bold">Xem chi tiết sản phẩm</h5>
							<button type="button" class="close" data-dismiss="modal" style="position: absolute; top: 7px; right: 7px;">
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
									<span>{{ $item->ten_sp }}</span><br>						
									<label>GIÁ: </label>
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
												<small> ---> </small><span style="color: red; font-weight: bold">{{ number_format($item->gia_sp - (($item->gia_sp * $spkm->khuyenmai->gia_tri_km) / 100),0,'.','.') }}<sup>VNĐ</sup></span>
											@else
												<small> ---> </small><span style="color: red; font-weight: bold">{{ number_format($item->gia_sp - $spkm->khuyenmai->gia_tri_km,0,'.','.') }}<sup>VNĐ</sup></span>
											@endif
										@endif
									@endforeach
									<br>
									<label>SỐ LƯỢNG: </label>
									<span>{{ $item->soluong_sp }}</span><br>
									{{-- <label>THÀNH PHẦN: </label>
									<span>hihi</span><br> --}}
									<label>CHI TIẾT SẢN PHẨM</label>
									<textarea style="width: 100%; border: none; resize: none; background-color: white" rows="7" disabled>{{ $item->chitiet_sp }}</textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endforeach
		{{-- Thêm sản phẩm  --}}
		<div class="modal fade" id="FormThemSP" data-backdrop="static" tabindex="-1">
			<div class="modal-dialog modal-dialog-centered" >
				<div class="modal-content" style="position: relative;">
					<div class="modal-header" style="padding: 7px 0 0 15px; border-bottom: 1px solid #8BD816">
						<h5 style="color: #8BD816; font-weight: bold">Thêm sản phẩm</h5>
						<button type="button" class="close" data-dismiss="modal" style="position: absolute; top: 7px; right: 7px;">
							<span>&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<form action="{{ route('admin-them-sp') }}" method="POST" name="formThemSP" onsubmit="return kiemTra()" class="form-them-sp" enctype="multipart/form-data">
								@csrf
								<input type="text" name="ten_sp" class="form-control" required placeholder="Nhập tên sản phẩm">
								<input type="file" name="hinh_sp" class="form-control" required>
								<textarea name="chitiet_sp" class="form-control" rows="5" required placeholder="Nhập chi tiết sản phẩm"></textarea>
								<input type="text" name="gia_sp" class="form-control" required placeholder="Nhập giá sản phẩm">
								{{--  <input type="text" name="soluong_sp" class="form-control" required placeholder="Nhập số lượng sản phẩm">  --}}
								<select name="ma_loaisp" class="form-control" onchange="hopLe()">
									<option value="0">Chọn loại cho sản phẩm</option>
									@foreach ($loaisanpham as $item)
										<option value="{{ $item->ma_loaisp }}">{{ $item->ten_loaisp }}</option>
									@endforeach
								</select>
								<small id="require" style="color: red">
								</small>
								<div class="row" style="position: relative; margin: 25px 0 5px 0; padding: 25px 10px 3px 10px; border: 1px solid #AAAAAA; border-radius: 3px">
									<small style="position: absolute; top: -10px; font-weight: bold; background-color: white; padding: 0 3px;">
										THÀNH PHẦN DINH DƯỠNG
									</small>
									@foreach ($thanhphandinhduong as $tpdd)
										<div class="col-md-4" style="padding: 0 5px">
											<span>
												<input style="position: relative" type="text" name="{{ $tpdd->ma_tpdd }}" class="form-control">
												<small style="position: absolute; left: 15px; top: -8px; font-weight: bold; background-color: white; padding: 0 3px; color: gray">
													{{ $tpdd->ten_tpdd }}
												</small>
											</span>
										</div>
									@endforeach
								</div>
								<button type="submit" class="btn btn-success" style="width: 100%; margin-top: 10px">
									<i class="fa fa-plus-circle"></i> Thêm mới sản phẩm
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		{{--  Sửa sản phẩm  --}}
		@foreach ($sanphamkhongphantrang as $item)
			<div class="modal fade" id="FormSuaSP{{ $item->ma_sp }}" data-backdrop="static" tabindex="-1">
				<div class="modal-dialog modal-dialog-centered" >
					<div class="modal-content" style="position: relative;">
						<div class="modal-header" style="padding: 7px 0 0 15px; border-bottom: 1px solid #30A5FF">
							<h5 style="color: #30A5FF; font-weight:bold">Cập nhật sản phẩm</h5>
							<button type="button" class="close" data-dismiss="modal" style="position: absolute; top: 7px; right: 7px;">
								<span>&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<form action="{{ route('admin-sua-sp') }}" method="POST" class="form-them-sp" enctype="multipart/form-data">
									@csrf
									<input type="text" name="ten_sp" class="form-control" value="{{ $item->ten_sp }}" required placeholder="Tên sản phẩm">
									<input type="file" name="hinh_sp" class="form-control">
									{{-- <img src="{{ $item->hinhSP }}" style="width: 40%; height: 150px; margin-bottom: 10px; border-radius: 3px"> --}}
									<textarea name="chitiet_sp" class="form-control" rows="5" required placeholder="Chi tiết sản phẩm">{{ $item->chitiet_sp }}</textarea>
									<input type="text" name="gia_sp" class="form-control" value="{{ $item->gia_sp }}" required placeholder="Giá sản phẩm">
									{{--  <input type="text" name="soluong_sp" class="form-control" value="{{ $item->soluong_sp }}" required placeholder="Số lượng sản phẩm">  --}}
									<select name="ma_loaisp" class="form-control">
										@foreach ($loaisanpham as $d)
											@if ($item->ma_loaisp == $d->ma_loaisp)
												<option value="{{ $d->ma_loaisp }}" selected>{{ $d->ten_loaisp }}</option>
											@else
												<option value="{{ $d->ma_loaisp }}">{{ $d->ten_loaisp }}</option>
											@endif
										@endforeach
									</select>
									<div class="row" style="position: relative; margin: 25px 0 5px 0; padding: 25px 10px 3px 10px; border: 1px solid #AAAAAA; border-radius: 3px">
										<small style="position: absolute; top: -10px; font-weight: bold; background-color: white; padding: 0 3px">
											THÀNH PHẦN DINH DƯỠNG
										</small>
										@foreach ($thanhphandinhduong as $tpdd)
											@foreach ($chitiettpdd as $cttpdd)
												@if ($cttpdd->ma_sp == $item->ma_sp && $cttpdd->ma_tpdd == $tpdd->ma_tpdd)
													<div class="col-md-4" style="padding: 0 5px">
														<span>
															<input style="position: relative" type="text" name="{{ $tpdd->ma_tpdd }}" class="form-control" required value="{{ $cttpdd->gia_tri }}">
															<small style="position: absolute; left: 15px; top: -8px; font-weight: bold; background-color: white; padding: 0 3px; color: gray">
																{{ $tpdd->ten_tpdd }}
															</small>
														</span>
													</div>
												@endif
											@endforeach
										@endforeach
									</div>
									<input type="hidden" name="ma_sp" value="{{ $item->ma_sp }}">
									<button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 10px">
										<em class="fa fa-edit"></em> Cập nhật sản phẩm
									</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endforeach
	</div>	<!--/.main-->
	  
	<script src="public/backend/js/jquery-1.11.1.min.js"></script>
	<script src="public/backend/js/bootstrap.min.js"></script>
	{{--  <script src="public/backend/js/chart.min.js"></script>
	<script src="public/backend/js/chart-data.js"></script>
	<script src="public/backend/js/easypiechart.js"></script>
	<script src="public/backend/js/easypiechart-data.js"></script>  --}}
	<script src="public/backend/js/bootstrap-datepicker.js"></script>
	{{-- <script src="public/backend/js/custom.js"></script> --}}
	<script src="public/backend/js/myScript.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="/public/frontend/js/sweetalert.min.js"></script>
	@if (session()->has('thatbai'))
        <script>swal("{{ session('thatbai') }}");</script>
    @endif
	<script>
		$("#form-tim-sp").on("submit", function () {
			event.preventDefault();
			$.ajax({
				url: "/admin/tim-san-pham",
				type: "post",
				data: $("#form-tim-sp").serialize(),
			}).done(function (reponse) {
				$("#change-sanpham").html(reponse);
			});
		});
	</script>
</body>
</html>
