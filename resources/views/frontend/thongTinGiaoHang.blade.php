<div id="change-paypal">
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <base href="{{ asset("") }}">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Thông tin đơn hàng leo-food</title>
        <link rel="shortcut icon" href="/public/frontend/images/title2.jpg">
        <link rel="stylesheet" href="/public/frontend/css/style.css">
        <link rel="stylesheet" href="/public/frontend/css/bootstrap.min.css">
        <link rel="stylesheet" href="/public/frontend/fonts/css/all.css">
        <link rel="stylesheet" href="/public/frontend/css/sweetalert.css">
        <style>
            body {
                background-color: #f5f5f5;
            }
        </style>
    </head>
    <body>
        @include('frontend.header')
        <div class="container mt-3" >
            <div class="row p-1">
                <div class="col-md-12 p-1" style="border-bottom: 1px solid grey; color: #f8694d">
                    <h5>THÔNG TIN & ĐỊA CHỈ GIAO HÀNG</h5>
                </div>
                <div class="col-md-12 mt-4 p-0" style="background-color: white;">
                    <form id="formTTDH" action="{{ route('luu-don-hang') }}" method="POST" onsubmit="return kiemTraDiaChi()" style="padding: 20px;">
                        @csrf
                        @if (isset($thanhvien))
                            @foreach ($thanhvien as $data)  
                            @endforeach
                        @endif 
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <h6>Tên người nhận</h6>
                                <input type="text" class="form-control form-control-sm" name="ten_nn" required @if (isset($data))
                                    value="{{ $data->ten_tv }}"
                                @endif placeholder="Nhập tên người nhận" maxlength="50">
                            </div>
                            <div class="form-group col-md-6">
                                <h6>Số điện thoại</h6>
                                <input type="text" class="form-control form-control-sm" name="sdt_nn" required @if (isset($data))
                                    value="{{ $data->sdt_tv }}"
                                @endif placeholder="Nhập số điện thoại người nhận" maxlength="11">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <h6>Thành phố</h6>
                                <select id="tinhthanhpho" name="tinhthanhpho" class="form-control form-control-sm">
                                    @foreach ($tinhthanhpho as $tp)
                                        <option selected value="{{ $tp->matp }}">{{ $tp->name }}</option>
                                    @endforeach
                                </select>
                                <small id="require-address" style="color: red" class="form-text"></small>
                            </div>
                            <div class="form-group col-md-3">
                                <h6>Quận huyện</h6>
                                <select id="quanhuyen" name="quanhuyen" onchange="return thayDoiQuanHuyen()" class="form-control form-control-sm">
                                    <option value="0">Chọn...</option>
                                    @foreach ($quanhuyen as $qh)
                                        <option value="{{ $qh->maqh }}">{{ $qh->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <h6>Xã phường thị trấn</h6>
                                <select id="xaphuongthitran" name="xaphuongthitran" class="form-control form-control-sm">
                                    <option value="0">Chọn...</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <h6>Địa chỉ</h6>
                                <input name="khuvuc" class="form-control form-control-sm" required placeholder="Số nhà, hẻm, tên đường...">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <h6>Thời gian mong muốn nhận hàng</h6>
                                <select name="thoigiannhanhang" class="form-control form-control-sm">
                                    <option value="30 phút sau">30 phút sau</option>
                                    <option value="1 tiếng sau">1 tiếng sau</option>
                                    <option value="2 tiếng sau">2 tiếng sau</option>
                                    <option value="3 tiếng sau">3 tiếng sau</option>
                                    <option value="4 tiếng sau">4 tiếng sau</option>
                                    <option value="5 tiếng sau">5 tiếng sau</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <h6>Chọn hình thức thanh toán</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="hinhThucTT" value="tructiep" checked>
                                    <label class="form-check-label">
                                        Thanh toán khi nhận được hàng
                                    </label>
                                    <br>
                                    <input class="form-check-input" type="radio" name="hinhThucTT" value="online">
                                    <label class="form-check-label">
                                        Thanh toán online
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <button type="submit" class="btn btn-sm btn-info w-100">THANH TOÁN</button>
                            </div>
                            {{-- <div class="form-group col-md-6">
                                <script
                                    src="https://www.paypal.com/sdk/js?client-id=AfiEBWSdyf79Ka15HeI7pzY6VzlHHf5L1k-vCoywkVy2oewytb8iQW7bDEHxrhBeU2tSsEDKV7Nbzxeq"> // Required. Replace SB_CLIENT_ID with your sandbox client ID.
                                </script>
                                <div id="paypal-button-container"></div>
                                <span>
                                    @php
                                        $totalPaypal = number_format(Cart::subtotal(),0,'.','.') / 23.000;
                                    @endphp
                                </span>
                                <script>
                                    paypal.Buttons({
                                        style: {
                                            layout:  'horizontal',
                                            height: 32
                                        },
                                        createOrder: function(data, actions) {
                                            // This function sets up the details of the transaction, including the amount and line item details.
                                            return actions.order.create({
                                            purchase_units: [{
                                                amount: {
                                                value: {{ number_format($totalPaypal,2,'.','.') }}
                                                }
                                            }]
                                            });
                                        },
                                        onApprove: function(data, actions) {
                                            // This function captures the funds from the transaction.
                                            return actions.order.capture().then(function(details) {
                                                // This function shows a transaction success message to your buyer.
                                                $.ajax({
                                                    url: "/luu-don-hang-paypal",
                                                    type: "post",
                                                    data: $("#formTTDH").serialize(),
                                                }).done(function (reponse) {
                                                    $("#change-paypal").html(reponse);
                                                });
                                                // swal("Thành công!", "Thanh toán thành công!", "success");
                                            });
                                        },
                                        onCancel: function (data) {
                                            // Show a cancel page, or return to cart
                                            swal("Thất bại!", "Thanh toán thất bại!", "warning");
                                        }
                                    }).render('#paypal-button-container');
                                    //This function displays Smart Payment Buttons on your web page.
                                </script>
                            </div> --}}
                        </div>   
                    </form>
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
    </body>
    </html>
</div>