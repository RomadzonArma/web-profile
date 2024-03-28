<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Harlindung extends Model
{
    use SoftDeletes;
    protected $table = 'harlindung';
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
}
