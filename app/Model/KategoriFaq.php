<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriFaq extends Model
{
    use SoftDeletes;
    protected $table = 'ref_kategori_faq';

    protected $guarded = ['id'];


    public function faq()
    {
        return $this->hasMany('App\Model\Faq');
    }

}
