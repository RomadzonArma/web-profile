<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use SoftDeletes;
    protected $table = 'ref_faq';

    protected $guarded = ['id'];


    public function user()
    {
        return $this->belongsTo('App\User','id_user','id');
    }

    public function keperluan_faq()
    {
        return $this->belongsTo('App\Model\KeperluanFaq','id_keperluan_faq','id');
    }

    public function kategori_faq()
    {
        return $this->belongsTo('App\Model\KategoriFaq','id_kategori_faq','id');
    }

}
