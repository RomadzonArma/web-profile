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
        return view('contents.Front.index', [
            'title' => 'Beranda',
            'swiper' => $swiper,
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
        return view('contents.Front.profil.visi_misi', [
            'title' => 'Visi dan Misi',
        ]);
    }

    public function berita()
    {
        return view('contents.Front.informasi_publik.berita', [
            'title' => 'Berita',
        ]);
    }

    public function detail()
    {
        return view('contents.Front.informasi_publik.detail', [
            'title' => 'Berita',
        ]);
    }

    public function galeri()
    {
        return view('contents.Front.informasi_publik.galeri', [
            'title' => 'Galeri',
        ]);
    }

    public function agenda()
    {
        return view('contents.Front.menu_halaman.publikasi.agenda', [
            'title' => 'Agenda',
        ]);
    }

    public function unduhan()
    {
        $unduhan = Unduhan::all();
        foreach ($unduhan as $item) {
            $item->increment('jumlah_download');
        }
        return view('contents.Front.menu_halaman.publikasi.unduhan', [
            'title' => 'Unduhan',
            'unduhan' => $unduhan,
        ]);
    }
    public function panduan()
    {
        $panduan = Panduan::all();
        // foreach ($panduan as $item) {
        //     $item->increment('jumlah_download');
        // }
        return view('contents.Front.menu_halaman.publikasi.panduan', [
            'title' => 'Unduhan',
            'panduan' => $panduan,
        ]);
    }
    public function panduanDetail($id)
    {
        $panduan = Panduan::where('id',$id)->first();
        return view('contents.Front.menu_halaman.publikasi.panduan-detail', [
            'title' => 'Unduhan',
            'panduan' => $panduan,
        ]);
    }
}
