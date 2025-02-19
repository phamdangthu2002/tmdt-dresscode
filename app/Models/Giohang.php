<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Giohang extends Model
{
    use HasFactory;
    protected $table = 'giohangs';
    protected $fillable = ['user_id', 'ngay_them', 'trang_thai'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function chitietgiohangs()
    {
        return $this->hasMany(Chitietgiohang::class, 'gio_hang_id');
    }

    public function getTongTienAttribute()
    {
        $tong = 0;
        foreach ($this->chitietgiohangs as $item) {
            $tong += $item->tong;
        }
        return $tong;
    }

    public function getTongSanPhamAttribute()
    {
        $tong = 0;
        foreach ($this->chitietgiohangs as $item) {
            $tong += $item->soluong;
        }
        return $tong;
    }
}
