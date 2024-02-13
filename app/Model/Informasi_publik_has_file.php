<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Informasi_publik_has_file extends Model
{
    use SoftDeletes;
    protected $table = 'informasi_publik_has_file';

    protected $fillable = [
        'informasi_publik_id',
        'path',
        'file'
    ];
}
