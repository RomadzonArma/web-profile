<?php

namespace App\Http\Controllers\Front;

use App\Model\Agenda;
use App\Model\Swiper;
use App\Model\Panduan;
use App\Model\Unduhan;
use App\Model\Regulasi;
use App\Model\ListBerita;
use App\Model\Pengumuman;
use App\Model\Pengunjung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Model\ProgramLayanan;

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
        $berita  = ListBerita::where('status_publish', '1')->get();
        return view('contents.Front.informasi_publik.berita', [
            'title' => 'Berita',
            'berita' => $berita,
        ]);
    }
    public function beritaDetail($id)
    {
        $berita = ListBerita::where('id', $id)->first();
        return view('contents.Front.informasi_publik.berita-detail', [
            'title' => 'Berita',
            'berita' => $berita,
        ]);
    }
    public function artikel()
    {
        $berita  = ListBerita::where('status_publish', '1')->get();
        return view('contents.Front.informasi_publik.berita', [
            'title' => 'Berita',
            'berita' => $berita,
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
    // START MENU PUBLIKASI
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
        $pengumuman = Pengumuman::all();
        // foreach ($panduan as $item) {
        //     $item->increment('jumlah_download');
        // }
        return view('contents.Front.menu_halaman.publikasi.pengumuman', [
            'title' => 'Pengumuman',
            'pengumuman' => $pengumuman,
        ]);
    }
    public function pengumumanDetail($id)
    {
        $pengumuman = Pengumuman::where('id',$id)->first();
        return view('contents.Front.menu_halaman.publikasi.pengumuman-detail', [
            'title' => 'Pengumuman Detail',
            'pengumuman' => $pengumuman,
        ]);
    }

    //end pengumuman
    public function regulasi()
    {
        $regulasi = Regulasi::all();
        // foreach ($panduan as $item) {
        //     $item->increment('jumlah_download');
        // }
        return view('contents.Front.menu_halaman.publikasi.regulasi', [
            'title' => 'Regulasi',
            'regulasi' => $regulasi,
        ]);
    }
    public function regulasiDetail($id)
    {
        $regulasi = Regulasi::where('id',$id)->first();
        return view('contents.Front.menu_halaman.publikasi.regulasi-detail', [
            'title' => 'Regulasi Detail',
            'regulasi' => $regulasi,
        ]);
    }
    //END PUBLIKASI

    //START MENU PROGRAM LAYANAN
    public function sekolahPenggerak()
    {
        $sekolah = DB::table('program_layanan')
            ->join('ref_kategori', 'program_layanan.id_kategori', '=', 'ref_kategori.id')
            ->select('program_layanan.*', 'ref_kategori.nama_kategori')
            ->where('program_layanan.id_kategori', '=', 19)
            ->get();

        return view('contents.Front.menu_halaman.program_layanan.sekolah-penggerak', [
            'title' => 'Pogram Pendidikan Guru Penggerak',
            'sekolah' => $sekolah,
        ]);
    }
    public function sekolahPenggerakDetail($slug)
    {

        $sekolah = ProgramLayanan::where('slug',$slug)->first();
        // dd($sekolah);
        return view('contents.Front.menu_halaman.program_layanan.sekolah-penggerak-detail', [
            'title' => 'Detail Pogram Pendidikan Guru Penggerak ',
            'sekolah' => $sekolah,
        ]);
    }
    public function guruPenggerak()
    {
        $guru = DB::table('program_layanan')
            ->join('ref_kategori', 'program_layanan.id_kategori', '=', 'ref_kategori.id')
            ->select('program_layanan.*', 'ref_kategori.nama_kategori')
            ->where('program_layanan.id_kategori', '=', 20)
            ->get();

        return view('contents.Front.menu_halaman.program_layanan.guru-penggerak', [
            'title' => 'Pogram Pendidikan Guru Penggerak',
            'guru' => $guru,
        ]);
    }
    public function guruPenggerakDetail($slug)
    {
        $guru = ProgramLayanan::where('slug',$slug)->first();
        // dd($guru);
        return view('contents.Front.menu_halaman.program_layanan.guru-penggerak-detail', [
            'title' => 'Detail Pogram Pendidikan Guru Penggerak ',
            'guru' => $guru,
        ]);
    }
}
