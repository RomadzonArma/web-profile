<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Webinar extends Model
{
    use SoftDeletes;
    protected $table = 'ref_webinar';

    protected $guarded = ['id'];

    public function list_kategori()
    {
        return $this->belongsTo('App\Model\ListKategori','id_kategori','id');
    }
}
