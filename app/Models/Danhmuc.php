<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Danhmuc extends Model
{
    use HasFactory;
    protected $table = 'danhmucs';
    protected $fillable = ['ten_danh_muc', 'mo_ta','hinh_anh', 'danh_muc_id','trang_thai'];

    public function sanphams()
    {
        return $this->hasMany(Sanpham::class, 'danh_muc_id');
    }

    public function parent()
    {
        return $this->belongsTo(Danhmuc::class, 'parent_id');
    }
}
