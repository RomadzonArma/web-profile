<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ZiWbk extends Model
{
    use SoftDeletes;
    protected $table = 'ziwbk';

    protected $guarded = ['id'];

    public function list_kategori()
    {
        return $this->belongsTo('App\Model\ListKategori','id_kategori','id');
    }
    public function sub_kategori()
    {
        return $this->belongsTo('App\Model\SubKategori','id_subkategori','id');
    }

}
