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


    public function list_kategori()
    {
        return $this->belongsTo('App\Model\ListKategori','id_kategori','id');
    }
}
