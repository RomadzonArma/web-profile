<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RefGaleri extends Model
{
    protected $table= 'ref_galeri';
    protected $guarded = ['id'];

    protected $fillable = [
        'id_galeri',
        'image'
    ];
}
