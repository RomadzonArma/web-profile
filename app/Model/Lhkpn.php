<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lhkpn extends Model
{
    use SoftDeletes;
    protected $table = 'lhkpn';
    protected $guarded = ['id'];

    public function dokumen()
    {
        return $this->hasMany(LhkpnHasDokumen::class, 'id_ref', 'id');
    }
}
