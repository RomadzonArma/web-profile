<?php

namespace App\Model;

use App\Model\Maklumat;
use Illuminate\Database\Eloquent\Model;

class Maklumatimage extends Model
{
    protected $table = 'maklumat_image';
    protected $guarded = ['id'];

    public function maklumat()
    {
        return $this->belongsTo(Maklumat::class, 'id_maklumat', 'id');
    }
}
