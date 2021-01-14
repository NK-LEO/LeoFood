<p>
    <span class="payment">Tạm tính:</span>
    <span class="payment price">
        @php
            echo number_format(Cart::subtotal(),0,'.','.')."<sup>VNĐ</sup>";
        @endphp
    </span>
</p>
<hr>
<p>
    <span class="payment">Phí giao hàng:</span>
    <span class="payment price">{{ number_format(15000,0,'.','.') }}<sup>VNĐ</sup></span>
</p>
<hr>
<p>
    <span class="payment">Tổng cộng:</span>
    <span class="payment price-all">
        @if (session()->has('giamgia'))
            @php
                $x = Cart::subtotal()+15000;
                $t = $x - $x*0.05;
                echo number_format($t,0,'.','.')."<sup>VNĐ</sup>";
            @endphp
        @else
            @php
                echo number_format(Cart::subtotal()+15000,0,'.','.')."<sup>VNĐ</sup>";
            @endphp
        @endif
    </span>
</p>
@if (session()->has('giamgia'))
    <small style="color: green"><i class="fas fa-check-circle"></i> Bạn đã được giảm 5% vào đơn hàng</small>
@endif