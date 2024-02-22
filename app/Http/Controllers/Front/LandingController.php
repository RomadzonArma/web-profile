<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        return view('contents.Front.index', [
        // return view('layouts.front.app', [
            'title' => 'Beranda'
        ]);
    }

    public function visi_misi()
    {
        return view('contents.Front.visi_misi', [
            'title' => 'Visi dan Misi'
        ]);
    }

    public function berita()
    {
        return view('contents.Front.berita', [
            'title' => 'Berita'
        ]);
    }

    public function galeri()
    {
        return view('contents.Front.galeri', [
            'title' => 'Galeri'
        ]);
    }

    public function agenda()
    {
        return view('contents.Front.agenda', [
            'title' => 'Agenda'
        ]);
    }

    public function unduhan()
    {
        return view('contents.Front.unduhan', [
            'title' => 'Unduhan'
        ]);
    }
}
