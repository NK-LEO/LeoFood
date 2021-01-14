<div class="row">
    <div class="col-md-2">
        <i class="fas fa-star" style="position: relative;font-size: 100px; color: #ffcc00;"></i>
        <b style="position: absolute; left: 27%; top: 27%; color: white; font-size: 30px">{{ number_format($sosao,1,'.','.') }}</b>
    </div>
    <div class="col-md-10" style="padding: 0">
        @if ($danhgia != null)
            @foreach ($danhgia as $key => $item)
                @php
                    $phantram = ($item['luot_danh_gia']/$tongsoluotdanhgia)*100;
                @endphp
                <div class="row">
                    <div class="col-md-1" >
                        {{ $key }} <i class="fas fa-star" style="color: #ccc"></i>
                    </div>
                    <div class="col-md-9 pt-1">
                        <div class="progress">
                            <div class="progress-bar bg-warning" style="width: {{ $phantram }}%" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="col-md-2" >
                        <small>{{ $item['luot_danh_gia'] }} đánh giá</small>
                    </div>
                </div>
            @endforeach
        @else
            @for($i = 1; $i <= 5; $i++)
                <div class="row">
                    <div class="col-md-1" >
                        {{ $i }} <i class="fas fa-star" style="color: #ccc"></i>
                    </div>
                    <div class="col-md-9 pt-1">
                        <div class="progress">
                            <div class="progress-bar bg-warning" style="width: 0%" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="col-md-2" >
                        <small>0 đánh giá</small>
                    </div>
                </div>
            @endfor
        @endif
    </div>
</div>
<hr>
@foreach ($nguoidanhgia as $d)
    <div style="margin-bottom: 10px;">
        <small>
            <b>{{ $d->thanhvien->ten_tv }}</b> 
            <span style="color: green"><i class="far fa-check-circle"></i> Đã mua hàng</span>
        </small><br>
        <small style="font-size: 10px">
            <ul style="margin-bottom: 0;">
                @for($i=1; $i<=5; $i++)
                    @php
                        if($i <= $d->so_sao){
                            $color = 'color: #ffcc00';
                        }
                        else{
                            $color = 'color: #ccc';
                        }
                    @endphp
                    <li style="display: inline; {{ $color }};">
                        <i class="fas fa-star"></i>
                    </li>
                @endfor
            </ul>
        </small>
        <small style="color: grey"><i class="far fa-clock" style="font-size: 12px"></i> {{ $d->created_at }}</small>
    </div>
@endforeach
<hr>