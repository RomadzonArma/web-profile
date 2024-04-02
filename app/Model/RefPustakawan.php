<?php

namespace App\Model;

use App\Model\Pustakawan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RefPustakawan extends Model
{
    protected $table= 'ref_pustakawan';
    protected $guarded = ['id'];

    /**
     * Get the pustakawan that owns the RefPustakawan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pustakawan(): BelongsTo
    {
        return $this->belongsTo(Pustakawan::class, 'id_pustakawan', 'id');
    }
}
