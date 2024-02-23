<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListBerita extends Model
{
    use SoftDeletes;
    protected $table = 'ref_berita';

    protected $guarded = ['id'];
}
