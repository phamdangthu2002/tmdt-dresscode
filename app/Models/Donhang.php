<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donhang extends Model
{
    use HasFactory;
    protected $table = 'donhangs';
    protected $fillable = ['user_id', 'ngay_dat_hang', 'tong'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function chitietdonhangs()
    {
        return $this->hasMany(Chitietdonhang::class, 'don_hang_id');
    }
    public function getCreatedAtAttribute()
    {
        return $this->created_at->format('d/m/Y H:i');
    }
    public function getUpdatedAtAttribute()
    {
        return $this->updated_at->format('d/m/Y H:i');
    }
}
