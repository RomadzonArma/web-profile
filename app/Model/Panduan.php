<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Panduan extends Model
{
    protected $table = 'panduan';
    protected $guarded = ['id'];


    public function kategori(): BelongsTo
    {
        return $this->belongsTo(ListKategori::class, 'id_kategori', 'id');
    }

}
