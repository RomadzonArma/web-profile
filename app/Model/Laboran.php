<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Laboran extends Model
{
    use SoftDeletes;
    protected $table= "laboran";
    protected $guarded = ['id'];

    /**
     * Get all of the reflaboran for the Laboran
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reflaboran(): HasMany
    {
        return $this->hasMany(RefLaboran::class, 'id_laboran', 'id');
    }
}
