<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $fillable = ['san_pham_id', 'user_id', 'comment', 'rating'];

    public function sanpham()
    {
        return $this->belongsTo(Sanpham::class, 'san_pham_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getRatingAttribute()
    {
        return $this->rating;
    }

    public function getCreatedAtAttribute()
    {
        return $this->created_at->format('d/m/Y H:i');
    }

    public function getUpdatedAtAttribute()
    {
        return $this->updated_at->format('d/m/Y H:i');
    }

    public function getRatingStarAttribute()
    {
        $rating = $this->rating;
        $star = '';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $rating) {
                $star .= '<i class="fas fa-star text-warning"></i>';
            } else {
                $star .= '<i class="far fa-star text-warning"></i>';
            }
        }
        return $star;
    }
}
