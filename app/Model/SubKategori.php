<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubKategori extends Model
{
    use SoftDeletes;
    protected $table = 'ref_subkategori';

    protected $guarded = ['id'];

    public function list_kategori()
    {
        return $this->belongsTo('App\Model\ListKategori','id_kategori','id');
    }
    public function zi_wbk()
    {
        return $this->belongsTo('App\Model\ZiWbk','id_subkategori','id');
    }

}
