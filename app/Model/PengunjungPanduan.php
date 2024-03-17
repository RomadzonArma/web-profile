<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PengunjungPanduan extends Model
{
    protected $table = 'pengunjung_panduan';

    protected $fillable = [
        'ip_address', 'user_agent', 'id_panduan',
    ];

    public static function hitungPengunjungPanduan($id_panduan)
    {
        return self::where('id_panduan', $id_panduan)->count();
    }
}
