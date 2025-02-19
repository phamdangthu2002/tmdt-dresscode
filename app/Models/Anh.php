<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anh extends Model
{
    use HasFactory;
    protected $table = 'anhs';
    protected $fillable = ['ten_anh', 'san_pham_id', 'url'];

    public function sanpham()
    {
        return $this->belongsTo(Sanpham::class, 'san_pham_id');
    }

    public function getUrlAttribute($value)
    {
        return asset('storage/' . $value);
    }
}
