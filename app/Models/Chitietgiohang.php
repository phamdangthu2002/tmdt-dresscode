<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chitietgiohang extends Model
{
    use HasFactory;
    protected $table = 'chitietgiohangs';
    protected $fillable = ['gio_hang_id', 'san_pham_id', 'size_id', 'so_luong', 'gia'];

    public function giohang()
    {
        return $this->belongsTo(Giohang::class, 'gio_hang_id');
    }
    public function sanpham()
    {
        return $this->belongsTo(Sanpham::class, 'san_pham_id');
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }

}
