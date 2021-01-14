<?php

namespace App\Http\Controllers;

use App\Models\chitietdonhang;
use Illuminate\Http\Request;
use App\Models\slideshow;
use App\Models\loaisanpham;
use App\Models\thanhphandinhduong;
use App\Models\sanpham;
use App\Models\chitiettpdd;
use App\Models\thanhvien;
use App\Models\donhang;
use App\Models\binhluan;
use App\Models\phanhoi;
use App\Models\khuyenmai;
use App\Models\sanphamkhuyenmai;
use App\Models\ngaynhapsanpham;
use DB;
use PDF;
use App\Exports\ExcelExport;
use App\Imports\ExcelImport;
use Excel;
use Carbon\Carbon;

class BackendController extends Controller
{
    public function getIndex()
    {
        if(session()->has('vaitro') && session('vaitro') == 2){
            // $data = donhang::where('trang_thai_tt', '!=', 0)->whereYear('created_at', date('Y'))->select([
            //     DB::raw('month(created_at) as date'),
            //     DB::raw('tongtien as price')
            // ])->get()->toArray();

            $data = donhang::where('trang_thai_tt', '!=', 0)->whereYear('created_at', date('Y'))
            ->select(DB::raw('month(created_at) as date'), DB::raw('sum(tongtien) as total'))->groupBy('date')->pluck('total', 'date')->all();
            $tongtien = array_values($data);
            $thang = array_keys($data);
            // dd($thang);

            $data1 = donhang::where('trang_thai_tt', '!=', 0)->select(DB::raw('year(created_at) as getYear'))->groupBy('getYear')->get();
            $data2 = donhang::where('trang_thai_tt', '!=', 0)->whereYear('created_at', date('Y'))->sum('tongtien');

            $soluongdonhang = donhang::count();
            $comment = binhluan::count() + phanhoi::count();
            $user = thanhvien::count();
            $thanhvien = thanhvien::orderBy('vaitro', 'desc')->get();

            return view('backend.index')->with([
                'thang' => $thang,
                'tongtien' => $tongtien,
                'tongdoanhthu' => $data2,
                'soluongdonhang' => $soluongdonhang,
                'comment' => $comment,
                'user' => $user,
                'thanhvien' => $thanhvien,
                'year' => $data1
            ]);
        }
        else return redirect()->back();
    }
    public function filterRevenue(Request $request){
        $nam = $request->selectYear;
        $data = donhang::where('trang_thai_tt', '!=', 0)->whereYear('created_at', $request->selectYear)
            ->select(DB::raw('month(created_at) as date'), DB::raw('sum(tongtien) as total'))->groupBy('date')->pluck('total', 'date')->all();
        $tongtien = array_values($data);
        $thang = array_keys($data);

        $data2 = donhang::where('trang_thai_tt', '!=', 0)->whereYear('created_at', $request->selectYear)->sum('tongtien');
        return view('backend.module.locDoanhThuNam')->with([
            'nam' => $nam,
            'thang' => $thang,
            'tongtien' => $tongtien,
            'tongdoanhthu' => $data2,
        ]);
    }
    public function locDoanhThuTheoNgay(Request $request){
        $data = donhang::where('trang_thai_tt', '!=', 0)->where('created_at', '>', $request->ngay_tu)->where('created_at', '<', $request->ngay_den)
            ->select(DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"), DB::raw('sum(tongtien) as total'))->groupby('new_date')->get();
        
        $i=0;
        $arrDate=[];
        $arrMoney=[];
        foreach($data as $value){
            $arrDate[$i] = $value->new_date;
            $arrMoney[$i] = $value->total;
            $i++;
        }
        $thangnam = implode(", ", $arrDate);
        $tongtien = "[".implode(", ", $arrMoney)."]";

        $data2 = donhang::where('trang_thai_tt', '!=', 0)->where('created_at', '>', $request->ngay_tu)->where('created_at', '<', $request->ngay_den)->sum('tongtien');
        return view('backend.module.locDoanhThuTheoNgay')->with([
            'thangnam' => $thangnam,
            'tongtien' => $tongtien,
            'tongdoanhthu' => $data2,
            'ngaytu' => $request->ngay_tu,
            'ngayden' => $request->ngay_den
        ]);
    }

    //Tài khoản thành viên
    public function thayDoiVaiTro(Request $request){
        if($request->ma_tv != 3){
            $data = thanhvien::find($request->ma_tv);
            $data->vaitro = $request->vaitro;
            $data->save();
            return redirect()->back();
        }else{
            echo "Không thể thay đổi quyền của tài khoản cao nhất này";
        }
    }

    public function thayDoiTrangThaiTK(Request $request){
        $data = thanhvien::find($request->ma_tv);
        if($data->vaitro == 2){
            echo "Không thể khóa tài khoản của chủ cửa hàng";
        }
        else{
            $data->trangthai = $request->trangthai;
        }
        $data->save();
        return redirect()->back();
    }

    //Slideshow
    public function getSlideshow()
    {
        if(session()->has('vaitro') && session('vaitro')!=0){
            $data = slideshow::all();
            $data1 = loaisanpham::all();
            $data2 = khuyenmai::all();
            $data3 = sanphamkhuyenmai::all();
            return view('backend.slideshow')->with([
                'slideshow' => $data,
                'loaisanpham' => $data1,
                'khuyenmai' => $data2,
                'sanphamkhuyenmai' => $data3
            ]);
        }
        else return redirect()->back();
    }
    public function themSlideshow(Request $request)
    {
        $data = new slideshow;
        // Lấy tên file
        $file_name = $request->hinh_slides->getClientOriginalName();
        // Lưu file vào thư mục public/frontend/images/ với tên là biến $filename
        $request->hinh_slides->move('public/frontend/images/', $file_name);
        $data->hinh_slides = 'public/frontend/images/' . $file_name;
        $data->save();
        return redirect()->back();
    }
    public function suaSlideshow(Request $request)
    {
        $data = slideshow::find($request->ma_slides);
        $file_name = $request->hinh_slides->getClientOriginalName();
        $request->hinh_slides->move('public/frontend/images/', $file_name);
        $data->hinh_slides = 'public/frontend/images/' . $file_name;
        $data->save();
        return redirect()->back();
    }
    public function xoaSlideshow(Request $request)
    {
        slideshow::find($request->ma_slides)->delete();
        return redirect()->back();
    }

    //Chương trình khuyến mãi
    public function themCTKM(Request $request){
        if(session()->has('vaitro') && session('vaitro')!=0){
            $data = new khuyenmai;
            $data->ten_km = $request->ten_km;
            $data->ngay_bd = $request->ngay_bd;
            $data->ngay_kt = $request->ngay_kt;
            $data->noi_dung_km = $request->noi_dung_km;
            $data->loai_km = $request->loai_km;
            $data->gia_tri_km = $request->gia_tri_km;
            $data->ma_loaisp = $request->nhom_sp;
            $check = $data->save();
            if($check){
                $thongtinkhuyenmai = khuyenmai::orderBy('ma_km', 'desc')->limit(1)->get();
                $data2 = sanpham::where('ma_loaisp', $request->nhom_sp)->get();
                foreach($thongtinkhuyenmai as $ttkm){
                    foreach($data2 as $sp){
                        $sanphamkhuyenmai = new sanphamkhuyenmai;
                        $sanphamkhuyenmai->ma_km = $ttkm->ma_km;
                        $sanphamkhuyenmai->ma_sp = $sp->ma_sp;
                        $sanphamkhuyenmai->save();
                    }
                }
            }
            return redirect()->back();
        }
        else return redirect()->back();
    }

    public function suaCTKM(Request $request){
        if(session()->has('vaitro') && session('vaitro')!=0){
            $data = khuyenmai::find($request->ma_km);
            $data->ten_km = $request->ten_km;
            $data->ngay_bd = $request->ngay_bd;
            $data->ngay_kt = $request->ngay_kt;
            $data->noi_dung_km = $request->noi_dung_km;
            $data->loai_km = $request->loai_km;
            $data->gia_tri_km = $request->gia_tri_km;
            $data->ma_loaisp = $request->nhom_sp;
            $data->save();
            sanphamkhuyenmai::where('ma_km', $request->ma_km)->delete();
            $data2 = sanpham::where('ma_loaisp', $request->nhom_sp)->get();
            foreach($data2 as $sp){
                $sanphamkhuyenmai = new sanphamkhuyenmai;
                $sanphamkhuyenmai->ma_km = $request->ma_km;
                $sanphamkhuyenmai->ma_sp = $sp->ma_sp;
                $sanphamkhuyenmai->save();
            }
            return redirect()->back();
        }
        else return redirect()->back(); 
    }

    public function xoaCTKM($ma_km){
        khuyenmai::find($ma_km)->delete();
        return redirect()->back();
    }

    //ProductType
    public function themLoaiSP(Request $request)
    {
        $temp = loaisanpham::where('ten_loaisp', mb_strtoupper($request->ten_loaisp))->count();
        if($temp >= 1){
            return redirect()->back()->with('thatbai', 'Tên loại sản phẩm đã tồn tại');
        }
        else{
            $data = new loaisanpham;
            $data->ten_loaisp = mb_strtoupper($request->ten_loaisp);
            $data->save();
            return redirect()->back();
        }
    }
    public function suaLoaiSP(Request $request)
    {
        $data = loaisanpham::find($request->ma_loaisp);
        $data->ten_loaisp = mb_strtoupper($request->ten_loaisp);
        $data->save();
        return redirect()->back();
    }
    public function xoaLoaiSP(Request $request)
    {
        loaisanpham::find($request->ma_loaisp)->delete();
        return redirect()->back();
    }

    //TPDD
    public function themTPDD(Request $request)
    {
        $temp = thanhphandinhduong::where('ten_tpdd', mb_strtoupper($request->ten_tpdd))->count();
        if($temp >= 1){
            return redirect()->back()->with('thatbai', 'Tên thành phần dinh dưỡng đã tồn tại');
        }
        else{
            $data = new thanhphandinhduong;
            $data->ten_tpdd = mb_strtoupper($request->ten_tpdd);
            $data->save();
            return redirect()->back();
        }
    }
    public function suaTPDD(Request $request)
    {
        $data = thanhphandinhduong::find($request->ma_tpdd);
        $data->ten_tpdd = mb_strtoupper($request->ten_tpdd);
        $data->save();
        return redirect()->back();
    }
    public function xoaTPDD(Request $request)
    {
        thanhphandinhduong::find($request->ma_tpdd)->delete();
        return redirect()->back();
    }

    //Product
    public function getProduct()
    {
        if(session()->has('vaitro') && session('vaitro')!=0){
            $data = loaisanpham::all();
            $data1 = thanhphandinhduong::all();
            $data2 = chitiettpdd::all();
            $data3 = sanpham::orderBy('created_at', 'desc')->paginate(10);
            $data4 = sanphamkhuyenmai::all();
            $data5 = sanpham::all();
            return view('backend.product')->with([
                'loaisanpham' => $data,
                'thanhphandinhduong' => $data1,
                'chitiettpdd' => $data2,
                'sanpham' => $data3,
                'sanphamkhuyenmai' => $data4,
                'sanphamkhongphantrang' => $data5
            ]);
        }
        else return redirect()->back();
    }
    public function themSP(Request $request)
    {
        $temp = sanpham::where('ten_sp', $request->ten_sp)->count();
        if($temp >= 1){
            return redirect()->back()->with('thatbai', 'Tên sản phẩm đã tồn tại');
        }
        else{
            $thanhphandinhduong = thanhphandinhduong::all();
            $data = new sanpham;
            $data->ten_sp = $request->ten_sp;
            $file_name = $request->hinh_sp->getClientOriginalName();
            $request->hinh_sp->move('public/frontend/images/', $file_name);
            $data->hinh_sp = 'public/frontend/images/' . $file_name;
            $data->chitiet_sp = $request->chitiet_sp;
            $data->gia_sp = $request->gia_sp;
            // $data->soluong_sp = $request->soluong_sp;
            $data->ma_loaisp = $request->ma_loaisp;
            $data->save();
            $dulieusanpham = sanpham::orderBy('ma_sp', 'desc')->limit(1)->get();
            foreach ($dulieusanpham as $dlsp) {
            }
            foreach ($thanhphandinhduong as $tpdd) {
                $temp = $tpdd->ma_tpdd;
                if ($request->$temp != "") {
                    $chitiettpdd = new chitiettpdd;
                    $chitiettpdd->ma_sp = $dlsp->ma_sp;
                    $chitiettpdd->ma_tpdd = $tpdd->ma_tpdd;
                    $chitiettpdd->gia_tri = $request->$temp;
                    $chitiettpdd->save();
                }
            }
            return redirect()->back();
        }
    }
    public function suaSP(Request $request)
    {
        $data = sanpham::find($request->ma_sp);
        $data->ten_sp = $request->ten_sp;
        if ($request->hinh_sp != "") {
            $file_name = $request->hinh_sp->getClientOriginalName();
            $request->hinh_sp->move('public/frontend/images/', $file_name);
            $data->hinh_sp = 'public/frontend/images/' . $file_name;
        }
        $data->chitiet_sp = $request->chitiet_sp;
        $data->gia_sp = $request->gia_sp;
        // $data->soluong_sp = $request->soluong_sp;
        $data->ma_loaisp = $request->ma_loaisp;
        $data->save();
        chitiettpdd::where('ma_sp', $request->ma_sp)->delete();
        $thanhphandinhduong = thanhphandinhduong::all();
        foreach ($thanhphandinhduong as $tpdd) {
            $temp = $tpdd->ma_tpdd;
            if ($request->$temp != "") {
                $data2 = new chitiettpdd;
                $data2->ma_sp = $request->ma_sp;
                $data2->ma_tpdd = $tpdd->ma_tpdd;
                $data2->gia_tri = $request->$temp;
                $data2->save();
            }
        }
        return redirect()->back();
    }
    public function xoaSP(Request $request)
    {
        sanpham::find($request->ma_sp)->delete();
        return redirect()->back();
    }
    public function timSP(Request $request){
        $data = sanpham::where('ten_sp', 'like', '%' . $request->ten_sp . '%')->get();
        $data1 = sanphamkhuyenmai::all();
        return view('backend.module.timSanPham')->with([
            'sanpham' => $data,
            'sanphamkhuyenmai' => $data1
        ]);
    }
    public function importSP(Request $request){
        Excel::import(new ExcelImport,request()->file('file'));
        return back();
    }
    public function exportSP(){
        return Excel::download(new ExcelExport, 'product.xlsx');
    }

    //Thống kê sản phẩm bán được theo tháng
    public function getStatisticalProduct(){
        if(session()->has('vaitro') && session('vaitro')!=0){
            // $data = donhang::where('trang_thai_tt', '!=', 0)->get();
            $data1 = chitietdonhang::whereYear('created_at', date('Y'))->select(DB::raw('ma_sp'), DB::raw('sum(soluong) as tongsoluong'))->groupBy('ma_sp')->orderBy('tongsoluong','desc')->get();
            // dd($data1);
            $i=0;
            $arrNameProduct=[];
            $arrNumber=[];
            foreach($data1 as $value){
                $arrNameProduct[$i] = $value->sanpham->ten_sp;
                $arrNumber[$i] = $value->tongsoluong;
                $i++;
            }
            $tensanpham = implode(", ", $arrNameProduct); //output: Pizza, Hamburger, ...
            $tongsoluong = "[".implode(", ", $arrNumber)."]"; //output: [1,2,3]

            $data2 = chitietdonhang::select(DB::raw('year(created_at) as getYear'))->groupBy('getYear')->get();
            // dd($data2);
            return view('backend.thongKeSanPham')->with([
                // 'donhangdathanhtoan' => $data,
                'chitietdonhang' => $data1,
                'tensanpham' => $tensanpham,
                'tongsoluong' => $tongsoluong,
                'year' => $data2,
            ]);
        }
        else return redirect()->back();
    }
    public function filterStatisticalProduct(Request $request){
        $data1 = chitietdonhang::whereYear('created_at', $request->selectYear)->whereMonth('created_at', $request->selectMonth)->select(DB::raw('ma_sp'), DB::raw('sum(soluong) as tongsoluong'))->groupBy('ma_sp')->orderBy('tongsoluong','desc')->get();
        
        $i=0;
        $arrNameProduct=[];
        $arrNumber=[];
        foreach($data1 as $value){
            $arrNameProduct[$i] = $value->sanpham->ten_sp;
            $arrNumber[$i] = $value->tongsoluong;
            $i++;
        }
        $tensanpham = implode(", ", $arrNameProduct); //output: Pizza, Hamburger, ...
        $tongsoluong = "[".implode(", ", $arrNumber)."]"; //output: [1,2,3]
        
        return view('backend.module.locThongKeSanPham')->with([
            'chitietdonhang' => $data1,
            'tensanpham' => $tensanpham,
            'tongsoluong' => $tongsoluong,
            'year' => $request->selectYear,
            'month' => $request->selectMonth
        ]);
    }
    public function locSanPhamTKTheoNgay(Request $request){
        $data1 = chitietdonhang::where('created_at', '>', $request->ngay_tu)->where('created_at', '<', $request->ngay_den)->select(DB::raw('ma_sp'), DB::raw('sum(soluong) as tongsoluong'))->groupBy('ma_sp')->orderBy('tongsoluong','desc')->get();
    
        $i=0;
        $arrNameProduct=[];
        $arrNumber=[];
        foreach($data1 as $value){
            $arrNameProduct[$i] = $value->sanpham->ten_sp;
            $arrNumber[$i] = $value->tongsoluong;
            $i++;
        }
        $tensanpham = implode(", ", $arrNameProduct); //output: Pizza, Hamburger, ...
        $tongsoluong = "[".implode(", ", $arrNumber)."]"; //output: [1,2,3]

        return view('backend.module.locThongKeSanPhamTheoNgay')->with([
            'chitietdonhang' => $data1,
            'tensanpham' => $tensanpham,
            'tongsoluong' => $tongsoluong,
            'ngaytu' => $request->ngay_tu,
            'ngayden' => $request->ngay_den
        ]);
    }

    //Quản lý kho
    public function getWarehouseProduct(){
        $data = sanpham::orderBy('created_at', 'desc')->get();
        $data1 = ngaynhapsanpham::all();
        $data2 = ngaynhapsanpham::select(DB::raw('ma_sp'), DB::raw('sum(soluong_nhap) as tongsoluongnhap'), DB::raw('sum(soluong_hong) as tongsoluonghong'))->groupBy('ma_sp')->get();
        //Duyệt qua tất cả các sản phẩm đã nhập hàng để tính sản phẩm hết hạn
        foreach ($data1 as $d1) {
            //Nếu ngày hiện tại lớn hơn hoặc bằng ngày hết hạn. Tức là sản phẩm này đã hết hạn.
            if(date('Y-m-d H:i:s') >= date('Y-m-d H:i:s', strtotime($d1->ngay_het_han))){
                //Tìm sản phẩm hết hạn
                $sanpham = sanpham::find($d1->ma_sp);
                //Nếu số lượng sản phẩm này còn, thì cập nhật tất cả số lượng sản phẩm ấy thành hỏng. Và tất nhiên số lượng hỏng của sản phẩm sẽ lớn hơn 0
                //Nhưng nếu số lượng hỏng của sản phẩm nhập không lớn hơn 0, tức là sản phẩm đó được nhập thêm hàng vào 1 ngày nào đó nữa. Và tất nhiên ngày đó chưa hết hạn, nếu hết hạn thì đã xử lý ở rồi.
                if($sanpham->soluong_sp > 0 && $d1->soluong_hong == 0){
                    //Đối với trường hợp nhập sản phẩm 2 lần cùng lúc. Lần nhập sau sẽ có hạn sử dụng lâu hơn.
                    //Nên khi sản phẩm nào hết hạn trước thì chuyển số lượng của sản phẩm đó thành hỏng.

                    if ($sanpham->soluong_sp <= $d1->soluong_nhap) { //Chỉ nhập hàng 1 lần, bán được hoặc không bán được sản phẩm.

                        ngaynhapsanpham::where('ngay_het_han',$d1->ngay_het_han)->update([
                            'soluong_hong' => $sanpham->soluong_sp
                        ]);
                        //Cập nhật lại số lượng CÒN cho sản phẩm
                        $sanpham->soluong_sp = 0;
                        $sanpham->save();

                    }
                    else { //Nhập hàng 2 lần trở lên

                        $sanphamhong = $sanpham->soluong_sp - $d1->soluong_nhap;
                        ngaynhapsanpham::where('ngay_het_han',$d1->ngay_het_han)->update([
                            'soluong_hong' => $sanphamhong
                        ]);
                        //Cập nhật lại số lượng CÒN cho sản phẩm
                        $sanpham->soluong_sp = $sanpham->soluong_sp - $sanphamhong;
                        $sanpham->save();

                    }
                }
            }
        }
        $ngayhientai = Carbon::now()->format('Y-m-d H:i:s');
        return view('backend.khoSanPham')->with([
            'sanpham' => $data,
            'ngaynhapsanpham' => $data1,
            'ngaynhapsanpham2' => $data2,
            'ngayhientai' => $ngayhientai
        ]);
    }
    public function insertWarehouseProduct(Request $request){
        if($request->ngay_het_han > date('Y-m-d H:i:s')){
            $data = new ngaynhapsanpham;
            $data->ngay_nhap = date('Y-m-d H:i:s');
            $data->soluong_nhap = $request->soluong_nhap;
            $data->ngay_het_han = $request->ngay_het_han;
            $data->ma_sp = $request->ma_sp;
            $check = $data->save();
            if($check){
                $ngaynhapsanpham = ngaynhapsanpham::orderBy('ngay_nhap', 'desc')->limit(1)->get();
                foreach($ngaynhapsanpham as $spnhap){
                    $sanpham = sanpham::find($spnhap->ma_sp);
                    $sanpham->soluong_sp = $sanpham->soluong_sp + $spnhap->soluong_nhap;
                    $sanpham->save();
                }
            }
            return redirect()->back();
        }else{
            return redirect()->back()->with('tb','Thời gian sản phẩm hết hạn không được nhỏ hơn thời gian hiện tại nhập hàng vào!');
        }
    }
    public function editWarehouseProduct(Request $request){
        $temp = ngaynhapsanpham::where('ngay_nhap', $request->ngay_nhap)->get();
        foreach($temp as $t){}
        //Sản phẩm còn thời hạn mới cho cập nhật số lượng nhập hàng
        if(date('Y-m-d H:i:s') < date('Y-m-d H:i:s', strtotime($t->ngay_het_han))){
            //Cập nhật lại tổng số lượng cho sản phẩm
            $data = ngaynhapsanpham::where('ngay_nhap',$request->ngay_nhap)->get();
            foreach($data as $d){
            }    
            $soluong_nhap_cu = $d->soluong_nhap;
            $soluong_nhap_thaydoi = $request->soluong_nhap - $soluong_nhap_cu;
            $sanpham = sanpham::find($d->ma_sp);
            $sanpham->soluong_sp = $sanpham->soluong_sp + $soluong_nhap_thaydoi;
            $sanpham->save();

            //Cập nhật lại số lượng nhập
            ngaynhapsanpham::where('ngay_nhap', $request->ngay_nhap)->update([
                'soluong_nhap' => $request->soluong_nhap
            ]);
        }
    }
    // public function editWarehouseProductBroken(Request $request){
    //     $data = ngaynhapsanpham::where('ngay_nhap', $request->ngay_nhap)->get();
    //     foreach($data as $d){}
    //     if($d->soluong_nhap >= $request->soluong_hong){ //Sản phẩm hư phải nhỏ hơn tổng số sản phẩm nhập
    //         //Cập nhật lại tổng số lượng cho sản phẩm
    //         $soluong_hong_cu = $d->soluong_hong;
    //         $soluong_hong_thaydoi = $soluong_hong_cu - $request->soluong_hong;
    //         $sanpham = sanpham::find($d->ma_sp);
    //         $sanpham->soluong_sp = $sanpham->soluong_sp + $soluong_hong_thaydoi;
    //         if ($sanpham->soluong_sp >= 0) { // Số lượng sản phẩm còn lại phải >= 0 thì mới cập nhật
    //             $sanpham->save();
    //             //Cập nhật lại số lượng hỏng
    //             ngaynhapsanpham::where('ngay_nhap',$request->ngay_nhap)->update([
    //                 'soluong_hong' => $request->soluong_hong
    //             ]);
    //         }
    //     }
    // }
    public function timSPKho(Request $request){
        $data = sanpham::where('ten_sp', 'like', '%' . $request->ten_sp . '%')->get();
        $data1 = ngaynhapsanpham::all();
        $data2 = ngaynhapsanpham::select(DB::raw('ma_sp'), DB::raw('sum(soluong_nhap) as tongsoluongnhap'), DB::raw('sum(soluong_hong) as tongsoluonghong'))->groupBy('ma_sp')->get();
        return view('backend.module.timSanPhamKho')->with([
            'sanpham' => $data,
            'ngaynhapsanpham' => $data1,
            'ngaynhapsanpham2' => $data2
        ]);
    }

    //Đơn hàng
    public function getDonHang()
    {
        if(session()->has('vaitro') && session('vaitro')!=0){
            $data = donhang::orderBy('ma_dh', 'desc')->get();
            $data1 = donhang::where('trang_thai_dh', 0)->count();
            $data2 = donhang::where('trang_thai_dh', 1)->count();
            $data3 = donhang::where('trang_thai_dh', 2)->count();
            $data4 = donhang::where('trang_thai_tt', 0)->count();
            $data5 = donhang::where('trang_thai_tt', 1)->count();
            $data6 = donhang::where('trang_thai_tt', 2)->count();
            $data7 = donhang::where('ma_tv', '!=', null)->count();
            $data8 = donhang::where('ma_tv', null)->count();
            return view('backend.donHang')->with([
                'donhang' => $data,
                'tongDHCXN' => $data1,
                'tongDHDG' => $data2,
                'tongDHDaG' => $data3,
                'tongDHChuaTT' => $data4,
                'tongDHTTTT' => $data5,
                'tongDHTTOnline' => $data6,
                'tongDHThanhVien' => $data7,
                'tongDHKhachVangLai' => $data8,
            ]);
        }
        else return redirect()->back();
    }
    public function getChiTietDonHang($ma_dh)
    {
        $data = chitietdonhang::where('ma_dh', $ma_dh)->get();
        $data1 = donhang::where('ma_dh', $ma_dh)->get();
        $data2 = sanphamkhuyenmai::all();
        return view('backend.chiTietDonHang')->with([
            'chitietdonhang' => $data,
            'donhang' => $data1,
            'sanphamkhuyenmai' => $data2
        ]);
    }
    public function giaoHang(Request $request){
        $data = donhang::find($request->ma_dh);
        $data->trang_thai_dh = $request->trang_thai_dh;
        if($data->trang_thai_tt != 2){
            if($request->trang_thai_dh == 2){
                $data->trang_thai_tt = 1;
            }
            else{
                $data->trang_thai_tt = 0;
            }
        }
        $data->save();
        return redirect()->back();
    }
    public function inDonHang($ma_dh){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->inDonHang_convert($ma_dh));
        return $pdf->stream();
    }
    public function inDonHang_convert($ma_dh){
        $data = donhang::where('ma_dh', $ma_dh)->get();
        $data1 = chitietdonhang::where('ma_dh', $ma_dh)->get();
        $data2 = sanphamkhuyenmai::all();
        return view('backend.inDonHang')->with([
            'thongtindonhang' => $data,
            'chitietdonhang' => $data1,
            'sanphamkhuyenmai' => $data2
        ]);
    }
    public function filterOrder(Request $request){
        if ($request->selectOrder <= 2) {
            $data = donhang::where('trang_thai_dh', $request->selectOrder)->orderBy('created_at', 'desc')->get();
        }else if($request->selectOrder == 3) {
            $data = donhang::where('trang_thai_tt', 2)->orderBy('created_at', 'desc')->get();
        }else if($request->selectOrder == 4){
            $data = donhang::where('trang_thai_tt', 1)->orderBy('created_at', 'desc')->get();
        }else if($request->selectOrder == 5){
            $data = donhang::where('trang_thai_tt', 0)->orderBy('created_at', 'desc')->get();
        }else if($request->selectOrder == 6){
            $data = donhang::where('ma_tv', '!=', null)->orderBy('created_at', 'desc')->get();
        }else if($request->selectOrder == 7){
            $data = donhang::where('ma_tv', null)->orderBy('created_at', 'desc')->get();
        }
        return view('backend.module.locDonHang')->with([
            'donhang' => $data
        ]);
    }
    public function locDonHangTheoNgay(Request $request){
        $data = donhang::where('created_at', '>', $request->ngay_tu)->where('created_at', '<', $request->ngay_den)->orderBy('created_at', 'desc')->get();
        return view('backend.module.locDonHang')->with([
            'donhang' => $data
        ]);
    }

    //Bình luận
    public function thayDoiTrangThaiBL(Request $request){
        $data = binhluan::find($request->ma_bl);
        $data->trang_thai_bl = $request->trang_thai_bl;
        $data->save();
        return redirect()->back();
    }

    public function xoaBL($ma_bl){
        binhluan::find($ma_bl)->delete();
        return redirect()->back();
    }
}
