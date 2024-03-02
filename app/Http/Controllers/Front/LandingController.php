<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Model\Swiper;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $swiper = Swiper::where('is_active', "1")
        ->get();
        return view('contents.Front.index', [
        // return view('layouts.front.app', [
            'title' => 'Beranda',
            'swiper' => $swiper,
        ]);
    }

    public function visi_misi()
    {
        return view('contents.Front.profil.visi_misi', [
            'title' => 'Visi dan Misi'
        ]);
    }

    public function berita()
    {
        return view('contents.Front.informasi_publik.berita', [
            'title' => 'Berita'
        ]);
    }

    public function detail()
    {
        return view('contents.Front.informasi_publik.detail', [
            'title' => 'Berita'
        ]);
    }

    public function galeri()
    {
        return view('contents.Front.informasi_publik.galeri', [
            'title' => 'Galeri'
        ]);
    }

    public function agenda()
    {
        return view('contents.Front.menu_halaman.publikasi.agenda', [
            'title' => 'Agenda'
        ]);
    }

    public function unduhan()
    {
        return view('contents.Front.menu_halaman.publikasi.unduhan', [
            'title' => 'Unduhan'
        ]);
    }
}
