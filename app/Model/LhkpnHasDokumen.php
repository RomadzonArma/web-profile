<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LhkpnHasDokumen extends Model
{
    use SoftDeletes;
    protected $table = 'lhkpn_has_dokumen';
    protected $guarded = ['id'];

    public function spt_pph_21()
    {
        return $this->belongsTo(Lhkpn::class, 'id_ref', 'id');
    }
}
