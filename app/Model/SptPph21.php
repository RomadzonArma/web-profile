<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SptPph21 extends Model
{
    use SoftDeletes;
    protected $table = 'spt_pph_21';
    protected $guarded = ['id'];

    public function dokumen()
    {
        return $this->hasMany(SptPph21HasDokumen::class, 'id_ref', 'id');
    }
}
