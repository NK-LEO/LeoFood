@if (!empty($sanpham->toArray()))
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
                                <th class="col-md-2">TÊN</th>
                                <th class="col-md-2">GIÁ</th>
                                <th class="col-md-2">SỐ LƯỢNG</th>
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
                                <td class="col-md-2" style="height: 50px; line-height: 50px">
                                    {{ $d->ten_sp }}
                                </td>
                                <td class="col-md-2" style="height: 50px; line-height: 50px">
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
                                <td class="col-md-2" style="height: 50px; line-height: 50px">
                                    {{ $d->soluong_sp }}
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
@else
    <div class="col-md-12" style="text-align: center; background-color: #fafafa;">
        <img src="/public/backend/images/bot2.jpg" style="width: 400px; height: 300px">
        <h5>Không có kết quả</h5>
    </div>
@endif