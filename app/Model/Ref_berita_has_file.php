<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ref_berita_has_file extends Model
{
    use SoftDeletes;
    protected $table = 'ref_berita_has_file';


    protected $guarded = ['id'];
}
