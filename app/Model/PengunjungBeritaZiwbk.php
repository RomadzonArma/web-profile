<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PengunjungBeritaZiwbk extends Model
{
    protected $table = 'pengunjung_berita_ziwbk';

    protected $fillable = [
        'ip_address', 'user_agent', 'id_berita_ziwbk',
    ];

    public static function hitungPengunjungBeritaZiwbk($id_berita_ziwbk)
    {
        return self::where('id_berita_ziwbk', $id_berita_ziwbk)->count();
    }
}
