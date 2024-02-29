<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Swiper extends Model
{
    use SoftDeletes;

    protected $table = 'swiper';
    protected $primaryKey = 'id';

    protected $fillable = [
        'judul',
        'desc',
        'link',
        'foto',
        'is_active',
        'urutan',
    ];

    protected $casts = [
        'created_at' => 'datetime'
    ];
}
