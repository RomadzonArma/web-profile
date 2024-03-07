<?php

namespace App\Model;

use App\Model\Panduan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ListKategori extends Model
{
    use SoftDeletes;
    protected $table = 'ref_kategori';

    protected $guarded = ['id'];

    public function list_kanal()
    {
        return $this->belongsTo('App\Model\ListKanal','id_kanal','id');
    }

    public function list_berita()
    {
        return $this->hasMany('App\Model\ListBerita');
    }

    public function list_agenda()
    {
        return $this->hasMany('App\Model\Agenda');
    }

    public function webinar()
    {
        return $this->hasMany('App\Model\Webinar');
    }

    public function unduhan(): HasMany
    {
        return $this->hasMany(Unduhan::class);
    }

    public function program_layanan()
    {
        return $this->hasMany('App\Model\Webinar');
    }

    public function informasi_publik()
    {
        return $this->hasMany('App\Model\Informasi_publik');
    }

    public function pengumuman()
    {
        return $this->hasMany('App\Model\Pengumuman');
    }

    public function panduan(): HasMany
    {
        return $this->hasMany(Panduan::class);
    }

    public function tautan()
    {
        return $this->hasMany('App\Model\Tautan');
    }

}

