<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PengunjungRegulasi extends Model
{
    protected $table = 'pengunjung_regulasi';

    protected $fillable = [
        'ip_address', 'user_agent', 'id_regulasi',
    ];

    public static function hitungPengunjungRegulasi($id_regulasi)
    {
        return self::where('id_regulasi', $id_regulasi)->count();
    }
}
