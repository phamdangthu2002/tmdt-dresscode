<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    protected $table = 'sizes';
    protected $fillable = ['ten', 'slug'];

    public function sanphams()
    {
        return $this->belongsToMany(Sanpham::class, 'size_sanpham', 'size_id', 'san_pham_id');
    }

    public function sizesp()
    {
        return $this->hasMany(SizeSP::class, 'size_id');
    }

}
