<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PengunjungBerita extends Model
{
    protected $table = 'pengunjung_berita';

    protected $fillable = [
        'ip_address', 'user_agent', 'id_berita',
    ];

    public static function hitungPengunjungBerita($id_berita)
    {
        return self::where('id_berita', $id_berita)->count();
    }
}
