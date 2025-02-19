<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SizeSP extends Model
{
    use HasFactory;
    protected $table = 'size_sp';
    protected $fillable = ['size_id', 'san_pham_id'];

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }
    public function sanpham()
    {
        return $this->belongsTo(Sanpham::class, 'san_pham_id');
    }

    public function getTenSizeAttribute()
    {
        return $this->size->ten;
    }
    public function getSlugSizeAttribute()
    {
        return $this->size->slug;
    }
}
