<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\thanhvien;
use App\Models\slideshow;
use App\Models\loaisanpham;
use App\Models\sanpham;
use App\Models\donhang;
use App\Models\chitietdonhang;
use App\Models\binhluan;
use App\Models\phanhoi;
use App\Models\danhgia;
use App\Models\thanhphandinhduong;
use App\Models\chitiettpdd;
use App\Models\tinhthanhpho;
use App\Models\quanhuyen;
use App\Models\xaphuongthitran;
use App\Models\khuyenmai;
use App\Models\sanphamkhuyenmai;
use App\Models\ngaynhapsanpham;
use App\Models\doimatkhau;
use Illuminate\Support\Str;
use DB;
use Cart;
use Auth;

class FrontendController extends Controller
{
    public function getWelcome(){
        return view('frontend.welcome');
    }

    public function getListProduct()
    {
        $data = slideshow::all();
        $data1 = loaisanpham::all();
        $data2 = sanpham::orderBy('created_at', 'desc')->paginate(12);
        $data3 = sanphamkhuyenmai::all();
        $data4 = danhgia::select(DB::raw('ma_sp'), DB::raw(' avg(so_sao) as so_sao'))->groupBy('ma_sp')->get();
        // dd($data4->toArray());
        return view('frontend.listProduct')->with([
            'slideshow' => $data,
            'loaisanpham' => $data1,
            'sanpham' => $data2,
            'sanphamkhuyenmai' => $data3,
            'danhgia' => $data4
        ]);
    }

    public function gioiThieu(){
        return view('frontend.gioiThieu');
    }

    public function lienHe(){
        return view('frontend.lienHe');
    }

    public function dangNhap()
    {
        return view('frontend.dangnhap');
    }

    public function dangKy()
    {
        return view('frontend.dangky');
    }

    public function dangXuat()
    {
        session()->flush();
        return redirect()->route('trang-chu');
    }

    //Lấy lại mật khẩu
    public function layLaiMatKhau(){
        return view('frontend.layMatKhau');
    }
    public function guiChuoiBiMat(Request $request){
        if($request->email == null){
            return redirect()->back();
        }else{
            $data = thanhvien::where('email_tv', $request->email)->count();
            if($data > 0){
                $data1 = doimatkhau::where('email', $request->email)->count();
                if($data1 > 0){
                    doimatkhau::where('email', $request->email)->delete();
                }

                $data2 = new doimatkhau;
                $data2->email = $request->email;
                $data2->chuoi_bi_mat = Str::random(8);
                $check = $data2->save();

                if($check){
                    $temp = doimatkhau::where('email', $request->email)->get();
                    $data3 = [
                        'doimatkhau' => $temp
                    ];
                    $email = $request->email;
                    Mail::send('frontend.mailGetPass', $data3, function ($message) use ($email) {
                        $message->from('leofood3@gmail.com', 'LeoFood');
                        $message->to($email, 'Bạn');
                        $message->subject('Chuỗi bí mật');
                    });
                }
                session()->put('kiemtra', 'Kiểm tra có chuỗi bí mật chưa');
                return redirect()->route('dat-lai-mat-khau');
            }else{
                return redirect()->back()->with('fail', 'Email chưa đăng ký!');
            }
        }
    }
    public function datLaiMatKhau(){
        if (session()->has('kiemtra')) {
            return view('frontend.datMatKhau');
        } else {
            return redirect()->back();
        }
    }
    public function luuMatKhau(Request $request){
        $data = doimatkhau::where('chuoi_bi_mat', $request->chuoi_bi_mat)->get();
        if (!empty($data->toArray())) {
            foreach($data as $d){}
            $newPass = md5(md5($request->mat_khau_moi));
            $data2 = thanhvien::where('email_tv', $d->email)->update(['matkhau' => $newPass]);
            session()->forget('kiemtra');
            return redirect()->route('dang-nhap')->with('hoantat', 'Lấy lại mật khẩu thành công!');
        } else {
            return redirect()->back()->with('saichuoibimat', 'Chuỗi bí mật bạn nhập không đúng!');
        }
    }

    public function locLoaiSanPham($ma_loaisp){
        $data = sanpham::where('ma_loaisp', $ma_loaisp)->get();
        $data1 = loaisanpham::where('ma_loaisp', $ma_loaisp)->get();
        $data2 = sanphamkhuyenmai::all();
        $data3 = danhgia::select(DB::raw('ma_sp'), DB::raw(' avg(so_sao) as so_sao'))->groupBy('ma_sp')->get();
        return view('frontend.module.locSanPham')->with([
            'sanpham' => $data,
            'loaisanpham' => $data1,
            'sanphamkhuyenmai' => $data2,
            'danhgia' => $data3
        ]);
    }

    public function locSanPham(Request $request){
        if($request->gia != null && $request->sapXep == 0){
            switch($request->gia){
                case "1" :
                    $data = sanpham::where('gia_sp', '<' , 50000)->get();
                    break;
                case "2" :
                    $data = sanpham::where('gia_sp', '>=' , 50000)->where('gia_sp', '<' , 100000)->get();
                    break;
                case "3" :
                    $data = sanpham::where('gia_sp', '>=' , 100000)->where('gia_sp', '<' , 150000)->get();
                    break;
                case "4" :
                    $data = sanpham::where('gia_sp', '>=' , 150000)->where('gia_sp', '<' , 200000)->get();
                    break;
                case "5" :
                    $data = sanpham::where('gia_sp', '>=' , 200000)->get();
                    break;
            }
        }
        if($request->gia != null && $request->sapXep == 6){
            switch($request->gia){
                case "1" :
                    $data = sanpham::where('gia_sp', '<' , 50000)->orderBy('gia_sp', 'asc')->get();
                    break;
                case "2" :
                    $data = sanpham::where('gia_sp', '>=' , 50000)->where('gia_sp', '<' , 100000)->orderBy('gia_sp', 'asc')->get();
                    break;
                case "3" :
                    $data = sanpham::where('gia_sp', '>=' , 100000)->where('gia_sp', '<' , 150000)->orderBy('gia_sp', 'asc')->get();
                    break;
                case "4" :
                    $data = sanpham::where('gia_sp', '>=' , 150000)->where('gia_sp', '<' , 200000)->orderBy('gia_sp', 'asc')->get();
                    break;
                case "5" :
                    $data = sanpham::where('gia_sp', '>=' , 200000)->orderBy('gia_sp', 'asc')->get();
                    break;
            }
        }
        if($request->gia != null && $request->sapXep == 7){
            switch($request->gia){
                case "1" :
                    $data = sanpham::where('gia_sp', '<' , 50000)->orderBy('gia_sp', 'desc')->get();
                    break;
                case "2" :
                    $data = sanpham::where('gia_sp', '>=' , 50000)->where('gia_sp', '<' , 100000)->orderBy('gia_sp', 'desc')->get();
                    break;
                case "3" :
                    $data = sanpham::where('gia_sp', '>=' , 100000)->where('gia_sp', '<' , 150000)->orderBy('gia_sp', 'desc')->get();
                    break;
                case "4" :
                    $data = sanpham::where('gia_sp', '>=' , 150000)->where('gia_sp', '<' , 200000)->orderBy('gia_sp', 'desc')->get();
                    break;
                case "5" :
                    $data = sanpham::where('gia_sp', '>=' , 200000)->orderBy('gia_sp', 'desc')->get();
                    break;
            }
        }
        if($request->gia == null){
            if($request->sapXep == 0){
                // $data = sanpham::orderBy('created_at', 'desc')->get(); //Chú ý chỗ này cần tùy biến
            }else if($request->sapXep == 6){
                $data = sanpham::orderBy('gia_sp', 'asc')->get();
            }else{
                $data = sanpham::orderBy('gia_sp', 'desc')->get();
            }
        }
        $data1 = sanphamkhuyenmai::all();
        $data2 = danhgia::select(DB::raw('ma_sp'), DB::raw(' avg(so_sao) as so_sao'))->groupBy('ma_sp')->get();
        return view('frontend.module.filterSanPham')->with([
            'sanpham' => $data,
            'sanphamkhuyenmai' => $data1,
            'danhgia' => $data2
        ]);
    }

    public function chiTietSanPham($ma_sp)
    {
        $data = sanpham::where('ma_sp', $ma_sp)->get();
        $data1 = binhluan::where('ma_sp', $ma_sp)->orderBy('created_at', 'desc')->get();
        $data2 = phanhoi::all();
        $data3 = danhgia::where('ma_sp', $ma_sp)->select(DB::raw('count(so_sao) as luot_danh_gia'))->groupBy('so_sao')->addSelect('so_sao')->get()->toArray();
        $danhgia = [];
        if (!empty($data3)) {
            for ($i = 1; $i <= 5; $i++) {
                $danhgia[$i] = [
                    "luot_danh_gia" => 0,
                    "so_sao" => 0
                ];
                foreach ($data3 as $item) {
                    if ($item['so_sao'] == $i) {
                        $danhgia[$i] = $item;
                        continue;
                    }
                }
            }
        }
        $data4 = danhgia::where('ma_sp', $ma_sp)->avg('so_sao');
        $data5 = danhgia::where('ma_sp', $ma_sp)->count('so_sao');
        $data6 = danhgia::where('ma_sp', $ma_sp)->orderBy('created_at', 'desc')->get();
        $data7 = thanhphandinhduong::all();
        $data8 = chitiettpdd::where('ma_sp', $ma_sp)->get();
        $data9 = sanphamkhuyenmai::all();
        foreach($data as $sp){}
        $data10 = sanpham::where('ma_loaisp', $sp->ma_loaisp)->where('ma_sp', '<>', $ma_sp)->inRandomOrder()->limit(4)->get();
        // dd($data10->toArray());
        $data11 = danhgia::select(DB::raw('ma_sp'), DB::raw(' avg(so_sao) as so_sao'))->groupBy('ma_sp')->get();
        return view('frontend.productDetail')->with([
            'sanpham' => $data,
            'binhluan' => $data1,
            'phanhoi' => $data2,
            'danhgia' => $danhgia,
            'sosao' => $data4,
            'tongsoluotdanhgia' => $data5,
            'nguoidanhgia' => $data6,
            'thanhphandinhduong' => $data7,
            'chitiettpdd' => $data8,
            'sanphamkhuyenmai' => $data9,
            'sanphamlienquan' => $data10,
            'danhgia2' => $data11
        ]);
    }

    public function timTenSanPham(Request $request){
        if($request->ajax()){
            if($request->value != null){
                $data = sanpham::where('ten_sp', 'like', '%' . $request->value . '%')->get();
                return view('frontend.module.timTenSanPham')->with([
                    'sanpham' => $data
                ]);
            }
        }
    }

    public function timKiemSanPham(Request $request){
        $data = sanpham::where('ten_sp', 'like', '%' . $request->ten_sp . '%')->get();
        $data1 = sanphamkhuyenmai::all();
        $data2 = danhgia::select(DB::raw('ma_sp'), DB::raw(' avg(so_sao) as so_sao'))->groupBy('ma_sp')->get();
        return view('frontend.timKiemSanPham')->with([
            'sanpham' => $data,
            'tenTimKiem' => $request->ten_sp,
            'sanphamkhuyenmai' => $data1,
            'danhgia' => $data2
        ]);
    }

    //Đăng ký tài khoản
    public function dangKyTaiKhoan(Request $request)
    {
        $temp = thanhvien::where('email_tv', $request->email_tv)->count();
        if($temp == 1){
            return redirect()->route('dang-ky')->with('dangnhap', 'Email bạn nhập đã được đăng ký');
        }
        else{
            $data = new thanhvien;
            $data->ten_tv = $request->ten_tv;
            $data->email_tv = $request->email_tv;
            $data->sdt_tv = $request->sdt_tv;
            $data->matkhau = md5(md5($request->matkhau));
            $data->save();
            return redirect()->route('dang-nhap')->with('thanhcong', 'Đăng ký tài khoản thành công');
        }
    }

    //Đăng nhập tài khoản
    public function dangNhapTaiKhoan(Request $request)
    {
        $data = thanhvien::where('email_tv', $request->email)->where('matkhau', md5(md5($request->matkhau)))->get()->toArray();
        if ($data != null) {
            foreach ($data as $value) {}
            if ($value['trangthai'] == 0) {
                session()->put('ma_tv', $value['ma_tv']);
                session()->put('hinh_tv', $value['hinh_tv']);
                session()->put('ten_tv', $value['ten_tv']);
                session()->put('email_tv', $value['email_tv']);
                // session()->put('sdt_tv', $value['sdt_tv']);
                session()->put('vaitro', $value['vaitro']);
                return redirect()->route('trang-chu');
            } else {
                return redirect()->back()->with('dntb', 'Tài khoản của bạn hiện đang bị khóa');
            }
        }
        else {
            return redirect()->back()->with('dntb', 'Email hoặc mật khẩu không chính xác');
        }
    }

    //Thông tin cá nhân
    public function getThongTinCN()
    {
        $data = thanhvien::where('ma_tv', session('ma_tv'))->get();
        return view('frontend.thongTinCaNhan')->with([
            'thanhvien' => $data
        ]);
    }

    public function capNhatTTCN(Request $request)
    {
        $data = thanhvien::find($request->ma_tv);
        $data->ten_tv = $request->ten_tv;
        session()->forget('ten_tv');
        session()->put('ten_tv', $request->ten_tv);
        if ($request->hinh_tv != "") {
            $file_name = $request->hinh_tv->getClientOriginalName();
            $request->hinh_tv->move('public/frontend/images/', $file_name);
            $data->hinh_tv = 'public/frontend/images/' . $file_name;
            session()->forget('hinh_tv');
            session()->put('hinh_tv', 'public/frontend/images/' . $file_name);
        }
        $data->sdt_tv = $request->sdt_tv;
        if ($request->matkhau != null && $request->matkhaumoi1 != null && $request->matkhaumoi2 != null) {
            if ($data->matkhau == md5(md5($request->matkhau))) {
                $data->matkhau = md5(md5($request->matkhaumoi1));
            } else {
                return redirect()->back()->with('mktb', 'Mật khẩu cũ của bạn nhập không đúng');
            }
        }
        $data->save();
        return redirect()->back()->with('thanhcong', 'Thành công');
    }

    //Giỏ hàng
    public function getGioHang()
    {
        return view('frontend.gioHang');
    }

    public function themSPGioHang(Request $request)
    {
        $sanpham = sanpham::where('ma_sp', $request->ma_sp)->get()->toArray();
        $sanphamkhuyenmai = sanphamkhuyenmai::where('ma_sp', $request->ma_sp)->get()->toArray();
        if(!empty($sanphamkhuyenmai)){
            foreach($sanphamkhuyenmai as $spkm){}
            $khuyenmai = khuyenmai::find($spkm['ma_km']);
            if(date('Y-m-d H:i:s') >= date('Y-m-d H:i:s', strtotime($khuyenmai->ngay_bd)) && date('Y-m-d H:i:s') <= date('Y-m-d H:i:s', strtotime($khuyenmai->ngay_kt))){
                if($khuyenmai->loai_km == 1){
                    foreach ($sanpham as $item) {
                        $data['id'] = $item['ma_sp'];
                        $data['qty'] = 1;
                        $data['name'] = $item['ten_sp'];
                        $data['price'] = $item['gia_sp'] - (($item['gia_sp'] * $khuyenmai->gia_tri_km) / 100);
                        $data['weight'] = 1;
                        $data['options']['image'] = $item['hinh_sp'];
                    }
                    Cart::add($data);
                }
                else{
                    foreach ($sanpham as $item) {
                        $data['id'] = $item['ma_sp'];
                        $data['qty'] = 1;
                        $data['name'] = $item['ten_sp'];
                        $data['price'] = $item['gia_sp'] - $khuyenmai->gia_tri_km;
                        $data['weight'] = 1;
                        $data['options']['image'] = $item['hinh_sp'];
                    }
                    Cart::add($data);
                }
            }
            else{
                // echo "chưa đế hạn khuyến mãi";
                foreach ($sanpham as $item) {
                    $data['id'] = $item['ma_sp'];
                    $data['qty'] = 1;
                    $data['name'] = $item['ten_sp'];
                    $data['price'] = $item['gia_sp'];
                    $data['weight'] = 1;
                    $data['options']['image'] = $item['hinh_sp'];
                }
                Cart::add($data);
            }
        }else{
            // echo "SP này không khuyến mãi";
            foreach ($sanpham as $item) {
                $data['id'] = $item['ma_sp'];
                $data['qty'] = 1;
                $data['name'] = $item['ten_sp'];
                $data['price'] = $item['gia_sp'];
                $data['weight'] = 1;
                $data['options']['image'] = $item['hinh_sp'];
            }
            Cart::add($data);
        }
        // return redirect()->back();
    }

    public function xoaSPGioHang($rowId)
    {
        Cart::update($rowId, 0);
        return view('frontend.module.capNhatGioHang');
    }

    public function capNhatSPGioHang(Request $request)
    {
        Cart::update($request->rowId, $request->soluong);
        return view('frontend.module.capNhatSLSPGioHang');
    }

    public function giamGia(Request $request){
        $magiamgia = "DI16V7A2";
        if ($request->magiamgia == $magiamgia) {
            session()->put('giamgia', 'giamgia');
            return redirect()->back();
        } else {
            return redirect()->back()->with('ggtb', 'Mã giảm giá không đúng');
        }
    }

    //Đơn hàng
    public function thongTinGiaoHang()
    {
        if (session()->has('ma_tv')) {
            $data = thanhvien::where('ma_tv', session('ma_tv'))->get();
            $data1 = tinhthanhpho::all();
            $data2 = quanhuyen::all();
            return view('frontend.thongTinGiaoHang')->with([
                'thanhvien' => $data,
                'tinhthanhpho' => $data1,
                'quanhuyen' => $data2
            ]);
        } else {
            // return redirect()->route('dang-nhap')->with('dangnhap', 'Vui lòng đăng nhập để mua hàng');
            $data1 = tinhthanhpho::all();
            $data2 = quanhuyen::all();
            return view('frontend.thongTinGiaoHang')->with([
                'tinhthanhpho' => $data1,
                'quanhuyen' => $data2
            ]);
        }
    }

    public function luuDonHang(Request $request)
    {
        if ($request->hinhThucTT == "tructiep") {
            //Thanh toán trực tiếp
            $xaphuongthitran = xaphuongthitran::where('maxptt', $request->xaphuongthitran)->get();
            foreach($xaphuongthitran as $xptt)
            $quanhuyen = quanhuyen::where('maqh', $request->quanhuyen)->get();
            foreach($quanhuyen as $qh)
            $thanhpho = tinhthanhpho::where('matp', $request->tinhthanhpho)->get();
            foreach($thanhpho as $tp)
            $ma_tv =  session('ma_tv');
            $ten_nn = $request->ten_nn;
            $email_nn = session('email_tv');
            $sdt_nn = $request->sdt_nn;
            $diachi_nn = $request->khuvuc.','. ' '.$xptt->name.','. ' '.$qh->name.','. ' '.$tp->name;
            if (session()->has('giamgia')) {
                $t = Cart::subtotal()+15000;
                $tongtien = $t - $t*0.05;
            } else {
                $tongtien = Cart::subtotal()+15000;
            }
            $donhang = new donhang;
            $donhang->ma_tv = $ma_tv;
            $donhang->ten_nn = $ten_nn;
            $donhang->email_nn = $email_nn;
            $donhang->sdt_nn = $sdt_nn;
            $donhang->diachi_nn = $diachi_nn;
            $donhang->tongtien = $tongtien;
            $check = $donhang->save();
            if ($check) {
                $thongtindonhang = donhang::orderBy('ma_dh', 'desc')->limit(1)->get();
                foreach ($thongtindonhang as $data) {
                    foreach (Cart::content() as $item) {
                        $chitietdonhang = new chitietdonhang();
                        $chitietdonhang->ma_dh = $data->ma_dh;
                        $chitietdonhang->ma_sp = $item->id;
                        $chitietdonhang->soluong = $item->qty;
                        $chitietdonhang->save();
                    }
                    $temp = chitietdonhang::where('ma_dh', $data->ma_dh)->get();
                    foreach ($temp as $t) {
                        $d = sanpham::find($t->ma_sp);
                        $d->soluong_sp = $d->soluong_sp - $t->soluong;
                        $d->save();
                    }
                }
            }
            if(session()->has('ma_tv')){
                $temp2 = sanphamkhuyenmai::all();
                $data1 = [
                    'thongtindonhang' => $thongtindonhang,
                    'chitietdonhang' => $temp,
                    'thoigiannhanhang' => $request->thoigiannhanhang,
                    'sanphamkhuyenmai' => $temp2
                ];
                Mail::send('frontend.mail', $data1, function ($message) {
                    $message->from('leofood3@gmail.com', 'LeoFood');
                    $message->to(session('email_tv'), 'Bạn');
                    $message->subject('Chúc mừng bạn đã đặt hàng thành công');
                });
            }
            Cart::destroy();
            session()->forget('giamgia');
            return redirect()->route('chuc-mung')->with('chucmung', 'chucmung');
        } else {
            //Thanh toán online
            session()->put('duLieuTTOnline', $request->all()); //Tạo session để lưu dữ liệu mua hàng của người dùng
            $vnp_TmnCode = "8B8OLLBW"; //Mã website tại VNPAY 
            $vnp_HashSecret = "MAGXBANFIJQZPFQQCZBRYINFBCHECXMD"; //Chuỗi bí mật
            $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "http://localhost/dat-hang-thanh-cong";
            $vnp_TxnRef = date("YmdHis"); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = "Thanh toán hóa đơn phí dịch vụ";
            $vnp_OrderType = 'billpayment';
            $vnp_Amount = (Cart::subtotal()+15000)*100;
            $vnp_Locale = 'vn';
            $vnp_IpAddr = request()->ip();
            $inputData = array(
                "vnp_Version" => "2.0.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . $key . "=" . $value;
                } else {
                    $hashdata .= $key . "=" . $value;
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }
    
            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
                $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
            }
            return redirect($vnp_Url);
        }
    }

    function getChucMung(Request $request){
        if(session()->has('chucmung') || $request->vnp_ResponseCode == '00'){
            if(session()->has('duLieuTTOnline')){
                $tmp = session("duLieuTTOnline");
                $xaphuongthitran = xaphuongthitran::where('maxptt', $tmp['xaphuongthitran'])->get();
                foreach($xaphuongthitran as $xptt)
                $quanhuyen = quanhuyen::where('maqh', $tmp['quanhuyen'])->get();
                foreach($quanhuyen as $qh)
                $thanhpho = tinhthanhpho::where('matp', $tmp['tinhthanhpho'])->get();
                foreach($thanhpho as $tp)
                $ma_tv =  session('ma_tv');
                $ten_nn = $tmp['ten_nn'];
                $email_nn = session('email_tv');
                $sdt_nn = $tmp['sdt_nn'];
                $diachi_nn = $tmp['khuvuc'].','. ' '.$xptt->name.','. ' '.$qh->name.','. ' '.$tp->name;
                if (session()->has('giamgia')) {
                    $t = Cart::subtotal()+15000;
                    $tongtien = $t - $t*0.05;
                } else {
                    $tongtien = Cart::subtotal()+15000;
                }
                $donhang = new donhang;
                $donhang->ma_tv = $ma_tv;
                $donhang->ten_nn = $ten_nn;
                $donhang->email_nn = $email_nn;
                $donhang->sdt_nn = $sdt_nn;
                $donhang->diachi_nn = $diachi_nn;
                $donhang->trang_thai_tt = 2; // Đơn hàng đã thanh toán qua VNPay
                $donhang->tongtien = $tongtien;
                $check = $donhang->save();
                if ($check) {
                    $thongtindonhang = donhang::orderBy('ma_dh', 'desc')->limit(1)->get();
                    foreach ($thongtindonhang as $data) {
                        foreach (Cart::content() as $item) {
                            $chitietdonhang = new chitietdonhang();
                            $chitietdonhang->ma_dh = $data->ma_dh;
                            $chitietdonhang->ma_sp = $item->id;
                            $chitietdonhang->soluong = $item->qty;
                            $chitietdonhang->save();
                        }
                        $temp = chitietdonhang::where('ma_dh', $data->ma_dh)->get();
                        foreach ($temp as $t) {
                            $d = sanpham::find($t->ma_sp);
                            $d->soluong_sp = $d->soluong_sp - $t->soluong;
                            $d->save();
                        }
                    }
                }
                if(session()->has('ma_tv')){
                    $temp2 = sanphamkhuyenmai::all();
                    $data1 = [
                        'thongtindonhang' => $thongtindonhang,
                        'chitietdonhang' => $temp,
                        'thoigiannhanhang' => $tmp['thoigiannhanhang'],
                        'sanphamkhuyenmai' => $temp2
                    ];
                    Mail::send('frontend.mail', $data1, function ($message) {
                        $message->from('leofood3@gmail.com', 'LeoFood');
                        $message->to(session('email_tv'), 'Bạn');
                        $message->subject('Chúc mừng bạn đã đặt hàng thành công');
                    });
                }
                Cart::destroy();
                session()->forget('giamgia');
            }
            session()->forget('duLieuTTOnline');
            return view('frontend.chucMung');
        }else{
            return redirect()->route('trang-chu');
        }
    }

    public function donHangCuaBan()
    {
        if (session()->has('ma_tv')) {
            $data = donhang::where('ma_tv', session('ma_tv'))->orderBy('created_at', 'desc')->get();
            $data1 = chitietdonhang::all();
            $data2 = sanphamkhuyenmai::all();
            return view('frontend.thongTinDonHang')->with([
                'donhang' => $data,
                'chitietdonhang' => $data1,
                'sanphamkhuyenmai' => $data2,
            ]);
        }
    }

    public function tatCaDonHang(){
        if (session()->has('ma_tv')) {
            $data = donhang::where('ma_tv', session('ma_tv'))->orderBy('created_at', 'desc')->get();
            $data1 = chitietdonhang::all();
            $data2 = sanphamkhuyenmai::all();
            return view('frontend.module.donHangTatCa')->with([
                'donhang' => $data,
                'chitietdonhang' => $data1,
                'sanphamkhuyenmai' => $data2,
            ]);
        }
    }

    public function donHangChoXN()
    {
        if (session()->has('ma_tv')) {
            $data = donhang::where('ma_tv', session('ma_tv'))->where('trang_thai_dh', 0)->orderBy('created_at', 'desc')->get();
            $data1 = chitietdonhang::all();
            $data2 = sanphamkhuyenmai::all();
            return view('frontend.module.donHangChoXN')->with([
                'donhang' => $data,
                'chitietdonhang' => $data1,
                'sanphamkhuyenmai' => $data2,
            ]);
        }
    }

    public function donHangDangGiao()
    {
        if (session()->has('ma_tv')) {
            $data = donhang::where('ma_tv', session('ma_tv'))->where('trang_thai_dh', 1)->orderBy('created_at', 'desc')->get();
            $data1 = chitietdonhang::all();
            $data2 = sanphamkhuyenmai::all();
            return view('frontend.module.donHangDangGiao')->with([
                'donhang' => $data,
                'chitietdonhang' => $data1,
                'sanphamkhuyenmai' => $data2,
            ]);
        }
    }

    public function donHangDaGiao()
    {
        if (session()->has('ma_tv')) {
            $data = donhang::where('ma_tv', session('ma_tv'))->where('trang_thai_dh', 2)->orderBy('created_at', 'desc')->get();
            $data1 = chitietdonhang::all();
            $data2 = sanphamkhuyenmai::all();
            return view('frontend.module.donHangDaGiao')->with([
                'donhang' => $data,
                'chitietdonhang' => $data1,
                'sanphamkhuyenmai' => $data2,
            ]);
        }
    }

    public function xoaDonHangDaGiao($ma_dh){
        donhang::find($ma_dh)->delete();
        return redirect()->back();
    }

    //Quận huyện, xã phường thị trấn
    // public function getQuanHuyen($matp){
    //     if($matp != 0){
    //         $quanhuyen = quanhuyen::where('matp', $matp)->get();
    //         echo "<option value='0'>Chọn...</option>";
    //         foreach($quanhuyen as $qh){
    //             echo "<option value='".$qh->maqh."'>".$qh->name."</option>";
    //         }
    //     }
    //     else echo "<option value='0'>Vui lòng chọn thành phố</option>";
    // }

    public function getXaPhuongThiTran($maqh){
        if($maqh != 0){
            $xaphuongthitran = xaphuongthitran::where('maqh', $maqh)->get();
            echo "<option value='0'>Chọn...</option>";
            foreach($xaphuongthitran as $xptt){
                echo "<option value='".$xptt->maxptt."'>".$xptt->name."</option>";
            }
        }
        else echo "<option value='0'>Vui lòng chọn quận huyện</option>";
    }

    //Bình luận
    public function binhLuan(Request $request)
    {
        if (session()->has('ma_tv')) {
            $data = new binhluan;
            $data->ma_tv = session('ma_tv');
            $data->ma_sp = $request->ma_sp;
            $data->noidung_bl = $request->noidung_bl;
            $data->save();
            $data1 = binhluan::where('ma_sp', $request->ma_sp)->orderBy('created_at', 'desc')->get();
            $data2 = phanhoi::all();
            return view('frontend.module.binhLuan')->with([
                'binhluan' => $data1,
                'phanhoi' => $data2,
            ]);
        } else {
            echo "<script>
                swal('Vui lòng đăng nhập để viết bình luận!')
                .then((value) => {
                    location.reload();
                });
            </script>";
        }
    }
    
    public function phanHoi(Request $request)
    {
        if (session()->has('ma_tv')) {
            $data = new phanhoi;
            $data->ma_tv = $request->ma_tv;
            $data->ma_bl = $request->ma_bl;
            $data->noidung_ph = $request->noidung_ph;
            $data->save();
            return redirect()->back();
        } else {
            return redirect()->route('dang-nhap')->with('dangnhap', 'Vui lòng đăng nhập để viết phản hồi');
        }
    }

    //Đánh giá
    public function danhGia(Request $request)
    {
        try {
            if (session()->has('ma_tv')) {
                if($request->so_sao != 0){
                    $data = new danhgia;
                    $data->ma_tv = session('ma_tv');
                    $data->ma_sp = $request->ma_sp;
                    $data->so_sao = $request->so_sao;
                    $data->save();
                    $data1 = danhgia::where('ma_sp', $request->ma_sp)->select(DB::raw('count(so_sao) as luot_danh_gia'))->groupBy('so_sao')->addSelect('so_sao')->get()->toArray();
                    $danhgia = [];
                    if (!empty($data1)) {
                        for ($i = 1; $i <= 5; $i++) {
                            $danhgia[$i] = [
                                "luot_danh_gia" => 0,
                                "so_sao" => 0
                            ];
                            foreach ($data1 as $item) {
                                if ($item['so_sao'] == $i) {
                                    $danhgia[$i] = $item;
                                    continue;
                                }
                            }
                        }
                    }
                    $data2 = danhgia::where('ma_sp', $request->ma_sp)->avg('so_sao');
                    $data3 = danhgia::where('ma_sp', $request->ma_sp)->count('so_sao');
                    $data4 = danhgia::where('ma_sp', $request->ma_sp)->orderBy('created_at', 'desc')->get();
                    return view('frontend.module.danhGia')->with([
                        'danhgia' => $danhgia,
                        'sosao' => $data2,
                        'tongsoluotdanhgia' => $data3,
                        'nguoidanhgia' => $data4,
                    ]);
                }else{
                    echo "<script>
                    swal('Vui lòng chọn số sao để đánh giá!')
                    .then((value) => {
                        location.reload();
                    }); 
                </script>";
                }
            } else {
                echo "<script>
                    swal('Vui lòng đăng nhập để đánh giá!')
                    .then((value) => {
                        location.reload();
                    }); 
                </script>";
            }
        } catch (\Throwable $th) {
            echo "<script>
                swal('Bạn đã đánh giá sản phẩm này rồi!')
                .then((value) => {
                    location.reload();
                });
                </script>";
        }
    }
}
