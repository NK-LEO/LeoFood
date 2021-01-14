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
                            <th class="col-md-1">STT</th>
                            <th class="col-md-2">TÊN SẢN PHẨM</th>
                            <th class="col-md-2" style="text-align: center">HÌNH ẢNH</th>
                            <th class="col-md-2" style="text-align: center">TỔNG NHẬP</th>
                            <th class="col-md-2" style="text-align: center">BỊ HỎNG</th>
                            <th class="col-md-2" style="text-align: center">CÒN LẠI</th>
                            <th class="col-md-1" style="text-align: center">LỰA CHỌN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i=1;
                        @endphp
                            @foreach ($sanpham as $sp)
                            <tr class="row">
                                <td class="col-md-1" style="height: 50px; line-height: 50px;">
                                    {{ $i }}
                                </td>
                                <td class="col-md-2" style="height: 50px; line-height: 50px;">
                                    {{ $sp->ten_sp }}
                                </td>
                                <td class="col-md-2" style="height: 50px; line-height: 50px; text-align: center">
                                    <img src="{{ $sp->hinh_sp }}" style="width: 75px; height: 50px">
                                </td>
                                <td class="col-md-2" style="height: 50px; line-height: 50px; text-align: center">
                                    @foreach ($ngaynhapsanpham2 as $spnhap2)
                                        @if ($spnhap2->ma_sp == $sp->ma_sp)
                                            {{ $spnhap2->tongsoluongnhap }}
                                        @endif
                                    @endforeach
                                </td>
                                <td class="col-md-2" style="height: 50px; line-height: 50px; text-align: center">
                                    @foreach ($ngaynhapsanpham2 as $spnhap2)
                                        @if ($spnhap2->ma_sp == $sp->ma_sp)
                                            {{ $spnhap2->tongsoluonghong }}
                                        @endif
                                    @endforeach
                                </td>
                                <td class="col-md-2" style="height: 50px; line-height: 50px; text-align: center">
                                    {{ $sp->soluong_sp }}
                                </td>
                                <td class="col-md-1" style="height: 50px; line-height: 50px; text-align: center">
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