<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubKategori extends Model
{
    use SoftDeletes;
    protected $table = 'ref_subkategori';
    protected $fillable = ['id_kategori', 'sub_kategori', 'link_kategori','status_publish'];
    protected $guarded = ['id'];

    public function list_kategori()
    {
        return $this->belongsTo('App\Model\ListKategori','id_kategori','id');
    }
    public function ziWbks()
    {
        return $this->hasMany(ZiWbk::class, 'id_subkategori');
    }

}
