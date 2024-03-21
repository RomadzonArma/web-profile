<?php

namespace App\Model;

use App\Model\ListKategori;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Akuntabilitas extends Model
{
    use SoftDeletes;

    protected $table = 'akuntabilitas';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(ListKategori::class, 'id_kategori', 'id');
    }
    public function sub()
    {
        return $this->belongsTo('App\Model\SubKategori','id_sub','id');
    }
}
