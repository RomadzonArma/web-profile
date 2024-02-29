<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sosmed extends Model
{
    use SoftDeletes;
    protected $table = 'ref_sosmed';

    protected $guarded = ['id'];
}
