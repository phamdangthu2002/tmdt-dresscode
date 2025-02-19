<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sanpham extends Model
{
    use HasFactory;
    protected $table = 'sanphams';
    protected $fillable = ['tensp', 'slug', 'danh_muc_id', 'anhsp', 'gia_goc', 'gia_km_phan_tram', 'mota'];

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
}
