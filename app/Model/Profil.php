<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profil extends Model
{
    use SoftDeletes;
    protected $table = 'profil';

    protected $fillable = [
        'judul',
        'kategori',
        'konten',
        'is_active',
    ];

    public function list_kategori()
    {
        return $this->belongsTo('App\Model\ListKategori','id_kategori','id');
    }

    public function list_kanal()
    {
        return $this->belongsTo('App\Model\ListKanal','id_kanal','id');
    }
}
