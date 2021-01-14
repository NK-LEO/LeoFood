<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LeoFood - Slideshow</title>
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
			<li class="active"><a href="{{ route('admin-slideshow') }}"><em class="fa fa-toggle-off"></em> Khuyến mãi</a></li>
			<li><a href="{{ route('admin-product') }}"><em class="fa fa-clone"></em> Sản phẩm</a></li>
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
				<li class="active">Khuyến mãi & Slideshow</li>
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
						<span style="font-size: 17px; font-weight: bold; color: #30a5ff">THÔNG TIN CHƯƠNG TRÌNH KHUYẾN MÃI</span>
						<ul class="pull-right panel-settings panel-button-tab-right">
							<li class="dropdown">
								<a class="pull-right dropdown-toggle" data-toggle="modal" data-target="#FormThemCTKM" href="">
									<i class="fa fa-plus-square"></i>
								</a>
							</li>
						</ul>
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
					</div>
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
																	<th class="col-md-2">MÃ_KM</th>								
																	<th class="col-md-2">TÊN KHUYẾN MÃI</th>
																	<th class="col-md-2">NGÀY BẮT ĐẦU</th>
																	<th class="col-md-2">NGÀY KẾT THÚC</th>	
																	<th class="col-md-2">LOẠI KHUYẾN MÃI</th>											
																	<th class="col-md-2" style="text-align: right">LỰA CHỌN</th>
																</div>
															</tr>
														</thead>
														<tbody>
															@foreach ($khuyenmai as $km)
																<tr>
																	<div class="row">												
																		<td class="col-md-2">#{{ $km->ma_km }}</td>								
																		<td class="col-md-2">{{ $km->ten_km }}</td>											
																		<td class="col-md-2">{{ date('d-m-Y H:i:s', strtotime($km->ngay_bd)) }}</td>											
																		<td class="col-md-2">{{ date('d-m-Y H:i:s', strtotime($km->ngay_kt)) }}</td>										
																		<td class="col-md-2">
																			@if ($km->loai_km == 1)
																				Giảm theo % số tiền
																			@else
																				Giảm theo số tiền
																			@endif
																		</td>										
																		<td class="col-md-2" style="text-align: right">
																			<a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#XemChiTietKM{{ $km->ma_km }}" style="padding: 2px 7px 0px 7px; outline: none;">
																				<em class="fa fa-eye"></em>
																			</a>
																			<a href="" class="btn btn-sm btn-primary"
																				style="padding: 2px 7px 0px 7px; outline: none"
																				data-toggle="modal" data-target="#FormSuaKM{{ $km->ma_km }}">
																				<em class="fa fa-edit"></em> </a>
																			<a href="{{ route('admin-xoa-chuong-trinh-km', $km->ma_km) }}" class="btn btn-sm btn-danger" style="padding: 0" onclick="return XacNhanXoa()">
																				<button type="submit" class="btn btn-sm btn-danger" style="padding: 0px 7px; outline: none">
																					<em class="fa fa-trash"></em>
																				</button>
																			</a>
																		</td>
																	</div>
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
						<span style="font-size: 17px; font-weight: bold; color: #30a5ff">THÔNG TIN SLIDESHOW</span>
						<ul class="pull-right panel-settings panel-button-tab-right">
							<li class="dropdown">
								<a class="pull-right dropdown-toggle" data-toggle="modal" data-target="#FormThemSlides" href="">
									<i class="fa fa-plus-square"></i>
								</a>
							</li>
						</ul>
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
					</div>
					<div class="panel-body articles-container">
						<div class="article">
							<div class="col-xs-12">
								<div class="row">
									@php
										$i=1;
									@endphp
									@foreach ($slideshow as $item)
										<div class="col-md-2" style="margin-top: 15px; margin-bottom: 20px">
											<div class="card" style="border: 1px solid #AAAAAA; border-radius: 3px; padding: 8px; position: relative">
												<small style="position: absolute; top: -10px; font-weight: bold; background-color: white; padding: 0 3px">
													[{{ $i }}]
												</small>
												<img src="{{ $item->hinh_slides }}" class="card-img-top" style="border-radius: 3px" width="100%" height="100px">
												<p></p>
												<div class="card-body">
													<table>
														<tr>
															<td>
																<a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#FormSuaSlides{{ $item->ma_slides }}" style="margin-right: 5px; padding: 2px 5px">
																	<em class="fa fa-edit"></em> Sửa
																</a>
															</td>
															<td>
																<a href="" class="btn btn-sm btn-danger" style="padding: 0">
																	<form action="{{ route('admin-xoa-slideshow') }}" method="POST" onsubmit="return XacNhanXoa();">
																		@csrf
																		<input type="hidden" name="ma_slides" value="{{ $item->ma_slides }}">
																		<button type="submit" class="btn btn-sm btn-danger" style="padding: 1px 5px">
																			<em class="fa fa-trash"></em> Xóa
																		</button>
																	</form>
																</a>
															</td>
														</tr>
													</table>
												</div>
											</div>
										</div>
										@php
											$i++;
										@endphp
									@endforeach
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Thêm Slideshow -->
		<div class="modal fade" id="FormThemSlides" data-backdrop="static" tabindex="-1">
			<div class="modal-dialog modal-dialog-centered" >
				<div class="modal-content" style="position: relative;">
					<div class="modal-header" style="padding: 7px 0 0 15px; border-bottom: 1px solid #8BD816">
						<h5 style="color: #8BD816; font-weight:bold">Thêm Slideshow</h5>
						<button type="button" class="close" data-dismiss="modal" style="position: absolute; top: 7px; right: 7px;">
							<span>&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<form action="{{ route('admin-them-slideshow') }}" method="POST" enctype="multipart/form-data">
								@csrf
								<input type="file" name="hinh_slides" required class="form-control" required>
								<button type="submit" class="btn btn-success" style="width: 100%; margin-top: 10px">
									<i class="fa fa-plus-circle"></i> Thêm mới Slideshow
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Sửa Slideshow -->
		@foreach ($slideshow as $item)
			<div class="modal fade" id="FormSuaSlides{{ $item->ma_slides }}" data-backdrop="static" tabindex="-1">
				<div class="modal-dialog modal-dialog-centered" >
					<div class="modal-content" style="position: relative;">
						<div class="modal-header" style="padding: 7px 0 0 15px; border-bottom: 1px solid #30A5FF">
							<h5 style="color: #30A5FF; font-weight:bold">Cập nhật hình ảnh Slideshow</h5>
							<button type="button" class="close" data-dismiss="modal" style="position: absolute; top: 7px; right: 7px;">
								<span>&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<form action="{{ route('admin-sua-slideshow') }}" method="POST" enctype="multipart/form-data">
									@csrf
									<input type="hidden" name="ma_slides" value="{{ $item->ma_slides }}">
									<input type="file" name="hinh_slides" class="form-control" required>
									<small style="margin-left: 3%"><i class="fa fa-exclamation-triangle"></i> 
										Nếu muốn cập nhật lại hình ảnh khác, vui lòng chọn ảnh mới
									</small>
									<button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 10px">
										<em class="fa fa-edit"></em> Cập nhật Slideshow
									</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endforeach

		{{-- Xem chi tiết chương trình khuyến mãi --}}
		@foreach ($khuyenmai as $d)
		<div class="modal fade" id="XemChiTietKM{{ $d->ma_km }}" data-backdrop="static" tabindex="-1">
			<div class="modal-dialog modal-dialog-centered modal-lg">
				<div class="modal-content" style="position: relative;">
					<div class="modal-header" style="padding: 7px 0 0 15px; border-bottom: 1px solid #8BD816">
						<h5 style="color: #8BD816; font-weight:bold">Chi tiết chương trình khuyến mãi</h5>
						<button type="button" class="close" data-dismiss="modal" style="position: absolute; top: 7px; right: 7px;">
							<span>&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<label>{{ $d->ten_km }}</label><br>
									<span>{{ $d->noi_dung_km }}</span>
								</div>
								<div class="col-md-4">
									<label>Ngày bắt đầu:</label><span> {{ $d->ngay_bd }}</span>
									<label>Ngày kết thúc:</label><span> {{ $d->ngay_kt }}</span>
								</div>
								<div class="col-md-4">
									<div>
										<label>Loại khuyến mãi: </label>
										<span>
											@if ($d->loai_km == 1)
												giảm theo % số tiền
											@else
												giảm theo số tiền
											@endif
										</span>
									</div>
									<div>
										<label>Giảm: </label>
										<span style="padding: 0 5px; background-color: Gold; border-radius: 2px">
											@if ($d->loai_km == 1)
												{{ $d->gia_tri_km }}%
											@else
												{{ number_format($d->gia_tri_km,0,'.','.') }}<sup>VNĐ</sup>
											@endif
										</span>
									</div>
								</div>
								<div class="col-md-12" style="margin-top: 10px">
									<label>Những sản phẩm được khuyến mãi: </label>
									<div class="row">
										@foreach ($sanphamkhuyenmai as $spkm)
											@if ($spkm->ma_km == $d->ma_km)
												<div class="col-md-3" style="margin: 5px 0">
													<img src="{{ $spkm->sanpham->hinh_sp }}" style="width: 100%; height: 100px; border-radius: 3px">
													<span>{{ $spkm->sanpham->ten_sp }}</span>
												</div>
											@endif
										@endforeach
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endforeach
		{{-- Thêm chương trình khuyến mãi --}}
		<div class="modal fade" id="FormThemCTKM" data-backdrop="static" tabindex="-1">
			<div class="modal-dialog modal-dialog-centered" >
				<div class="modal-content" style="position: relative;">
					<div class="modal-header" style="padding: 7px 0 0 15px; border-bottom: 1px solid #8BD816">
						<h5 style="color: #8BD816; font-weight:bold">Thêm chương trình khuyến mãi</h5>
						<button type="button" class="close" data-dismiss="modal" style="position: absolute; top: 7px; right: 7px;">
							<span>&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<form action="{{ route('admin-them-chuong-trinh-km') }}" method="POST" onsubmit="return kiemTraCTKM()">
								@csrf
								<div class="form-group">
									<label>Tên khuyến mãi</label>
									<input type="text" class="form-control" name="ten_km" required placeholder="Nhập tên khuyến mãi">
								  </div>
								<div class="row">
									<div class="form-group col-md-6">
										<label>Ngày bắt đầu</label>
										<input type="datetime-local" class="form-control" required name="ngay_bd">
									</div>
									<div class="form-group col-md-6">
										<label>Ngày kết thúc</label>
										<input type="datetime-local" class="form-control" required name="ngay_kt">
									</div>
								</div>
								<div class="form-group">
								  	<label>Nội dung khuyến mãi</label>
									<textarea class="form-control" rows="5" name="noi_dung_km" required placeholder="Nhập nội dung khuyến mãi"></textarea>
								</div>
								<div class="row">
									<div class="form-group col-md-6">
										<label>Loại chương trình khuyến mãi</label>
										<select class="form-control" name="loai_km">
											<option value="1">Giảm theo % số tiền</option>
											<option value="2">Giảm theo số tiền</option>
										</select>
									</div>
									<div class="form-group col-md-6">
										<label>Mức giá (% hoặc VNĐ)</label>
										<input type="text" class="form-control" name="gia_tri_km" required placeholder="Nhập mức giá">
										<small class="form-text text-muted">
											Lưu ý chỉ nhập số (Không nhập đơn vị)
										</small>
									</div>
								</div>
								<div class="form-group">
									<label>Áp dụng cho</label>
									<select class="form-control">
										<option value="">Nhóm sản phẩm</option>
									</select>
								</div>
								<div class="form-group">
									<label>Nhóm sản phẩm</label>
									<select id="nhom_sp" class="form-control" name="nhom_sp">
										<option value="0">Chọn...</option>
										@foreach ($loaisanpham as $item)
											<option value="{{ $item->ma_loaisp }}">{{ $item->ten_loaisp }}</option>
										@endforeach
									</select>
									<small id="thongbao" style="color: red"></small>
								</div>
								<button type="submit" class="btn btn-success" style="width: 100%; margin-top: 10px">
									<i class="fa fa-plus-circle"></i> Thêm chương trình khuyến mãi
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		{{-- Sửa chương trình khuyến mãi --}}
		@foreach ($khuyenmai as $d)
		<div class="modal fade" id="FormSuaKM{{ $d->ma_km }}" data-backdrop="static" tabindex="-1">
			<div class="modal-dialog modal-dialog-centered" >
				<div class="modal-content" style="position: relative;">
					<div class="modal-header" style="padding: 7px 0 0 15px; border-bottom: 1px solid #30A5FF">
						<h5 style="color: #30A5FF; font-weight:bold">Cập nhật chương trình khuyến mãi</h5>
						<button type="button" class="close" data-dismiss="modal" style="position: absolute; top: 7px; right: 7px;">
							<span>&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<form action="{{ route('admin-sua-chuong-trinh-km') }}" method="POST">
								@csrf
								<div class="form-group">
									<label>Tên khuyến mãi</label>
									<input type="text" class="form-control" name="ten_km" value="{{ $d->ten_km }}" required placeholder="Nhập tên khuyến mãi">
								  </div>
								<div class="row">
									<div class="form-group col-md-6">
										<label>Ngày bắt đầu</label>
										<input type="datetime-local" class="form-control" name="ngay_bd" required value="{{ date('Y-m-d\TH:i', strtotime($d->ngay_bd)) }}">
									</div>
									<div class="form-group col-md-6">
										<label>Ngày kết thúc</label>
										<input type="datetime-local" class="form-control" name="ngay_kt" required value="{{ date('Y-m-d\TH:i', strtotime($d->ngay_kt)) }}">
									</div>
								</div>
								<div class="form-group">
								  	<label>Nội dung khuyến mãi</label>
									<textarea class="form-control" rows="5" name="noi_dung_km" required placeholder="Nhập nội dung khuyến mãi">{{ $d->noi_dung_km }}</textarea>
								</div>
								<div class="row">
									<div class="form-group col-md-6">
										<label>Loại chương trình khuyến mãi</label>
										<select class="form-control" name="loai_km">
											@if ($d->loai_km == 1)
												<option value="1" selected>Giảm theo % số tiền</option>
												<option value="2">Giảm theo số tiền</option>
											@else
												<option value="1">Giảm theo % số tiền</option>
												<option value="2" selected>Giảm theo số tiền</option>
											@endif
										</select>
									</div>
									<div class="form-group col-md-6">
										<label>Mức giá (% hoặc VNĐ)</label>
										<input type="text" class="form-control" name="gia_tri_km" required value="{{ $d->gia_tri_km }}" placeholder="Nhập mức giá">
										<small class="form-text text-muted">
											Lưu ý chỉ nhập số (Không nhập đơn vị)
										</small>										  
									</div>
								</div>
								<div class="form-group">
									<label>Áp dụng cho</label>
									<select class="form-control">
										<option value="">Nhóm sản phẩm</option>
									</select>
								</div>
								<div class="form-group">
									<label>Nhóm sản phẩm</label>
									<select class="form-control" name="nhom_sp">
										@foreach ($loaisanpham as $item)
											@if ($item->ma_loaisp == $d->ma_loaisp)
												<option selected value="{{ $item->ma_loaisp }}">{{ $item->ten_loaisp }}</option>
											@else
												<option value="{{ $item->ma_loaisp }}">{{ $item->ten_loaisp }}</option>
											@endif
										@endforeach
									</select>
								</div>
								<input type="hidden" value="{{ $d->ma_km }}" name="ma_km">
								<button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 10px">
									<i class="fa fa-plus-circle"></i> Cập nhật chương trình khuyến mãi
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
	<script src="public/backend/js/bootstrap-datepicker.js"></script>
	<script src="public/backend/js/custom.js"></script>
	<script src="public/backend/js/myScript.js"></script>
	<script>
		function kiemTraCTKM(){
			var ok = true;
			var nhomSP = document.getElementById("nhom_sp").value;

			if(nhomSP == 0){
				document.getElementById("thongbao").innerHTML = "<i class='fa fa-exclamation-triangle'></i> Vui lòng chọn nhóm sản phẩm khuyến mãi";
				document.getElementById("thongbao").style.marginLeft = "3%";
				ok = false;
			}
			return ok;
		}
	</script>
</body>
</html>
