<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PraktikBaik extends Model
{
    use SoftDeletes;

    protected $table = 'praktik_baik';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    // protected $fillable = [
    //     'judul',
    //     'link_video',
    //     'video',
    //     'foto',
    //     'is_active',
    //     'konten',
    // ];
    protected $casts = [
        'created_at' => 'datetime'
    ];

}
