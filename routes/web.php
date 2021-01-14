<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\PaypalController;


//Frontend
// Route::get('/', [FrontendController::class, 'getWelcome'])->name('welcome');
Route::get('/', [FrontendController::class, 'getListProduct'])->name('trang-chu');
Route::get('/gioi-thieu', [FrontendController::class, 'gioiThieu'])->name('gioi-thieu');
Route::get('/lien-he', [FrontendController::class, 'lienHe'])->name('lien-he');
Route::get('/dang-nhap', [FrontendController::class, 'dangNhap'])->name('dang-nhap');
Route::get('/dang-ky', [FrontendController::class, 'dangKy'])->name('dang-ky');
Route::get('/dang-xuat', [FrontendController::class, 'dangXuat'])->name('dang-xuat');
Route::get('/loai-san-pham/{ma_loaisp}', [FrontendController::class, 'locLoaiSanPham'])->name('loc-loai-san-pham');
Route::post('/loc-san-pham', [FrontendController::class, 'locSanPham'])->name('loc-san-pham');
Route::get('/chi-tiet-san-pham/{ma_sp}', [FrontendController::class, 'chiTietSanPham'])->name('chi-tiet-san-pham');
Route::post('/tim-ten-san-pham', [FrontendController::class, 'timTenSanPham'])->name('tim-ten-san-pham');
Route::post('/tim-kiem-san-pham', [FrontendController::class, 'timKiemSanPham'])->name('tim-kiem-san-pham');
Route::post('/dang-nhap-tai-khoan', [FrontendController::class, 'dangNhapTaiKhoan'])->name('dang-nhap-tai-khoan');
Route::post('/dang-ky-tai-khoan', [FrontendController::class, 'dangKyTaiKhoan'])->name('dang-ky-tai-khoan');

Route::get('/lay-lai-mat-khau', [FrontendController::class, 'layLaiMatKhau'])->name('lay-lai-mat-khau');
Route::post('/chuoi-bi-mat', [FrontendController::class, 'guiChuoiBiMat'])->name('chuoi-bi-mat');
Route::get('/dat-lai-mat-khau', [FrontendController::class, 'datLaiMatKhau'])->name('dat-lai-mat-khau');
Route::post('/luu-mat-khau', [FrontendController::class, 'luuMatKhau'])->name('luu-mat-khau');

Route::get('/thong-tin-ca-nhan', [FrontendController::class, 'getThongTinCN'])->name('thong-tin-cn');
Route::post('/cap-nhat-thong-tin-ca-nhan', [FrontendController::class, 'capNhatTTCN'])->name('cap-nhat-ttcn');

Route::get('/gio-hang', [FrontendController::class, 'getGioHang'])->name('gio-hang');
Route::post('/them-sp-gio-hang', [FrontendController::class, 'themSPGioHang'])->name('them-sp-gio-hang');
Route::get('/xoa-sp-gio-hang/{rowId}', [FrontendController::class, 'xoaSPGioHang'])->name('xoa-sp-gio-hang');
Route::post('/cap-nhat-sp-gio-hang', [FrontendController::class, 'capNhatSPGioHang'])->name('cap-nhat-sp-gio-hang');
Route::post('/giam-gia-don-hang', [FrontendController::class, 'giamGia'])->name('giam-gia-don-hang');

Route::get('/thong-tin-giao-hang', [FrontendController::class, 'thongTinGiaoHang'])->name('thong-tin-gh');
Route::post('/luu-don-hang', [FrontendController::class, 'luuDonHang'])->name('luu-don-hang');
Route::get('/dat-hang-thanh-cong', [FrontendController::class, 'getChucMung'])->name('chuc-mung');
Route::get('/don-hang-cua-ban', [FrontendController::class, 'donHangCuaBan'])->name('dh-cua-ban');
Route::get('/xoa-don-hang-da-giao/{ma_dh}', [FrontendController::class, 'xoaDonHangDaGiao'])->name('xoa-dh-dg');

Route::get('/tat-ca-don-hang', [FrontendController::class, 'tatCaDonHang'])->name('tat-ca-dh');
Route::get('/don-hang-cho-xac-nhan', [FrontendController::class, 'donHangChoXN'])->name('cho-xac-nhan-dh');
Route::get('/don-hang-dang-giao', [FrontendController::class, 'donHangDangGiao'])->name('dang-giao-dh');
Route::get('/don-hang-da-giao', [FrontendController::class, 'donHangDaGiao'])->name('da-giao-dh');


// Route::get('/quan-quyen/{matp}', [FrontendController::class, 'getQuanHuyen'])->name('lay-quan-huyen');
Route::get('/xa-phuong-thi-tran/{maqh}', [FrontendController::class, 'getXaPhuongThiTran'])->name('lay-xa-phuong-thi-tran');

Route::post('/binh-luan', [FrontendController::class, 'binhLuan'])->name('binh-luan');
Route::post('/phan-hoi', [FrontendController::class, 'phanHoi'])->name('phan-hoi');
Route::post('/danh-gia', [FrontendController::class, 'danhGia'])->name('danh-gia');


//Backend
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [BackendController::class, 'getIndex'])->name('admin');

    Route::post('/thay-doi-vai-tro', [BackendController::class, 'thayDoiVaiTro'])->name('thay-doi-vai-tro');
    Route::post('/thay-doi-trang-thai-tk', [BackendController::class, 'thayDoiTrangThaiTK'])->name('thay-doi-trang-thai');
    Route::post('/filter-revenue', [BackendController::class, 'filterRevenue'])->name('admin-filter-revenue');
    Route::post('/loc-doanh-thu-theo-ngay', [BackendController::class, 'locDoanhThuTheoNgay'])->name('admin-loc-doanh-thu-theo-ngay');

    Route::get('/slideshow', [BackendController::class, 'getSlideshow'])->name('admin-slideshow');
    Route::post('/them-slideshow', [BackendController::class, 'themSlideshow'])->name('admin-them-slideshow');
    Route::post('/cap-nhat-slideshow', [BackendController::class, 'suaSlideshow'])->name('admin-sua-slideshow');
    Route::post('/xoa-slideshow', [BackendController::class, 'xoaSlideshow'])->name('admin-xoa-slideshow');

    Route::post('/them-chuong-trinh-km', [BackendController::class, 'themCTKM'])->name('admin-them-chuong-trinh-km');
    Route::post('/sua-chuong-trinh-km', [BackendController::class, 'suaCTKM'])->name('admin-sua-chuong-trinh-km');
    Route::get('/xoa-chuong-trinh-km/{ma_km}', [BackendController::class, 'xoaCTKM'])->name('admin-xoa-chuong-trinh-km');

    // Route::get('/product-type', [BackendController::class, 'getProductType'])->name('admin-product-type');
    Route::post('/them-loai-san-pham', [BackendController::class, 'themLoaiSP'])->name('admin-them-loaisp');
    Route::post('/sua-loai-san-pham', [BackendController::class, 'suaLoaiSP'])->name('admin-sua-loaisp');
    Route::post('/xoa-loai-san-pham', [BackendController::class, 'xoaLoaiSP'])->name('admin-xoa-loaisp');

    Route::post('/them-thanh-phan-dinh-duong', [BackendController::class, 'themTPDD'])->name('admin-them-tpdd');
    Route::post('/sua-thanh-phan-dinh-duong', [BackendController::class, 'suaTPDD'])->name('admin-sua-tpdd');
    Route::post('/xoa-thanh-phan-dinh-duong', [BackendController::class, 'xoaTPDD'])->name('admin-xoa-tpdd');

    Route::get('/product', [BackendController::class, 'getProduct'])->name('admin-product');
    Route::post('/them-san-pham', [BackendController::class, 'themSP'])->name('admin-them-sp');
    Route::post('/sua-sua-pham', [BackendController::class, 'suaSP'])->name('admin-sua-sp');
    Route::post('/xoa-san-pham', [BackendController::class, 'xoaSP'])->name('admin-xoa-sp');
    Route::post('/tim-san-pham', [BackendController::class, 'timSP'])->name('admin-tim-sp');
    Route::post('/import-san-pham', [BackendController::class, 'importSP'])->name('admin-import-sp');
    Route::post('/export-san-pham', [BackendController::class, 'exportSP'])->name('admin-export-sp');

    Route::get('/statistical-product', [BackendController::class, 'getStatisticalProduct'])->name('admin-statistical-product');
    Route::post('/filter-statistical-product', [BackendController::class, 'filterStatisticalProduct'])->name('admin-filter-statistical-product');
    Route::post('/loc-san-pham-thong-ke-theo-ngay', [BackendController::class, 'locSanPhamTKTheoNgay'])->name('admin-loc-san-pham-thong-ke-theo-ngay');

    Route::get('/warehouse-product', [BackendController::class, 'getWarehouseProduct'])->name('admin-warehouse-product');
    Route::post('/insert-warehouse-product', [BackendController::class, 'insertWarehouseProduct'])->name('admin-insert-warehouse-product');
    Route::post('/edit-warehouse-product', [BackendController::class, 'editWarehouseProduct'])->name('admin-edit-warehouse-product');
    Route::post('/edit-warehouse-product-broken', [BackendController::class, 'editWarehouseProductBroken'])->name('admin-edit-warehouse-product-broken');
    Route::post('/tim-san-pham-kho', [BackendController::class, 'timSPKho'])->name('admin-tim-san-pham-kho');
    
    Route::get('/don-hang', [BackendController::class, 'getDonHang'])->name('admin-don-hang');
    Route::get('/xem-chi-tiet-don-hang/{ma_dh}', [BackendController::class, 'getChiTietDonHang'])->name('admin-chi-tiet-don-hang');
    Route::post('/giao-hang', [BackendController::class, 'giaoHang'])->name('admin-giao-hang');
    Route::get('/in-don-hang/{ma_dh}', [BackendController::class, 'inDonHang'])->name('in-don-hang');
    Route::post('/filter-order', [BackendController::class, 'filterOrder'])->name('loc-don-hang');
    Route::post('/loc-don-hang-theo-ngay', [BackendController::class, 'locDonHangTheoNgay'])->name('loc-don-hang-theo-ngay');

    Route::post('/thay-doi-trang-thai-bl', [BackendController::class, 'thayDoiTrangThaiBL'])->name('admin-doi-trang-thai-bl');
    Route::get('/xoa-bl/{ma_bl}', [BackendController::class, 'xoaBL'])->name('admin-xoa-binh-luan');
});
