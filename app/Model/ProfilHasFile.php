<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfilHasFile extends Model
{
    use SoftDeletes;
    protected $table = 'profil_has_file';

    protected $fillable = [
        'profil_id',
        'path',
        'file'
    ];
}
