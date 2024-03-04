<?php

namespace App\Http\Controllers\Front;

use App\Model\Agenda;
use App\Model\Sosmed;
use App\Model\Swiper;
use App\Model\Panduan;
use App\Model\Unduhan;
use App\Model\Regulasi;
use App\Model\Pengumuman;
use App\Model\Pengunjung;
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
        $agenda = Agenda::all();
        return view('contents.Front.menu_halaman.publikasi.agenda', [
            'title' => 'Agenda',
            'agenda' => $agenda,
        ]);
    }
    public function agendaDetail($id)
    {
        $agenda = Agenda::where('id',$id)->first();
        return view('contents.Front.menu_halaman.publikasi.agenda-detail', [
            'title' => 'Agenda Detail',
            'agenda' => $agenda,
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
            'title' => 'Panduan',
            'ref_sosmed' => $ref_sosmed,
            'panduan' => $panduan,
        ]);
    }
    public function panduanDetail($id)
    {
        $panduan = Panduan::where('id',$id)->first();
        return view('contents.Front.menu_halaman.publikasi.panduan-detail', [
            'title' => 'Panduan Detail',
            'panduan' => $panduan,
        ]);
    }
    //start pengumuman
    public function pengumuman()
    {
        $ref_sosmed = Sosmed::first();
        $pengumuman = Pengumuman::all();
        // foreach ($panduan as $item) {
        //     $item->increment('jumlah_download');
        // }
        return view('contents.Front.menu_halaman.publikasi.pengumuman', [
            'title' => 'Pengumuman',
            'ref_sosmed' => $ref_sosmed,
            'pengumuman' => $pengumuman,
        ]);
    }
    public function pengumumanDetail($id)
    {
        $ref_sosmed = Sosmed::first();
        $pengumuman = Pengumuman::where('id',$id)->first();
        return view('contents.Front.menu_halaman.publikasi.pengumuman-detail', [
            'title' => 'Pengumuman Detail',
            'ref_sosmed' => $ref_sosmed,
            'pengumuman' => $pengumuman,
        ]);
    }

    //end pengumuman
    public function regulasi()
    {
        $ref_sosmed = Sosmed::first();
        $regulasi = Regulasi::all();
        // foreach ($panduan as $item) {
        //     $item->increment('jumlah_download');
        // }
        return view('contents.Front.menu_halaman.publikasi.regulasi', [
            'title' => 'Regulasi',
            'ref_sosmed' => $ref_sosmed,
            'regulasi' => $regulasi,
        ]);
    }
    public function regulasiDetail($id)
    {
        $ref_sosmed = Sosmed::first();
        $regulasi = Regulasi::where('id',$id)->first();
        return view('contents.Front.menu_halaman.publikasi.regulasi-detail', [
            'title' => 'Regulasi Detail',
            'ref_sosmed' => $ref_sosmed,
            'regulasi' => $regulasi,
        ]);
    }


}
