<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Berprestasi extends Model
{
    use SoftDeletes;

    protected $table = 'kspstk_berprestasi';
    protected $primaryKey = 'id';

    protected $fillable = [
        'judul',
        'desc',
        'link',
        'foto',
        'video',
        'is_active',
        'urutan',
        'file_pdf',
        'foto_praktik'
    ];

    protected $casts = [
        'created_at' => 'datetime'
    ];
}
