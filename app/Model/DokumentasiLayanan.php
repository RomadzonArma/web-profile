<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DokumentasiLayanan extends Model
{
    use SoftDeletes;
    protected $table = "dokumentasi_layanan";
    protected $guarded = ["id"];

    /**
     * Get all of the ref_galeri for the Galeri
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function refDokumentasiLayanan()
    {
        return $this->hasMany(RefDokumentasiLayanan::class, 'id_dokumentasi_layanan', 'id');
    }
    public function list_kategori()
    {
        return $this->belongsTo('App\Model\ListKategori','id_kategori','id');
    }
}
