@foreach ($binhluan as $bl)
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
                    </div>
                    {{ $ph->noidung_ph }}
                </div>
            </div>
        @endif
    @endforeach
@endforeach