@foreach ($binhluan as $bl)
    @if (session()->has('vaitro') && session('vaitro')!=0)
        <div class="media mb-4">
            <img src="{{ $bl->thanhvien->hinh_tv }}" class="mr-3" style="width: 64px; height: 64px; border-radius: 50%">
            <div class="media-body">
                <div style="background-color: #e9ecef; padding: 10px; border-radius: 5px">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="mt-0">{{ $bl->thanhvien->ten_tv }}</h5>
                        </div>
                        <div class="col-md-6" style="text-align: right">
                            <small><i class="far fa-clock" style="font-size: 12px"></i> {{ $bl->created_at }}</small>
                        </div>
                        <div class="col-md-10">
                            {{ $bl->noidung_bl }}
                        </div>
                        <div class="col-md-2" style="text-align: right">
                            @php
                                if($bl->trang_thai_bl == 0){
                                    $bg = "background-color: #8ad919";
                                }else {
                                    $bg = "background-color: #f0ad4e";
                                }
                            @endphp
                            <select class="trangThaiBL" id="trangThaiBL{{ $bl->ma_bl }}" onchange="return changeBackgroundBL({{ $bl->ma_bl }}, this.value)" style="cursor: pointer; border-radius: 3px; border: none; outline: none; {{ $bg }}">
                                @if ($bl->trang_thai_bl == 0)
                                    <option value="0" selected>Hiện</option>
                                    <option value="1">Ẩn</option>
                                @else
                                    <option value="0">Hiện</option>
                                    <option value="1" selected>Ẩn</option>
                                @endif
                            </select>
                            <a onclick="return XacNhanXoa()" href="{{ route('admin-xoa-binh-luan', $bl->ma_bl) }}" id="xoabl" style="color: white; padding: 0 5px; border-radius: 3px; background-color: #dc3545">Xóa</a>
                        </div>
                    </div>
                </div>
                @foreach ($phanhoi as $ph)
                    @if ($bl->ma_bl == $ph->ma_bl)
                        <div class="media mt-3">
                            <img src="{{ $ph->thanhvien->hinh_tv }}" class="mr-3" style="width: 64px; height: 64px; border-radius: 50%">
                            <div class="media-body" style="background-color: #e9ecef; padding: 10px; border-radius: 5px">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="mt-0">{{ $ph->thanhvien->ten_tv }}</h5>
                                    </div>
                                    <div class="col-md-6" style="text-align: right">
                                        <small><i class="far fa-clock" style="font-size: 12px"></i> {{ $ph->created_at }}</small>
                                    </div>
                                    <div class="col-md-12">
                                        {{ $ph->noidung_ph }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                <form action="{{ route('phan-hoi') }}" method="POST" style="margin-top: 10px;">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="ma_tv" value="{{ session('ma_tv') }}">
                        <input type="hidden" name="ma_bl" value="{{ $bl->ma_bl }}">
                        <input class="form-control" name="noidung_ph" required placeholder="Viết phản hồi...">
                    </div>
                </form>
            </div>
        </div>
    @else
        @if($bl->trang_thai_bl == 0)
            <div class="media mb-4">
                <img src="{{ $bl->thanhvien->hinh_tv }}" class="mr-3" style="width: 64px; height: 64px; border-radius: 50%">
                <div class="media-body">
                    <div style="background-color: #e9ecef; padding: 10px; border-radius: 5px">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="mt-0">{{ $bl->thanhvien->ten_tv }}</h5>
                            </div>
                            <div class="col-md-6" style="text-align: right">
                                <small><i class="far fa-clock" style="font-size: 12px"></i> {{ $bl->created_at }}</small>
                            </div>
                            <div class="col-md-12">
                                {{ $bl->noidung_bl }}
                            </div>
                        </div>
                    </div>
                    @foreach ($phanhoi as $ph)
                        @if ($bl->ma_bl == $ph->ma_bl)
                            <div class="media mt-3">
                                <img src="{{ $ph->thanhvien->hinh_tv }}" class="mr-3" style="width: 64px; height: 64px; border-radius: 50%">
                                <div class="media-body" style="background-color: #e9ecef; padding: 10px; border-radius: 5px">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5 class="mt-0">{{ $ph->thanhvien->ten_tv }}</h5>
                                        </div>
                                        <div class="col-md-6" style="text-align: right">
                                            <small><i class="far fa-clock" style="font-size: 12px"></i> {{ $ph->created_at }}</small>
                                        </div>
                                        <div class="col-md-12">
                                            {{ $ph->noidung_ph }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    <form action="{{ route('phan-hoi') }}" method="POST" style="margin-top: 10px;">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="ma_tv" value="{{ session('ma_tv') }}">
                            <input type="hidden" name="ma_bl" value="{{ $bl->ma_bl }}">
                            <input class="form-control" name="noidung_ph" required placeholder="Viết phản hồi...">
                        </div>
                    </form>
                </div>
            </div>
        @endif
    @endif
@endforeach