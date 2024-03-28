<?php

namespace App\Model;

use App\Model\Maklumatimage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Maklumat extends Model
{
    use SoftDeletes;
    protected $table ='ref_maklumat';
    protected $guarded = ['id'];

    public function image()
    {
        return $this->hasMany(Maklumatimage::class, 'id_galeri', 'id');
    }
}
