<?php

namespace App\Model;

use App\Model\RefPustakawan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pustakawan extends Model
{
    use SoftDeletes;
    protected $table = 'pustakawan';
    protected $guarded = ['id'];

    /**
     * Get all of the ref_pustakawan for the Pustakawan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ref_pustakawan(): HasMany
    {
        return $this->hasMany(RefPustakawan::class, 'id_pustakawan', 'id');
    }
}
