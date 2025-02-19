<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trangthai extends Model
{
    use HasFactory;
    protected $table = 'trangthais';
    protected $fillable = ['ten_trang_thai', 'slug', 'mo_ta'];

    public function sanphams()
    {
        return $this->hasMany(Sanpham::class, 'trang_thai_id');
    }

    public function chitietdonhangs()
    {
        return $this->hasMany(Chitietdonhang::class, 'trang_thai_id');
    }
}
