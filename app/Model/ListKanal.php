<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListKanal extends Model
{
    use SoftDeletes;
    protected $table = 'ref_kanal';

    protected $guarded = ['id'];


    public function list_kategori()
    {
        return $this->hasMany('App\Model\Listkategori', 'id_kanal' , 'id');
    }

    public function list_berita()
    {
        return $this->hasMany('App\Model\ListBerita');
    }
}
