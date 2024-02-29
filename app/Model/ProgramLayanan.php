<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgramLayanan extends Model
{
    use SoftDeletes;
    protected $table = 'program_layanan';
    protected $guarded = ['id'];


    public function kanal(): BelongsTo
    {
        return $this->belongsTo(ListKanal::class, 'kanal_id', 'id');
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(ListKategori::class, 'kategori_id', 'id');
    }
}
