<!-- #1 -->
<div class="container mt-3">
    <div class="row pl-1 pr-1">
        <ul class="col-md-12" id="ul-colALL">
            <li id="li-I">
                <form action="" method="post">
                    <span>ĐĂNG KÝ ĐỂ NHẬN TIN MỚI</span>
                    @csrf
                    <input type="email" name="" placeholder="Nhập email của bạn ..." required>
                    <input type="submit" name="" value="THEO DÕI">
                </form>
            </li>
            <li id="li-II">
                <div id="content">
                    <div class="row mb-5">
                        <div class="col-md-3" id="col-footer-I">
                            <img src="public/frontend/images/logo.jpg">
                            <p>Chúng tôi luôn đem đến những sản phẩm tốt nhất và chất lượng nhất. Việc của bạn là hãy tin tưởng và lựa chọn sản phẩm của chúng tôi</p>
                        </div>
                        <div class="col-md-4" id="col-footer-II">
                            <p class="text-LH-TT-LF">LIÊN HỆ</p>
                            <table>
                                <tr>
                                    <td><i class="fas fa-phone-square-alt mr-2"></i></td>
                                    <td>Di động: 0332370223</td>
                                </tr>
                                <tr><td><p></p></td></tr>
                                <tr>
                                    <td><i class="fas fa-envelope-square mr-2"></i></td>
                                    <td>Email: leofood3@gmail.com</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-3" id="col-footer-III">
                            <p class="text-LH-TT-LF">THÔNG TIN</p>
                            <p>HƯỚNG DẪN MUA HÀNG</p>
                            <p>CHÍNH SÁCH VẬN CHUYỂN</p>
                            <p>ĐIỀU KHOẢN DỊCH VỤ</p>
                        </div>
                        <div class="col-md-2" id="col-footer-IV">
                            <p class="text-LH-TT-LF">LEO FOOD</p>
                            <p>TRANG CHỦ</p>
                            <p>TÌM KIẾM SẢN PHẨM</p>
                            <p>THÔNG TIN LIÊN HỆ</p>
                        </div>
                    </div>
                    <div id="copyright">
                        <p>&copy; Bản quyền thuộc về LEO FOOD</p>
                        <p>Cung cấp bởi NK</p>
                        <p><img src="public/frontend/images/payment.jpg"></p>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>

{{-- #2 --}}
@if (session()->has('vaitro') && session('vaitro') == 2)
    <a href="{{ route('admin') }}" id="icon-admin">
        <img src="public/frontend/images/admin.jpg">
        <span class="badge badge-info">Hi! Admin</span>
    </a>
@elseif(session()->has('vaitro') && session('vaitro') == 1)
    <a href="{{ route('admin-slideshow') }}" id="icon-admin">
        <img src="public/frontend/images/admin.jpg">
        <span class="badge badge-info">Hi! Admin</span>
    </a>
@endif