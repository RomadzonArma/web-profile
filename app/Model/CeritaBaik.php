<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CeritaBaik extends Model
{
    use SoftDeletes;

    protected $table = 'cerita';
    protected $primaryKey = 'id';
    protected $guarded = ["id"];

    // protected $fillable = [
    //     'judul',
    //     'desc',
    //     'link',
    //     'foto',
    //     'is_active',
    //     'urutan',
    // ];

    protected $casts = [
        'created_at' => 'datetime'
    ];
}
