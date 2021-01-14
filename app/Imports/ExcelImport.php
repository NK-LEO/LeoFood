<?php

namespace App\Imports;

use App\Models\sanpham;
use Maatwebsite\Excel\Concerns\ToModel;

class ExcelImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new sanpham([
            'ten_sp' => $row[0],
            'hinh_sp' => $row[1],
            'chitiet_sp' => $row[2],
            'gia_sp' => $row[3],
            'soluong_sp' => $row[4],
            'ma_loaisp' => $row[5],
        ]);
    }
}
