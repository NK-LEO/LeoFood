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
            <p style="margin-top: 10px">Không tìm thấy đơn hàng!</p>
        </div>
    @endif
</div>