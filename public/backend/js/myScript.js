//Làm việc với sản phẩm

//Thêm sản phẩm
function kiemTra() {
    //Kiểm tra xem đã chọn loại sản phẩm để thêm chưa
    var ok = true;
    var ma_loaisp = document.forms["formThemSP"]["ma_loaisp"].value;
    if (ma_loaisp == 0) {
        document.getElementById("require").innerHTML =
            "<i class='fa fa-exclamation-triangle'></i>Vui lòng chọn loại cho sản phẩm";
        document.getElementById("require").style.marginLeft = "3%";
        ok = false;
    }
    return ok;
}

function hopLe() {
    //Đã chọn loại sản phẩm để thêm rồi
    document.getElementById("require").innerHTML = "";
    document.getElementById("require").style.marginLeft = "0%";
}

function XacNhanXoa() {
    var r = confirm("Nhấn OK để xóa");
    if (r == true) {
        return true;
    } else {
        return false;
    }
}
