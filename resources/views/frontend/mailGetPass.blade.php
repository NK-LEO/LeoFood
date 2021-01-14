<span>
    Chuỗi bí mật của bạn là:
    @foreach ($doimatkhau as $dmk)
        <b>{{ $dmk->chuoi_bi_mat }}</b>
    @endforeach
</span>