<?php

namespace App\Http\Controllers\Front;

use App\Model\Agenda;
use App\Model\Galeri;
use App\Model\Swiper;
use App\Model\Artikel;
use App\Model\Panduan;
use App\Model\Unduhan;
use App\Model\Regulasi;
use App\Model\ListBerita;
use App\Model\Pengumuman;
use App\Model\Pengunjung;
use Illuminate\Http\Request;
use App\Model\ProgramLayanan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Model\Artikel;
use App\Model\ListKanal;
use App\Model\ListKategori;
use App\Model\Podcast;
use App\Model\Profil;
use App\Model\ProgramFokus;
use App\Model\ProgramLayanan;
use Illuminate\Database\Eloquent\Builder;

class LandingController extends Controller
{


    public function index()
    {
      
        $swiper = Swiper::where('is_active', '1')
            ->orderByDesc('created_at')
            ->take(4)
            ->get();

        $program_fokus = ProgramFokus::where('status', '1')->orderByDesc('created_at')->get();

        $list_kanal_1 = ListKanal::where('status', '1')
            ->where(function ($query) {
                $query->where('nama_kanal', 'LIKE', '%profil%')
                    ->orWhere('nama_kanal', 'LIKE', '%informasi publik%')
                    ->orWhere('nama_kanal', 'LIKE', '%zi/wbk%');
            })
            ->get();

        $list_kanal_2 = ListKanal::where('status', '1')
            ->where(function ($query) {
                $query->where('nama_kanal', 'LIKE', '%program dan layanan%')
                    ->orWhere('nama_kanal', 'LIKE', '%tautan%')
                    ->orWhere('nama_kanal', 'LIKE', '%publikasi%');
            })
            ->get();

        $list_kategori_1 = [];
        foreach ($list_kanal_1 as $kanal_1) {
            $list_kategori_1[$kanal_1->id] = ListKategori::where('id_kanal', $kanal_1->id)->get();
        }

        $list_kategori_2 = [];
        foreach ($list_kanal_2 as $kanal_2) {
            $list_kategori_2[$kanal_2->id] = ListKategori::where('id_kanal', $kanal_2->id)->get();
        }

        return view('contents.Front.index', [
            'title' => 'Beranda',
            'swiper' => $swiper,
            'podcast' => $podcast,
            'program_fokus' => $program_fokus,
            'list_kanal_1' => $list_kanal_1,
            'list_kanal_2' => $list_kanal_2,
            'list_kategori_1' => $list_kategori_1,
            'list_kategori_2' => $list_kategori_2,
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
        $data_visi = Profil::whereHas('list_kategori' , function (Builder $query) {
            $query->where('nama_kategori', 'LIKE', '%visi%')->where('is_active', '1');
        })->get();

        return view('contents.Front.profil.visi_misi', [
            'title' => 'Visi dan Misi',
            'data_visi' => $data_visi,
        ]);
    }

    public function struktur_organisasi()
    {
        $data_struktur = Profil::whereHas('list_kategori' , function (Builder $query) {
            $query->where('nama_kategori', 'LIKE', '%struktur%')->where('is_active', '1');
        })->get();

        return view('contents.Front.profil.struktur_organisasi', [
            'title' => 'Struktur Organisasi',
            'data_struktur' => $data_struktur,
        ]);
    }

    public function tugas_fungsi()
    {
        $data_tugas = Profil::whereHas('list_kategori' , function (Builder $query) {
            $query->where('nama_kategori', 'LIKE', '%tugas%')->where('is_active', '1');
        })->get();

        return view('contents.Front.profil.tugas_fungsi', [
            'title' => 'Tugas & Fungsi ',
            'data_tugas' => $data_tugas,
        ]);
    }

    public function kontak_kami()
    {
        $data_kontak = Profil::whereHas('list_kategori' , function (Builder $query) {
            $query->where('nama_kategori', 'LIKE', '%kontak%')->where('is_active', '1');
        })->get();

        return view('contents.Front.profil.kontak_kami', [
            'title' => 'Kontak Kami',
            'data_kontak' =>  $data_kontak,
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
        $artikel  = Artikel::where('status_publish', '1')->get();

        $list_kanal_1 = ListKanal::where('status', '1')
            ->where(function ($query) {
                $query->where('nama_kanal', 'LIKE', '%profil%')
                    ->orWhere('nama_kanal', 'LIKE', '%informasi publik%')
                    ->orWhere('nama_kanal', 'LIKE', '%zi/wbk%');
            })
            ->get();

        $list_kanal_2 = ListKanal::where('status', '1')
            ->where(function ($query) {
                $query->where('nama_kanal', 'LIKE', '%program dan layanan%')
                    ->orWhere('nama_kanal', 'LIKE', '%tautan%')
                    ->orWhere('nama_kanal', 'LIKE', '%publikasi%');
            })
            ->get();

        $list_kategori_1 = [];
        foreach ($list_kanal_1 as $kanal_1) {
            $list_kategori_1[$kanal_1->id] = ListKategori::where('id_kanal', $kanal_1->id)->get();
        }

        $list_kategori_2 = [];
        foreach ($list_kanal_2 as $kanal_2) {
            $list_kategori_2[$kanal_2->id] = ListKategori::where('id_kanal', $kanal_2->id)->get();
        }

        return view('contents.Front.informasi_publik.artikel', [
            'title' => 'Berita',
            'artikel' => $artikel,
            'list_kanal_1' => $list_kanal_1,
            'list_kanal_2' => $list_kanal_2,
            'list_kategori_1' => $list_kategori_1,
            'list_kategori_2' => $list_kategori_2,

        ]);
    }
    public function artikelDetail($slug)
    {
        $artikel = Artikel::where('slug', $slug)->first();
        return view('contents.Front.informasi_publik.artikel-detail', [
            'title' => 'Berita',
            'artikel' => $artikel,
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
        $video = Galeri::where('is_video','=','1')->get();
        // $video = Galeri::all();
        return view('contents.Front.informasi_publik.galeri', [
            'title' => 'Berita',
            'video' => $video,
        ]);
    }
    public function FotoGaleri()
    {
        $foto = Galeri::where('is_image','=','1')->get();
        return view('contents.Front.informasi_publik.galeri-foto', [
            'title' => 'Berita',
            'foto' => $foto,
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
        $agenda = Agenda::where('id', $id)->first();
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
        $panduan = Panduan::where('id', $id)->first();
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
        $pengumuman = Pengumuman::where('id', $id)->first();
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
    public function regulasiDetail($slug)
    {
        $regulasi = Regulasi::where('slug', $slug)->first();
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

        $sekolah = ProgramLayanan::where('slug', $slug)->first();
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
        $guru = ProgramLayanan::where('slug', $slug)->first();
        // dd($guru);
        return view('contents.Front.menu_halaman.program_layanan.guru-penggerak-detail', [
            'title' => 'Detail Pogram Pendidikan Guru Penggerak ',
            'guru' => $guru,
        ]);
    }
    public function GaleriFoto()
    {

    }
}
