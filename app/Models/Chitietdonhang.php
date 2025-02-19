<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chitietdonhang extends Model
{
    use HasFactory;
    protected $table = 'chitietdonhangs';
    protected $fillable = ['don_hang_id', 'san_pham_id', 'soluong', 'tong', 'trang_thai_id', 'dia_chi', 'so_dien_thoai', 'ten_nguoi_nhan', 'ghi_chu', 'tong_tien', 'phuong_thuc_thanh_toan'];

    public function donhang()
    {
        return $this->belongsTo(Donhang::class, 'don_hang_id');
    }
    public function sanpham()
    {
        return $this->belongsTo(Sanpham::class, 'san_pham_id');
    }
    public function trangthai()
    {
        return $this->belongsTo(Trangthai::class, 'trang_thai_id');
    }

    public function getGiaAttribute()
    {
        return $this->sanpham->gia_goc;
    }
    public function getGiaKhuyenMaiAttribute()
    {
        return $this->sanpham->gia_km_phan_tram;
    }
    public function getTongTienAttribute()
    {
        return $this->soluong * $this->gia;
    }

}
