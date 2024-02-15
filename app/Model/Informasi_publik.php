<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Informasi_publik extends Model
{
    use SoftDeletes;
    protected $table = 'informasi_publik';

    protected $fillable = [
        'judul',
        'kategori',
        'konten',
        'is_active',
    ];
}
