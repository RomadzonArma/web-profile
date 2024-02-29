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


    public function list_berita()
    {
        return $this->hasMany('App\Model\ListBerita');
    }

    public function list_agenda()
    {
        return $this->hasMany('App\Model\Agenda');
    }
}
