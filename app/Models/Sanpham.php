<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sanpham extends Model
{
    use HasFactory;
    protected $table = 'sanphams';
    protected $fillable = ['tensp', 'slug', 'danh_muc_id', 'anhsp', 'color_id', 'gia_goc', 'gia_km_phan_tram', 'mo_ta', 'mota_chitiet'];

    // Mối quan hệ với comments
    public function comments()
    {
        return $this->hasMany(Comment::class, 'san_pham_id');
    }

    public function danhmuc()
    {
        return $this->belongsTo(Danhmuc::class, 'danh_muc_id');
    }

    // Tính trung bình số sao
    public function getAverageRatingAttribute()
    {
        return $this->comments()->avg('rating') ?? 0; // Nếu không có đánh giá, trả về 0
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function anhs()
    {
        return $this->hasMany(Anh::class, 'san_pham_id');
    }
}
