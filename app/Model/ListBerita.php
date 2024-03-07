<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListBerita extends Model
{
    use SoftDeletes;
    protected $table = 'ref_berita';

    protected $guarded = ['id'];

    public function list_kategori()
    {
        return $this->belongsTo('App\Model\ListKategori','id_kategori','id');
    }

    public function user()
    {
        return $this->belongsTo('App\user','id_penulis','id');
    }
}
