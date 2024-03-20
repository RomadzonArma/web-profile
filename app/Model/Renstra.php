<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Renstra extends Model
{
    use SoftDeletes;
    protected $table = "renstra";
    protected $guarded = ["id"];

    /**
     * Get the kategori that owns the Renstra
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(ListKategori::class, 'id_kategori', 'id');
    }
}
