<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
class Pengunjung extends Model
{
    protected $table = 'pengunjung';

    protected $fillable = [
        'ip_address', 'user_agent', 'flag',
    ];
}
