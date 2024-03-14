<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PengunjungArtikel extends Model
{
    protected $table = 'pengunjung_artikel';

    protected $fillable = [
        'ip_address', 'user_agent', 'id_artikel',
    ];

    public static function hitungPengunjungArtikel($id_artikel)
    {
        return self::where('id_artikel', $id_artikel)->count();
    }
}
