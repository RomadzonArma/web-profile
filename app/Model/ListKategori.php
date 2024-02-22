<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListKategori extends Model
{
    use SoftDeletes;
    protected $table = 'ref_kategori';

    protected $guarded = ['id'];

    public function list_kanal()
    {
        return $this->belongsTo('App\Model\ListKanal','id_kanal','id');
    }
}
