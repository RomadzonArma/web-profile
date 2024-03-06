<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Podcast extends Model
{
    use SoftDeletes;
    protected $table = 'ref_podcast';

    protected $guarded = ['id'];
}
