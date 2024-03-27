<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KeperluanFaq extends Model
{
    use SoftDeletes;
    protected $table = 'ref_keperluan_faq';

    protected $guarded = ['id'];


    public function faq()
    {
        return $this->hasMany('App\Model\Faq');
    }

}
