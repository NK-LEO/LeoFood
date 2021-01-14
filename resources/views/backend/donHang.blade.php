<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LeoFood - Đơn hàng</title>
	<base href="{{ asset('') }}">
	<link href="public/backend/css/bootstrap.min.css" rel="stylesheet">
	<link href="public/backend/css/font-awesome.min.css" rel="stylesheet">
	<link href="public/backend/css/datepicker3.css" rel="stylesheet">
	<link href="public/backend/css/styles.css" rel="stylesheet">
	<style>
		.trangThaiDH option{
			background-color: white;
			color: black;
		}
	</style>
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
			<li><a href="{{ route('admin-warehouse-product') }}"><i class="fa fa-briefcase"></i> Kho sản phẩm</a></li>
			<li class="active"><a href="{{ route('admin-don-hang') }}"><em class="fa fa-opencart"></em> Đơn hàng</a></li>
			<li><a href="{{ route('dang-xuat') }}"><em class="fa fa-power-off"></em> Logout</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Đơn hàng</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h3 class="page-header">
					
				</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default" style="text-align: center; padding: 4px 0">
					<div class="large">{{ $tongDHCXN }}</div>
					<p>Đơn hàng chờ xác nhận</p>	
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default" style="text-align: center; padding: 4px 0">
					<div class="large">{{ $tongDHDG }}</div>
					<p>Đơn hàng đang giao</p>	
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default" style="text-align: center; padding: 4px 0">
					<div class="large">{{ $tongDHDaG }}</div>
					<p>Đơn hàng đã giao</p>	
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default" style="text-align: center; padding: 4px 0">
					<div class="large">{{ $tongDHTTOnline }}</div>
					<p>Đơn hàng đã thanh toán online</p>	
				</div>
			</div>
		</div><!--/.row-->
		<div class="row">
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default" style="text-align: center; padding: 4px 0">
					<div class="large">{{ $tongDHTTTT }}</div>
					<p>Đơn hàng đã thanh toán trực tiếp</p>	
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default" style="text-align: center; padding: 4px 0">
					<div class="large">{{ $tongDHChuaTT }}</div>
					<p>Đơn hàng chưa thanh toán</p>	
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default" style="text-align: center; padding: 4px 0">
					<div class="large">{{ $tongDHThanhVien }}</div>
					<p>Đơn hàng của thành viên</p>	
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default" style="text-align: center; padding: 4px 0">
					<div class="large">{{ $tongDHKhachVangLai }}</div>
					<p>Đơn hàng của khách vãng lai</p>	
				</div>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default articles">
					<div class="panel-heading">
						<span style="font-size: 17px; font-weight: bold; color: #30a5ff">THÔNG TIN TẤT CẢ ĐƠN HÀNG</span>
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
					</div>
					<div class="panel-body articles-container">
						<div class="row">
							<form id="formFilterOrder">
								@csrf
								<div class="col-md-6">
									<div class="col-md-6" style="padding-right: 0;">
										<select name="selectOrder" id="selectOrder" class="form-control" onclick="document.getElementById('message').innerHTML=''">
											<option value="00">Chọn...</option>
											<option value="0">Đơn hàng chờ xác nhận</option>
											<option value="1">Đơn hàng đang giao</option>
											<option value="2">Đơn hàng đã giao</option>
											<option value="3">Đơn hàng đã thanh toán online</option>
											<option value="4">Đơn hàng đã thanh toán trực tiếp</option>
											<option value="5">Đơn hàng chưa thanh toán</option>
											<option value="6">Đơn hàng của thành viên</option>
											<option value="7">Đơn hàng khách vãng lai</option>
										</select>
										<small id="message" style="color: red; margin-left: 3%" class="form-text"></small>
									</div>
									<div class="col-md-6">
										<button type="submit" class="btn btn-info" style="width: 80%; outline: none;"><i class="fa fa-spinner"></i> XEM KẾT QUẢ</button>
									</div>
									<div class="col-md-12">
										<p>- Những đơn hàng có <b>mã in đậm</b> là những đơn hàng đã thanh toán online</p>
										{{-- <p>- Có tất cả: <b>{{ $donhang->count() }}</b> đơn hàng</p> --}}
									</div>
								</div>
							</form>
							<div class="col-md-1"></div>
							<div class="col-md-5" >
								<form id="locDonHangTheoNgay">
									@csrf
									<div class="row">
										<div class="form-group col-md-6">
											<label>Từ ngày: </label>
											<input type="datetime-local" class="form-control" required name="ngay_tu">
										</div>
										<div class="form-group col-md-6">
											<label>Đến ngày: </label>
											<input type="datetime-local" class="form-control" required name="ngay_den">
										</div>
										<div class="col-md-6"></div>
										<div class="col-md-6">
											<button type="submit" class="btn btn-info" style="width: 100%; outline: none;"><i class="fa fa-spinner"></i> XEM KẾT QUẢ</button>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="article" style="margin-top: 10px">
							<div class="col-xs-12" id="change-Order">
								<div class="row">
									@foreach ($donhang as $item)
                                    @endforeach
                                    @if (!empty($item->ma_dh))
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
																<th style="text-align: center">MÃ_ĐH</th>
																<th style="text-align: center">TÊN</th>
																<th style="text-align: center">ĐỊA CHỈ</th>
																<th style="text-align: center">SĐT</th>
																<th style="text-align: center">TỔNG TIỀN</th>
																<th style="text-align: center">TRẠNG THÁI</th>
																<th style="text-align: center">LỰA CHỌN</th>
															</tr>
														</thead>
														<tbody>
															@foreach ($donhang as $item)
															<tr>
																<td style="height: 50px; line-height: 50px; text-align: center">
																	@if ($item->trang_thai_tt == 2)
																		<b>#{{ $item->ma_dh }}</b>
																	@else
																		#{{ $item->ma_dh }}	
																	@endif
																</td>
																<td style="height: 50px; line-height: 50px; text-align: center">
																	{{ $item->ten_nn }}
																</td>
																<td style="height: 50px; line-height: 50px; text-align: center">
																	{{ $item->diachi_nn }}
																</td>
																<td style="height: 50px; line-height: 50px; text-align: center">
																	{{ $item->sdt_nn }}
																</td>
																<td style="height: 50px; line-height: 50px; text-align: center">
																	{{ number_format($item->tongtien,0,'.','.') }}<sup>VNĐ</sup>
																</td>
																<td style="height: 50px; line-height: 50px; text-align: center;">
																	@php
																		if($item->trang_thai_dh == 0){
																			$bg = "background-color: #f9243f";
																		}else if($item->trang_thai_dh == 1){
																			$bg = "background-color: #f0ad4e";
																		}else {
																			$bg = "background-color: #8ad919";
																		}
																	@endphp
																	<select class="trangThaiDH" id="trangThaiDH{{ $item->ma_dh }}" onchange="return changeBackground({{ $item->ma_dh }}, this.value)" style="cursor: pointer; padding: 1px 0px 4px 0px; border-radius: 3px; border: none; color: white; outline: none; {{ $bg }}">
																		@if ($item->trang_thai_dh == 0)
																			<option value="0" selected>Chờ xác nhận</option>
																			<option value="1">Đang giao</option>
																			<option value="2">Đã giao</option>
																		@elseif($item->trang_thai_dh == 1)
																			<option value="0">Chờ xác nhận</option>
																			<option value="1" selected>Đang giao</option>
																			<option value="2">Đã giao</option>
																		@else
																			<option value="0">Chờ xác nhận</option>
																			<option value="1">Đang giao</option>
																			<option value="2" selected>Đã giao</option>
																		@endif
																	</select>
																</td>
																<td style="height: 50px; line-height: 50px; text-align: center">
																	<a href="{{ route('admin-chi-tiet-don-hang', $item->ma_dh) }}" class="btn btn-sm btn-success" style="padding: 2px 7px; outline: none;">
																		<em class="fa fa-eye"></em> Xem chi tiết
																	</a>
																</td>
															</tr>
															@endforeach
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</section>
                                    @else
										<div style="text-align: center; margin: 100px 0">
											<img src="/public/frontend/images/temp1.webp" style="width: 100px; height: 100px; margin: 0 auto">
											<p style="margin-top: 10px">Chưa có đơn hàng!</p>
										</div>
                                    @endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		
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
		function changeBackground(ma_dh, value){
			$.ajax({
				type: "post",
				url: "/admin/giao-hang",
				data: {
					_token: "{{ csrf_token() }}",
					ma_dh: ma_dh,
					trang_thai_dh: value,
				}
			});
        	if(value == 0){
				document.getElementById("trangThaiDH" + ma_dh).style.backgroundColor = "#f9243f";
			}else if(value == 1){
				document.getElementById("trangThaiDH" + ma_dh).style.backgroundColor = "#f0ad4e";
			}else{
				document.getElementById("trangThaiDH" + ma_dh).style.backgroundColor = "#8ad919";
			}
		}
	</script>
	<script>
        $("#formFilterOrder").on("submit", function () {
            var ok = true;
            var order = document.getElementById('selectOrder').value;
            if (order == '00') {
                document.getElementById("message").innerHTML = "<i class='fa fa-exclamation-triangle'></i> Vui lòng chọn trạng thái đơn hàng";
                ok = false;
            } else {
                document.getElementById("message").innerHTML = "";
                event.preventDefault();
                $.ajax({
                    url: "/admin/filter-order",
                    type: "post",
                    data: $("#formFilterOrder").serialize(),
                }).done(function (reponse) {
                    $("#change-Order").html(reponse);
                });
            }
            return ok;
        });
	</script>
	<script>
		$("#locDonHangTheoNgay").on("submit", function () {
            event.preventDefault();
			$.ajax({
				url: "/admin/loc-don-hang-theo-ngay",
				type: "post",
				data: $("#locDonHangTheoNgay").serialize(),
			}).done(function (reponse) {
				$("#change-Order").html(reponse);
			});
        });
	</script>
</body>
</html>
