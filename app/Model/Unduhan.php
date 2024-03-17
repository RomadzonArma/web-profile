<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Unduhan extends Model
{
    protected $table = 'unduhan';
    protected $guarded = ['id'];
// protected $fillable = ['jumlah_download',];
    /**
     * Get the kanal that owns the Unduhan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    // public function kanal(): BelongsTo
    // {
    //     return $this->belongsTo(ListKanal::class, 'id_kanal', 'id');
    // }
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(ListKategori::class, 'id_kategori', 'id');
    }

}
