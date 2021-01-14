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
				<li class="active">Chi tiết đơn hàng</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h3 class="page-header" style="text-align: right">
					<a href="{{ route('admin-don-hang') }}" class="btn btn-info" style="width: 150px"><i class="fa fa-chevron-circle-left"></i> Trở về</a>
				</h3>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default articles">
					<div class="panel-heading">
						<span style="font-size: 17px; font-weight: bold; color: #30a5ff">CHI TIẾT ĐƠN HÀNG</span>
						<span class="pull-right clickable panel-toggle panel-button-tab-left">
							<em class="fa fa-toggle-up"></em>
						</span>
					</div>
					<div class="panel-body articles-container">
						<div class="article">
							<div class="col-xs-12">
								<div class="row">
									<div class="col-md-9">
                                        @foreach ($chitietdonhang as $value)
                                        <div class="col-md-6" style="margin: 0">
                                            <div class="card" style="margin-bottom: 20px;background-color: #EEEEEE; border-radius: 3px">
                                                <div class="row no-gutters">
                                                    <div class="col-md-4" style="padding: 0;">
                                                        <img src="{{ $value->sanpham->hinh_sp }}" class="card-img" style="margin-left: 15px;width: 100%; height: 100px; border-radius: 3px; padding: 0">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body" style="margin-left: 15px">
                                                            <h5 class="card-title">{{ $value->sanpham->ten_sp }}</h5>
                                                            <p class="card-text"><span style="color: black">Số lượng:</span> {{ $value->soluong }}</p>
															<p class="card-text"><span style="color: black">Đơn giá:</span> 
																{{ number_format($value->sanpham->gia_sp,0,'.','.') }}<sup>VNĐ</sup>
																@foreach ($donhang as $dh)	
																@endforeach
																@foreach ($sanphamkhuyenmai as $spkm)
																	@if($value->sanpham->ma_sp == $spkm->ma_sp && date('Y-m-d H:i:s', strtotime($dh->created_at)) >= date('Y-m-d H:i:s', strtotime($spkm->khuyenmai->ngay_bd)) && date('Y-m-d H:i:s', strtotime($dh->created_at)) <= date('Y-m-d H:i:s', strtotime($spkm->khuyenmai->ngay_kt)))
																		@if($spkm->khuyenmai->loai_km == 1)
																			<small><i class="fa fa-arrow-right"></i> </small><span style="color: red; font-weight: bold">{{ number_format($value->sanpham->gia_sp - (($value->sanpham->gia_sp * $spkm->khuyenmai->gia_tri_km) / 100),0,'.','.') }}<sup>VNĐ</sup></span>
																		@else
																			<small><i class="fa fa-arrow-right"></i> </small><span style="color: red; font-weight: bold">{{ number_format($value->sanpham->gia_sp - $spkm->khuyenmai->gia_tri_km,0,'.','.') }}<sup>VNĐ</sup></span>
																		@endif
																	@endif
																@endforeach
															</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										@endforeach
                                    </div>
                                    <div class="col-md-3">
                                        @foreach ($donhang as $item)
                                        <div class="card" style="padding: 10px; background-color: #EEEEEE; border-radius: 3px; height: 400px">
                                            <div class="card-header" style="border-bottom: 1px solid white; padding: 0 0 10px 0;color: black;width:100%">
                                                <table style="width: 100%">
                                                    <tr>
                                                        <td><label>Mã đơn hàng: #{{ $item->ma_dh }}</label></td>
														<td style="text-align: right">
															@if ($item->trang_thai_dh == 0)
																<button class="btn btn-sm btn-danger" style="padding: 1px 5px;"><small>Chờ xác nhận</small></button>
															@elseif($item->trang_thai_dh == 1)
																<button class="btn btn-sm btn-warning" style="padding: 1px 5px;"><small>Đang giao</small></button>
															@else
																<button class="btn btn-sm btn-success" style="padding: 1px 5px;"><small>Đã giao</small></button>
															@endif
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="card-body" style="margin-top:10px;">
												<p><span style="color: black">Khách hàng:</span> <span>{{ $item->ten_nn }}</span></p>
												@if ($item->email_nn != null)
													<p><span style="color: black">Email:</span> <span>{{ $item->email_nn }}</span></p>
												@endif
                                                <p><span style="color: black">SĐT:</span> <span>{{ $item->sdt_nn }}</span></p>
                                                <p><span style="color: black">Địa chỉ giao hàng:</span> <span>{{ $item->diachi_nn }}</span></p>
												<p><span style="color: black">Phí giao hàng:</span> <span>{{ number_format(15000,0,'.','.') }}<sup>VNĐ</sup></span></p>
												<p><span style="color: black">Ngày đặt:</span> <span>{{ $item->created_at }}</span></p>
												@if ($item->trang_thai_tt == 2)
													<p><span style="color: black">Tình trạng:</span> <span style="color: green">Đã thanh toán VNPay</span></p>
												@elseif($item->trang_thai_tt == 1)
													<p><span style="color: black">Tình trạng:</span> <span style="color: green">Đã thanh toán</span></p>
												@else
													<p><span style="color: black">Tình trạng:</span> <span style="color: red">Chưa thanh toán</span></p>
												@endif
                                                <p><span style="color: black">Tổng tiền:</span> <span style="color: red">{{ number_format($item->tongtien,0,'.','.') }}<sup>VNĐ</sup></span></p>
												<a href="{{ route('in-don-hang', $item->ma_dh) }}" target="_blank" class="btn btn-sm btn-warning" style="background-color: #5bc0de; border: 0">In đơn hàng</a>
											</div>
                                        </div>
                                        @endforeach
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
	
</body>
</html>
