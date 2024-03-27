<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CeritaBaik extends Model
{
    use SoftDeletes;

    protected $table = 'cerita';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    protected $casts = [
        'created_at' => 'datetime'
    ];
}
