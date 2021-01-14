//Alert thông báo đỏ
$(document).ready(function () {
    $("#danger-alert")
        .fadeTo(3000, 500)
        .slideUp(500, function () {
            $("#danger-alert").slideUp(500);
        });
});

//Alert thông báo xanh
$(document).ready(function () {
    $("#success-alert")
        .fadeTo(4000, 500)
        .slideUp(500, function () {
            $("#success-alert").slideUp(500);
        });
});

//-----------thongTinCaNhan.blade.php
//Hiển thị hình ảnh người dùng muốn cập nhật lên web trước khi submit
function changePicture() {
    var Img = document.getElementById("hinh");
    Img.src = URL.createObjectURL(event.target.files[0]);
}

//Kiểm tra mật khẩu thông tin cá nhân
function kiemTraMatKhau() {
    var ok = true;
    var matkhau = document.getElementById("matkhau").value;
    var matkhaumoi1 = document.getElementById("matkhaumoi1").value;
    var matkhaumoi2 = document.getElementById("matkhaumoi2").value;
    if (matkhaumoi1 != matkhaumoi2) {
        document.getElementById("message").innerHTML =
            "<i class='fa fa-exclamation-triangle'></i> Nhập lại mật khẩu mới chưa khớp";
        document.getElementById("message").style.marginLeft = "3%";
        ok = false;
    }
    if (matkhau == "" || matkhaumoi1 == "" || matkhaumoi2 == "") {
        alert(
            "Thông tin của bạn sẽ được cập nhật \nNhưng mật khẩu sẽ không thay đổi vì bạn nhập thiếu thông tin!"
        );
    }
    return ok;
}

//-----------thongTinDonHang.blade.php
//Click tất cả đơn hàng
function tatCaDonHang() {
    $.ajax({
        url: "/tat-ca-don-hang",
        type: "get",
    }).done(function (reponse) {
        $("#change-donhang").html(reponse);
    });
}

//Click đơn hàng chờ xác nhận
function donHangChoXN() {
    $.ajax({
        url: "/don-hang-cho-xac-nhan",
        type: "get",
    }).done(function (reponse) {
        $("#change-donhang").html(reponse);
    });
}

//Click đơn hàng đang giao
function donHangDangGiao() {
    $.ajax({
        url: "/don-hang-dang-giao",
        type: "get",
    }).done(function (reponse) {
        $("#change-donhang").html(reponse);
    });
}

//Click đơn hàng đã giao
function donHangDaGiao() {
    $.ajax({
        url: "/don-hang-da-giao",
        type: "get",
    }).done(function (reponse) {
        $("#change-donhang").html(reponse);
    });
}

//-----------listProduct.blade.php
//Lọc loại sản phẩm ở danh mục
function locLoaiSP(ma_loaisp) {
    $.ajax({
        url: "/loai-san-pham/" + ma_loaisp,
        type: "get",
    }).done(function (reponse) {
        $("html, body").animate(
            {
                scrollTop: $("#change-sanpham").offset().top,
            },
            1000
        );
        $("#change-sanpham").html(reponse);
    });
}

//Filter sản phẩm
$("#formFilter").on("submit", function () {
    event.preventDefault();
    $.ajax({
        url: "/loc-san-pham",
        type: "post",
        data: $("#formFilter").serialize(),
    }).done(function (reponse) {
        $("#change-locsanpham").html(reponse);
    });
});

//Live serach tên sản phẩm cần tìm (Lỗi: di chuyển đoạn script vào đây không được)
// $("#searchSP").on("keyup", function () {
//     $value = $(this).val();
//     $.ajax({
//         type: "post",
//         url: "/tim-ten-san-pham",
//         data: {
//             _token: "{{ csrf_token() }}",
//             value: $value,
//         },
//         success: function (reponse) {
//             $("#change-tenSP").html(reponse);
//         },
//     });
// });

//-----------productDetail.blade.php
//Bình luận Ajax
$(document).ready(function () {
    $("#binhLuan").click(function (event) {
        event.preventDefault();
        $.ajax({
            url: "/binh-luan",
            type: "post",
            data: $("#form-them-bl").serialize(),
        }).done(function (reponse) {
            $("#noidung_bl").val("");
            $("html, body").animate(
                {
                    scrollTop: $("#location").offset().top,
                },
                1000
            );
            $("#change-binhluan").html(reponse);
        });
    });
});

//Xác nhận xóa bình luận
function XacNhanXoa() {
    var r = confirm("Nhấn OK để xác nhận xóa");
    if (r == true) {
        return true;
    } else {
        return false;
    }
}

//Đánh giá Ajax
$(document).ready(function () {
    $("#danhGia").click(function (event) {
        event.preventDefault();
        $.ajax({
            url: "/danh-gia",
            type: "post",
            data: $("#form-them-dg").serialize(),
        }).done(function (reponse) {
            $("#mySelectStar").val("0");
            $("#change-danhgia").html(reponse);
        });
    });
});

//-----------gioHang.blade.php
//Xóa sản phẩm khỏi giỏ hàng bằng Ajax
function xoaSPGioHang(rowId) {
    $.ajax({
        url: "/xoa-sp-gio-hang/" + rowId,
        type: "get",
    }).done(function (reponse) {
        $("#change-cart").html(reponse);
    });
}

//Cập nhật số lượng sản phẩm trong giỏ hàng Ajax (Lỗi: di chuyển đoạn script vào đây không được)
// function capNhatSLSP(rowId, value) {
//     $.ajax({
//         url: "/cap-nhat-sp-gio-hang",
//         type: "post",
//         data: {
//             _token: "{{ csrf_token() }}",
//             rowId: rowId,
//             soluong: value,
//         },
//     }).done(function (reponse) {
//         $("#change-money").html(reponse);
//     });
// }

//-----------thongTinGiaoHang.blade.php
//Load quận huyện bằng Ajax (Vì chỉ còn một TPCT nên không cần thay đổi thành phố)
// function thayDoiThanhPho() {
//     var matp = document.getElementById("tinhthanhpho").value;
//     $.ajax({
//         url: "/quan-quyen/" + matp,
//         type: "get",
//     }).done(function (reponse) {
//         $("#quanhuyen").html(reponse);
//     });
// }

//Load xã phường thị trấn bằng Ajax
function thayDoiQuanHuyen() {
    var maqh = document.getElementById("quanhuyen").value;
    $.ajax({
        url: "/xa-phuong-thi-tran/" + maqh,
        type: "get",
    }).done(function (reponse) {
        $("#xaphuongthitran").html(reponse);
    });
}

//Kiểm tra thông tin giao hàng đã điền đầy đủ địa chỉ hay chưa
function kiemTraDiaChi() {
    var ok = true;
    // var thanhpho = document.getElementById("tinhthanhpho").value;
    var quanhuyen = document.getElementById("quanhuyen").value;
    var xaphuongthitran = document.getElementById("xaphuongthitran").value;
    if (quanhuyen == 0 || xaphuongthitran == 0) {
        document.getElementById("require-address").innerHTML =
            "<i class='fa fa-exclamation-triangle'></i>Vui lòng chọn đầy đủ địa chỉ";
        document.getElementById("require-address").style.marginLeft = "3%";
        ok = false;
    }
    return ok;
}
