<?php

namespace App\Http\Controllers\Front;

use App\Model\Pengunjung;
use App\Model\Sosmed;
use App\Model\Swiper;
use App\Model\Panduan;
use App\Model\Unduhan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LandingController extends Controller
{
    public function index()
    {
        $swiper = Swiper::where('is_active', '1')
            ->orderByDesc('created_at')
            ->take(4)
            ->get();
        $ref_sosmed = Sosmed::first();
        return view('contents.Front.index', [
            // return view('layouts.front.app', [
            'title' => 'Beranda',
            'swiper' => $swiper,
            'ref_sosmed' => $ref_sosmed,
            'pengunjung' => $this->recordPengunjung(request())
        ]);
    }

    public function recordPengunjung(Request $request)
    {
        $ipAddress = $request->ip();
        $userAgent = uniqid() . '-' . $request->header('User-Agent');

        Pengunjung::create([
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
        ]);

        return response()->json(['success' => true]);
    }

    public function visi_misi()
    {
        $ref_sosmed = Sosmed::first();
        return view('contents.Front.profil.visi_misi', [
            'title' => 'Visi dan Misi',
            'ref_sosmed' => $ref_sosmed,
        ]);
    }

    public function berita()
    {
        $ref_sosmed = Sosmed::first();
        return view('contents.Front.informasi_publik.berita', [
            'title' => 'Berita',
            'ref_sosmed' => $ref_sosmed,
        ]);
    }

    public function detail()
    {
        $ref_sosmed = Sosmed::first();
        return view('contents.Front.informasi_publik.detail', [
            'title' => 'Berita',
            'ref_sosmed' => $ref_sosmed,
        ]);
    }

    public function galeri()
    {
        $ref_sosmed = Sosmed::first();
        return view('contents.Front.informasi_publik.galeri', [
            'title' => 'Galeri',
            'ref_sosmed' => $ref_sosmed,
        ]);
    }

    public function agenda()
    {
        $ref_sosmed = Sosmed::first();
        return view('contents.Front.menu_halaman.publikasi.agenda', [
            'title' => 'Agenda',
            'ref_sosmed' => $ref_sosmed,
        ]);
    }

    public function unduhan()
    {
        $ref_sosmed = Sosmed::first();
        $unduhan = Unduhan::all();
        foreach ($unduhan as $item) {
            $item->increment('jumlah_download');
        }
        return view('contents.Front.menu_halaman.publikasi.unduhan', [
            'title' => 'Unduhan',
            'ref_sosmed' => $ref_sosmed,
            'unduhan' => $unduhan,
        ]);
    }
    public function panduan()
    {
        $ref_sosmed = Sosmed::first();
        $panduan = Panduan::all();
        // foreach ($panduan as $item) {
        //     $item->increment('jumlah_download');
        // }
        return view('contents.Front.menu_halaman.publikasi.panduan', [
            'title' => 'Unduhan',
            'ref_sosmed' => $ref_sosmed,
            'panduan' => $panduan,
        ]);
    }
    public function panduanDetail($id)
    {
        $ref_sosmed = Sosmed::first();
        $panduan = Panduan::where('id',$id)->first();
        return view('contents.Front.menu_halaman.publikasi.panduan-detail', [
            'title' => 'Unduhan',
            'ref_sosmed' => $ref_sosmed,
            'panduan' => $panduan,
        ]);
    }
}
