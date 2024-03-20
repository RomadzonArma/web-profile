<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Akuntabilitas extends Model
{
    use SoftDeletes;

    protected $table = 'akuntabilitas';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];


    public function sub()
    {
        return $this->belongsTo('App\Model\SubKategori','id_sub','id');
    }
}
