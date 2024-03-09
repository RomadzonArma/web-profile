<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Galeri extends Model
{
    use SoftDeletes;
    protected $table = "galeri";
    protected $guarded = ["id"];

    /**
     * Get all of the ref_galeri for the Galeri
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function refGaleri()
    {
        return $this->hasMany(RefGaleri::class, 'id_galeri', 'id');
    }
    public function list_kategori()
    {
        return $this->belongsTo('App\Model\ListKategori','id_kategori','id');
    }
}
