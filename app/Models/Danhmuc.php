<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Danhmuc extends Model
{
    use HasFactory;
    protected $table = 'danhmuc';
    protected $fillable = ['tendanhmuc', 'slug', 'parent_id'];

    public function sanphams()
    {
        return $this->hasMany(Sanpham::class, 'danh_muc_id');
    }

    public function parent()
    {
        return $this->belongsTo(Danhmuc::class, 'parent_id');
    }
}
