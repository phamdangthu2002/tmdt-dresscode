<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorSP extends Model
{
    use HasFactory;
    protected $table = 'color_sp';
    protected $fillable = ['color_id', 'san_pham_id'];

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
    public function sanpham()
    {
        return $this->belongsTo(Sanpham::class, 'san_pham_id');
    }
}
