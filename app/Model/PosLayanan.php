<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PosLayanan extends Model
{
    use SoftDeletes;
    protected $table = 'ref_pos_layanan';

    protected $guarded = ['id'];
}
