<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RefDokumentasiLayanan extends Model
{
    protected $table= 'ref_dokumentasi_layanan';
    protected $guarded = ['id'];

    // protected $fillable = [
    //     'id_dokumentasi_layanan',
    //     'image'
    // ];

    public function dokumentasiLayanan()
    {
        return $this->belongsTo(DokumentasiLayanan::class, 'dokumentasi_layanan_id', 'id');
    }
}
