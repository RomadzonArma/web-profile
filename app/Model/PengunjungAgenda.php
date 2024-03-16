<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PengunjungAgenda extends Model
{
    protected $table = 'pengunjung_agenda';

    protected $fillable = [
        'ip_address', 'user_agent', 'id_agenda',
    ];

    public static function hitungPengunjungAgenda($id_agenda)
    {
        return self::where('id_agenda', $id_agenda)->count();
    }
}
