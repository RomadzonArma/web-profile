<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PengunjungMaklumat extends Model
{
    protected $table = 'pengunjung_maklumat';

    protected $fillable = [
        'ip_address', 'user_agent', 'id_maklumat',
    ];

    public static function hitungPengunjungMaklumat($id_maklumat)
    {
        return self::where('id_maklumat', $id_maklumat)->count();
    }
}
