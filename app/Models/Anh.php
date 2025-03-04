<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anh extends Model
{
    use HasFactory;
    protected $table = 'anhs';
    protected $fillable = ['san_pham_id', 'url_anh'];

    public function sanpham()
    {
        return $this->belongsTo(Sanpham::class, 'san_pham_id');
    }

    // public function getUrlAttribute($value)
    // {
    //     return asset('storage/' . $value);
    // }
}
