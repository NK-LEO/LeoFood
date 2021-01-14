<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard</title>
	<base href="{{ asset('') }}">
	<link href="public/backend/css/bootstrap.min.css" rel="stylesheet">
	<link href="public/backend/css/font-awesome.min.css" rel="stylesheet">
	<link href="public/backend/css/datepicker3.css" rel="stylesheet">
	<link href="public/backend/css/styles.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css">
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<style>
		.vaiTroTK option, .trangThaiTK option{
			background-color: white;
			color: black;
		}
	</style>
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
			<li class="active"><a href="{{ route('admin') }}"><em class="fa fa-dashboard"></em> Dashboard</a></li>
			<li><a href="{{ route('admin-slideshow') }}"><em class="fa fa-toggle-off"></em> Khuyến mãi</a></li>
			<li><a href="{{ route('admin-product') }}"><em class="fa fa-clone"></em> Sản phẩm</a></li>
			<li><a href="{{ route('admin-statistical-product') }}"><i class="fa fa-bar-chart"></i> Thống kê sản phẩm</a></li>
			<li><a href="{{ route('admin-warehouse-product') }}"><i class="fa fa-briefcase"></i> Kho sản phẩm</a></li>
			<li><a href="{{ route('admin-don-hang') }}"><em class="fa fa-opencart"></em> Đơn hàng</a></li>
			<li><a href="{{ route('dang-xuat') }}"><em class="fa fa-power-off"></em> Đăng xuất</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Dashboard</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Dashboard</h1>
			</div>
		</div><!--/.row-->
		
		<div class="panel panel-container">
			<div class="row">
				<div class="col-xs-6 col-md-4 col-lg-4 no-padding">
					<div class="panel panel-teal panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-shopping-cart color-blue"></em>
							<div class="large">{{ $soluongdonhang }}</div>
							<div class="text-muted">All Orders</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-4 col-lg-4 no-padding">
					<div class="panel panel-blue panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-comments color-orange"></em>
							<div class="large">{{ $comment }}</div>
							<div class="text-muted">Comments</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-4 col-lg-4 no-padding">
					<div class="panel panel-orange panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-users color-teal"></em>
							<div class="large">{{ $user }}</div>
							<div class="text-muted">All Users</div>
						</div>
					</div>
				</div>
				{{--  <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-red panel-widget ">
						<div class="row no-padding"><em class="fa fa-xl fa-search color-red"></em>
							<div class="large">25.2k</div>
							<div class="text-muted">Page Views</div>
						</div>
					</div>
				</div>  --}}
			</div><!--/.row-->
		</div>

		<div class="panel panel-container" style="padding: 20px">
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-8">
						<span style="font-size: 17px; font-weight: bold; color: #30a5ff">DOANH THU</span>
						</div>
						<form id="formFilterRevenue">
							@csrf
							<div class="col-md-2" style="padding-right: 0">
								<select name="selectYear" class="form-control">
									@foreach ($year as $y)
										@if ($y->getYear == date('Y'))
											<option selected value="{{ $y->getYear }}">{{ $y->getYear }}</option>
										@else
											<option value="{{ $y->getYear }}">{{ $y->getYear }}</option>
										@endif
									@endforeach
								</select>
							</div>
							<div class="col-md-2">
								<button type="submit" class="btn btn-info" style="width: 100%; outline: none;"><i class="fa fa-spinner"></i> XEM KẾT QUẢ</button>
							</div>
						</form>
						<div class="col-md-7"></div>
						<div class="col-md-5" style="padding-top: 30px">
							<form id="locDoanhThuTheoNgay">
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
									<div class="col-md-12">
										<button type="submit" class="btn btn-info" style="width: 100%; outline: none;"><i class="fa fa-spinner"></i> XEM KẾT QUẢ</button>
									</div>
									{{-- <div class="col-md-6"></div> --}}
								</div>
							</form>
						</div>
					</div>
					<div id="change-Revenue">
						<p>Tổng doanh thu năm {{ date('Y') }} là <span style="background-color: yellow; padding: 0 3px">{{ number_format($tongdoanhthu,0,'.','.') }}<sup>VNĐ</sup></span></p>
						<canvas id="myChart" height="100"></canvas>
					</div>
				</div>
			</div><!--/.row-->
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default articles">
					<div class="panel-heading">
						<span style="font-size: 17px; font-weight: bold; color: #30a5ff">THÔNG TIN TÀI KHOẢN</span>
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
																	<th class="col-md-2">MÃ_TK</th>								
																	<th class="col-md-2">TÊN</th>
																	<th class="col-md-2">EMAIL</th>
																	<th class="col-md-2">SĐT</th>	
																	<th class="col-md-2">VAI TRÒ</th>											
																	<th class="col-md-2">TRẠNG THÁI</th>
																</div>
															</tr>
														</thead>
														<tbody>
															@foreach ($thanhvien as $t)
																<tr>
																	<div class="row">												
																		<td class="col-md-2">#{{ $t->ma_tv }}</td>								
																		<td class="col-md-2">{{ $t->ten_tv }}</td>											
																		<td class="col-md-2">{{ $t->email_tv }}</td>											
																		<td class="col-md-2">{{ $t->sdt_tv }}</td>										
																		<td class="col-md-2">
																			@php
																				if($t->vaitro == 2){
																					$bg = "background-color: #ffb53e";
																				}else if($t->vaitro == 1){
																					$bg = "background-color: #1ebfae";
																				}else {
																					$bg = "background-color: grey";
																				}
																			@endphp
																			<select class="vaiTroTK" id="vaiTroTK{{ $t->ma_tv }}" onchange="return changeBackgroundVTTK({{ $t->ma_tv }}, this.value)" style="cursor: pointer; padding: 1px 0px 4px 0px; border-radius: 3px; border: none; color: white; outline: none; {{ $bg }}">
																				@if ($t->vaitro == 2)
																					<option value="2" selected>Chủ cửa hàng</option>
																					<option value="1">Nhân viên</option>
																					<option value="0">Khách hàng</option>
																				@elseif($t->vaitro == 1)
																					<option value="2">Chủ cửa hàng</option>
																					<option value="1" selected>Nhân viên</option>
																					<option value="0">Khách hàng</option>
																				@else
																					<option value="2">Chủ cửa hàng</option>
																					<option value="1">Nhân viên</option>
																					<option value="0" selected>Khách hàng</option>
																				@endif
																			</select>	
																		</td>										
																		<td class="col-md-2">
																			@php
																				if($t->trangthai == 0){
																					$bg = "background-color: #8ad919";
																				}else {
																					$bg = "background-color: #f9243f";
																				}
																			@endphp
																			<select class="trangThaiTK" id="trangThaiTK{{ $t->ma_tv }}" onchange="return changeBackgroundTTTK({{ $t->ma_tv }}, this.value)" style="cursor: pointer; padding: 1px 0px 4px 0px; border-radius: 3px; border: none; color: white; outline: none; {{ $bg }}">
																				@if ($t->trangthai == 0)
																					<option value="0" selected>Hoạt động</option>
																					<option value="1">Bị khóa</option>
																				@else
																					<option value="0">Hoạt động</option>
																					<option value="1" selected>Bị khóa</option>
																				@endif
																			</select>
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
		</div>

	</div>	<!--/.main-->
	
	<script src="public/backend/js/jquery-1.11.1.min.js"></script>
	<script src="public/backend/js/bootstrap.min.js"></script>
	<script src="public/backend/js/bootstrap-datepicker.js"></script>
	<script src="public/backend/js/custom.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
	<script>
		var ctx = document.getElementById('myChart');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: {{ json_encode($thang) }},
				datasets: [{
					label: 'Doanh thu',
					data: {{ json_encode($tongtien) }},
					backgroundColor: '#B0E0E6',
					maxBarThickness: 50,
				}]
			},
			options: {
				title: {
					display: true,
					text: 'Biểu đồ doanh thu các tháng trong năm {{ date('Y') }}',
					fontSize: 20,
				},
				legend: {
					// display: false,
				},
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero: true
						}
					}]
				}
			}
		});
	</script>
	<script>
		function changeBackgroundVTTK(ma_tk, value){
			$.ajax({
				type: "post",
				url: "/admin/thay-doi-vai-tro",
				data: {
					_token: "{{ csrf_token() }}",
					ma_tv: ma_tk,
					vaitro: value,
				}
			});
			if(value == 2){
				document.getElementById("vaiTroTK" + ma_tk).style.backgroundColor = "#ffb53e";
			}else if(value == 1){
				document.getElementById("vaiTroTK" + ma_tk).style.backgroundColor = "#1ebfae";
			}else{
				document.getElementById("vaiTroTK" + ma_tk).style.backgroundColor = "grey";
			}
		}

		function changeBackgroundTTTK(ma_tk, value){
			$.ajax({
				type: "post",
				url: "/admin/thay-doi-trang-thai-tk",
				data: {
					_token: "{{ csrf_token() }}",
					ma_tv: ma_tk,
					trangthai: value,
				}
			});
			if(value ==0){
				document.getElementById("trangThaiTK" + ma_tk).style.backgroundColor = "#8ad919";
			}else{
				document.getElementById("trangThaiTK" + ma_tk).style.backgroundColor = "#f9243f";
			}
		}
	</script>
	<script>
        $("#formFilterRevenue").on("submit", function () {
            event.preventDefault();
			$.ajax({
				url: "/admin/filter-revenue",
                    type: "post",
                    data: $("#formFilterRevenue").serialize(),
                }).done(function (reponse) {
                    $("#change-Revenue").html(reponse);
            });
        });
	</script>
	<script>
		$("#locDoanhThuTheoNgay").on("submit", function () {
            event.preventDefault();
			$.ajax({
				url: "/admin/loc-doanh-thu-theo-ngay",
				type: "post",
				data: $("#locDoanhThuTheoNgay").serialize(),
			}).done(function (reponse) {
				$("#change-Revenue").html(reponse);
			});
        });
	</script>
</body>
</html>