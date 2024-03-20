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

}
