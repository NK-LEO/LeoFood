<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LeoFood - Thống kê sản phẩm</title>
	<base href="{{ asset('') }}">
	<link href="public/backend/css/bootstrap.min.css" rel="stylesheet">
	<link href="public/backend/css/font-awesome.min.css" rel="stylesheet">
	<link href="public/backend/css/datepicker3.css" rel="stylesheet">
    <link href="public/backend/css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css">
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
			<li class="active"><a href="{{ route('admin-statistical-product') }}"><i class="fa fa-bar-chart"></i> Thống kê sản phẩm</a></li>
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
				<li class="active">Thống kê sản phẩm</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h3 class="page-header" style="text-align: right">
					
				</h3>
			</div>
		</div>

		<div class="row">
            <div class="col-md-12">
				<div class="panel panel-default articles">
					<div class="panel-heading">
						<span style="font-size: 17px; font-weight: bold; color: #30a5ff">CHI TIẾT THỐNG KÊ SẢN PHẨM</span>
						<span class="pull-right clickable panel-toggle panel-button-tab-left">
							<em class="fa fa-toggle-up"></em>
						</span>
					</div>
					<div class="panel-body articles-container">
						<div class="article">
							<div class="col-xs-12">
								<div class="row">
									<div class="col-md-6" style="padding-bottom: 40px">
										<form id="locSanPhamTKTheoNgay">
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
													<button type="submit" class="btn btn-sm btn-info" style="width: 100%; outline: none;"><i class="fa fa-spinner"></i> XEM KẾT QUẢ</button>
												</div>
												{{-- <div class="col-md-6"></div> --}}
											</div>
										</form>
									</div>
									<div class="col-md-2"></div>
									<div class="col-md-4">
										<form id="formFilterStatisticalProduct">
											@csrf
											<div class="row">
												<div class="form-group col-md-6">
													<label>Tháng</label>
													<select name="selectMonth" id="selectMonth" class="form-control" onclick="return document.getElementById('message').innerHTML = ''">
														<option value="0">Chọn...</option>
														<option value="01">1</option>
														<option value="02">2</option>
														<option value="03">3</option>
														<option value="04">4</option>
														<option value="05">5</option>
														<option value="06">6</option>
														<option value="07">7</option>
														<option value="08">8</option>
														<option value="09">9</option>
														<option value="10">10</option>
														<option value="11">11</option>
														<option value="12">12</option>
													</select>
													<small id="message" style="color: red; margin-left: 3%" class="form-text"></small>
												</div>
												<div class="form-group col-md-6">
													<label>Năm</label>
													<select name="selectYear" class="form-control">
														@foreach ($year as $y)
															@if ($y->getYear == date('Y'))
																<option selected value="{{ $y->getYear }}">{{ $y->getYear }}</option>
															@else
																<option value="{{ $y->getYear }}">{{ $y->getYear }}</option>
															@endif
														@endforeach
													</select>
													<br>
													<button type="submit" class="btn btn-sm btn-info" style="width: 100%; outline: none"><i class="fa fa-spinner"></i> XEM KẾT QUẢ</button>
												</div>
											</div>
										</form>
									</div>
									<div id="change-StatisticalProduct">
										<canvas id="myChart" height="100"></canvas>
										<br>
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
																	<th class="col-md-2">TÊN SẢN PHẨM</th>
																	<th class="col-md-4" style="text-align: center">HÌNH ẢNH</th>
																	<th class="col-md-2" style="text-align: center">GIÁ</th>
																	<th class="col-md-2" style="text-align: center">SỐ LƯỢNG ĐÃ BÁN</th>
																</tr>
															</thead>
															<tbody>
																@php
																$i=1;
																@endphp
																	@foreach ($chitietdonhang as $ctdh)
																	<tr class="row">
																		<td class="col-md-2" style="height: 50px; line-height: 50px;">
																			{{ $i }}
																		</td>
																		<td class="col-md-2" style="height: 50px; line-height: 50px;">
																			{{ $ctdh->sanpham->ten_sp }}
																		</td>
																		<td class="col-md-4" style="height: 50px; line-height: 50px; text-align: center">
																			<img src="{{ $ctdh->sanpham->hinh_sp }}" style="width: 75px; height: 50px">
																		</td>
																		<td class="col-md-2" style="height: 50px; line-height: 50px; text-align: center">
																			{{ number_format($ctdh->sanpham->gia_sp,0,'.','.') }}<sup>VNĐ</sup>
																		</td>
																		<td class="col-md-2" style="height: 50px; line-height: 50px; text-align: center">
																			{{ $ctdh->tongsoluong }}
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
	<script>
		var ctx = document.getElementById('myChart');
        var temp = "{{ $tensanpham }}";
        var tmp = temp.split(", "); //Chuyển chuỗi thành mảng
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: tmp,
				datasets: [{
					label: 'Số lượng đã bán',
					data: {{ $tongsoluong }},
					backgroundColor: '#5F9EA0',
					maxBarThickness: 50,
				}]
			},
			options: {
				title: {
					display: true,
					text: 'Biểu đồ thống kê tổng sản phẩm bán được trong năm {{ date('Y') }}',
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
        $("#formFilterStatisticalProduct").on("submit", function () {
            var ok = true;
            var month = document.getElementById('selectMonth').value;
            if (month == 0) {
                document.getElementById("message").innerHTML = "<i class='fa fa-exclamation-triangle'></i> Vui lòng chọn tháng";
                ok = false;
            } else {
                document.getElementById("message").innerHTML = "";
                event.preventDefault();
                $.ajax({
                    url: "/admin/filter-statistical-product",
                    type: "post",
                    data: $("#formFilterStatisticalProduct").serialize(),
                }).done(function (reponse) {
                    $("#change-StatisticalProduct").html(reponse);
                });
            }
            return ok;
        });
	</script>
	<script>
		$("#locSanPhamTKTheoNgay").on("submit", function () {
            event.preventDefault();
			$.ajax({
				url: "/admin/loc-san-pham-thong-ke-theo-ngay",
				type: "post",
				data: $("#locSanPhamTKTheoNgay").serialize(),
			}).done(function (reponse) {
				$("#change-StatisticalProduct").html(reponse);
			});
        });
	</script>
</body>
</html>