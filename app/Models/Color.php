<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $table = 'colors';
    protected $fillable = ['ten', 'slug'];

    public function sanphams()
    {
        return $this->belongsToMany(Sanpham::class, 'color_sp', 'color_id', 'san_pham_id');
    }

    public function colorsp()
    {
        return $this->hasMany(ColorSP::class, 'color_id');
    }
}
