<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tas extends Model
{
    use SoftDeletes;
    protected $table="tas";
    protected $guarded = ['id'];

    public function reftas(): HasMany
    {
        return $this->hasMany(RefTas::class, 'id_tas','id');
    }
}
