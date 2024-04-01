<?php

namespace App\Model;

use App\Model\Laboran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RefLaboran extends Model
{
    protected $table= "ref_laboran";
    protected $guarded = ['id'];

    /**
     * Get the laboran that owns the RefLaboran
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function laboran(): BelongsTo
    {
        return $this->belongsTo(Laboran::class, 'id_laboran', 'id');
    }
}
