<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SptPph21HasDokumen extends Model
{
    use SoftDeletes;
    protected $table = 'spt_pph_21_has_dokumen';
    protected $guarded = ['id'];

    public function spt_pph_21()
    {
        return $this->belongsTo(SptPph21::class, 'id_ref', 'id');
    }
}
