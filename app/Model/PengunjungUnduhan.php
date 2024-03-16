<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PengunjungUnduhan extends Model
{
    protected $table = 'pengunjung_unduhan';

    protected $fillable = [
        'ip_address', 'user_agent', 'id_unduhan',
    ];

    public static function hitungPengunjungUnduhan($id_unduhan)
    {
        return self::where('id_unduhan', $id_unduhan)->count();
    }
}
