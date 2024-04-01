<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RefTas extends Model
{
    protected $table="ref_tas";
    protected $guarded =['id'];

    /**
     * Get the tas that owns the RefTas
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tas(): BelongsTo
    {
        return $this->belongsTo(Tas::class, 'id_tas', 'id');
    }
}
