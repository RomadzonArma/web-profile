<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PengunjungPengumuman extends Model
{
    protected $table = 'pengunjung_pengumuman';

    protected $fillable = [
        'ip_address', 'user_agent', 'id_pengumuman',
    ];

    public static function hitungPengunjungPengumuman($id_pengumuman)
    {
        return self::where('id_pengumuman', $id_pengumuman)->count();
    }
}
