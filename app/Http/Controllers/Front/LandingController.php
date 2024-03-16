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
use App\Model\ListKanal;
use App\Model\ListKategori;
use App\Model\PengunjungArtikel;
use App\Model\PengunjungBerita;
use App\Model\Podcast;
use App\Model\Profil;
use App\Model\ProgramFokus;
use App\Model\Tautan;
use Illuminate\Database\Eloquent\Builder;

class LandingController extends Controller
{
    public function index()
    {

        $swiper         = Swiper::where('is_active', '1')
            ->orderByDesc('created_at')
            ->take(4)
            ->get();
        $program_fokus  = ProgramFokus::where('status', '1')->orderByDesc('created_at')->get();
        $podcast        = Podcast::where('status_publish', '1')->orderByDesc('created_at')->get();
        $berita = ListBerita::where('status_publish', '1')->orderByDesc('created_at')->get();
        $list_kanal_1   = ListKanal::where('status', '1')
            ->where(function ($query) {
                $query->where('nama_kanal', 'LIKE', '%profil%')
                    ->orWhere('nama_kanal', 'LIKE', '%informasi publik%')
                    ->orWhere('nama_kanal', 'LIKE', '%zi/wbk%');
            })
            ->get();

        $list_kanal_2   = ListKanal::where('status', '1')
            ->where(function ($query) {
                $query->where('nama_kanal', 'LIKE', '%program dan layanan%')
                    ->orWhere('nama_kanal', 'LIKE', '%tautan%')
                    ->orWhere('nama_kanal', 'LIKE', '%publikasi%');
            })
            ->get();
        $program_fokus = ProgramFokus::where('status', '1')->orderBy('publish_date')->get();

        $tautan = Tautan::with('list_kategori')->where('status_publish', '1')->orderByDesc('created_at')->get();



        return view('contents.Front.index', [
            'title'             => 'Beranda',
            'swiper'            => $swiper,
            'berita'            => $berita,
            'podcast'           => $podcast,
            'program_fokus'     => $program_fokus,
            'list_kanal_1'      => $list_kanal_1,
            'list_kanal_2'      => $list_kanal_2,
            'pengunjung'        => $this->recordPengunjung(request()),
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
        $tautan = Tautan::with('list_kategori')->where('status_publish', '1')->orderByDesc('created_at')->get();

        $data_visi = Profil::whereHas('list_kategori', function (Builder $query) {
            $query->where('nama_kategori', 'LIKE', '%visi%')->where('is_active', '1');
        })->get();

        return view('contents.Front.profil.visi_misi', [
            'title' => 'Visi dan Misi',
            'tautan' => $tautan,
            'data_visi' => $data_visi,
        ]);
    }


    public function struktur_organisasi()
    {
        $tautan = Tautan::with('list_kategori')->where('status_publish', '1')->orderByDesc('created_at')->get();

        $data_struktur = Profil::whereHas('list_kategori', function (Builder $query) {
            $query->where('nama_kategori', 'LIKE', '%struktur%')->where('is_active', '1');
        })->get();

        return view('contents.Front.profil.struktur_organisasi', [
            'title' => 'Struktur Organisasi',
            'tautan' => $tautan,
            'data_struktur' => $data_struktur,
        ]);
    }

    public function tugas_fungsi()
    {
        $tautan = Tautan::with('list_kategori')->where('status_publish', '1')->orderByDesc('created_at')->get();

        $data_tugas = Profil::whereHas('list_kategori', function (Builder $query) {
            $query->where('nama_kategori', 'LIKE', '%tugas%')->where('is_active', '1');
        })->get();

        return view('contents.Front.profil.tugas_fungsi', [
            'title' => 'Tugas & Fungsi ',
            'data_tugas' => $data_tugas,
            'tautan' => $tautan,
        ]);
    }

    public function kontak_kami()
    {
        $tautan = Tautan::with('list_kategori')->where('status_publish', '1')->orderByDesc('created_at')->get();

        $data_kontak = Profil::whereHas('list_kategori', function (Builder $query) {
            $query->where('nama_kategori', 'LIKE', '%kontak%')->where('is_active', '1');
        })->get();

        return view('contents.Front.profil.kontak_kami', [
            'title' => 'Kontak Kami',
            'data_kontak' =>  $data_kontak,
            'tautan' => $tautan,
        ]);
    }

    public function berita(Request $request)
    {
        $query = ListBerita::where('status_publish', '1')->orderByDesc('created_at');

        $tahun = $request->tahun;
        $bulan = $request->bulan;

        if ($tahun) {
            $query->whereYear('date', $tahun);
        }
        if ($bulan) {
            $query->whereMonth('date', $bulan);
        }

        $berita = $query->paginate(5);

        $tautan = Tautan::with('list_kategori')->where('status_publish', '1')->orderByDesc('created_at')->get();

        return view('contents.Front.informasi_publik.berita', [
            'title' => 'Berita',
            'berita' => $berita,
            'tautan' => $tautan,
        ]);
    }

    public function beritaDetail($slug)
    {
        $tautan = Tautan::with('list_kategori')->where('status_publish', '1')->orderByDesc('created_at')->get();

        $berita = ListBerita::where('slug', $slug)->first();
        $this->recordPengunjungBerita(request(), $berita->id);

        $jumlah_lihat = PengunjungBerita::hitungPengunjungBerita($berita->id);
        $berita->jumlah_lihat = $jumlah_lihat;
        $berita->save();

        return view('contents.Front.informasi_publik.berita-detail', [
            'title' => 'Berita',
            'berita' => $berita,
            'tautan' => $tautan,
        ]);
    }

    public function recordPengunjungBerita(Request $request, $id_berita)
    {
        $ipAddress = $request->ip();
        $userAgent = uniqid() . '-' . $request->header('User-Agent');

        PengunjungBerita::create([
            'id_berita' => $id_berita,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
        ]);

        return response()->json(['success' => true]);
    }

    public function artikel(Request $request)
    {
        $query  = Artikel::where('status_publish', '1');
        $tahun = $request->tahun;
        $bulan = $request->bulan;

        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }
        if ($bulan) {
            $query->whereMonth('created_at', $bulan);
        }
        $artikel = $query->paginate(5);
        $tautan = Tautan::with('list_kategori')->where('status_publish', '1')->orderByDesc('created_at')->get();


        return view('contents.Front.informasi_publik.artikel', [
            'title' => 'Artikel',
            'artikel' => $artikel,
            'tautan' => $tautan,

        ]);
    }

    public function artikelDetail($slug)
    {
        $tautan = Tautan::with('list_kategori')->where('status_publish', '1')->orderByDesc('created_at')->get();

        $artikel = Artikel::where('slug', $slug)->first();
        $this->recordPengunjungArtikel(request(), $artikel->id);

        $jumlah_lihat = PengunjungArtikel::hitungPengunjungArtikel($artikel->id);
        $artikel->jumlah_lihat = $jumlah_lihat;
        $artikel->save();

        return view('contents.Front.informasi_publik.artikel-detail', [
            'title' => 'Artikel',
            'artikel' => $artikel,
            'tautan' => $tautan,
        ]);
    }

    public function recordPengunjungArtikel(Request $request, $id_artikel)
    {
        $ipAddress = $request->ip();
        $userAgent = uniqid() . '-' . $request->header('User-Agent');

        PengunjungArtikel::create([
            'id_artikel' => $id_artikel,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
        ]);

        return response()->json(['success' => true]);
    }

    public function detail()
    {
        $tautan = Tautan::with('list_kategori')->where('status_publish', '1')->orderByDesc('created_at')->get();

        return view('contents.Front.informasi_publik.detail', [
            'title' => 'Berita',
            'tautan' => $tautan,
        ]);
    }

    public function galeri()
    {
        $video = Galeri::where('is_video', '=', '1')->get();
        $foto = Galeri::where('is_image', '=', '1')->with('refGaleri')->get();
        $tautan = Tautan::with('list_kategori')->where('status_publish', '1')->orderByDesc('created_at')->get();

        $video = Galeri::where('is_video', '=', '1')->get();
        $foto = Galeri::where('is_image', '=', '1')->with('refGaleri')->get();
        return view('contents.Front.informasi_publik.galeri', [
            'title' => 'Galeri',
            'video' => $video,
            'foto' => $foto,
            'tautan' => $tautan,
        ]);
    }

    // START MENU PUBLIKASI
    public function agenda(Request $request)
    {
        $query = Agenda::query();
        $tahun = $request->tahun;
        $bulan = $request->bulan;

        if ($tahun) {
            $query->whereYear('tanggal_agenda', $tahun);
        }
        if ($bulan) {
            $query->whereMonth('tanggal_agenda', $bulan);
        }
        $agenda = $query->paginate(5);

        $tautan = Tautan::with('list_kategori')->where('status_publish', '1')->orderByDesc('created_at')->get();

        $agenda = Agenda::all();
        return view('contents.Front.menu_halaman.publikasi.agenda', [
            'title' => 'Agenda',
            'agenda' => $agenda,
            'tautan' => $tautan,
        ]);
    }
    public function agendaDetail($id)
    {
        $tautan = Tautan::with('list_kategori')->where('status_publish', '1')->orderByDesc('created_at')->get();

        $agenda = Agenda::where('id', $id)->first();
        return view('contents.Front.menu_halaman.publikasi.agenda-detail', [
            'title' => 'Agenda Detail',
            'agenda' => $agenda,
            'tautan' => $tautan,
        ]);
    }

    public function unduhan(Request $request)
    {
        $query = Unduhan::query();
        $tahun = $request->tahun;
        $bulan = $request->bulan;

        if ($tahun) {
            $query->whereYear('tanggal', $tahun);
        }
        if ($bulan) {
            $query->whereMonth('tanggal', $bulan);
        }
        $unduhan = $query->paginate(5);

        $tautan = Tautan::with('list_kategori')->where('status_publish', '1')->orderByDesc('created_at')->get();

        // foreach ($unduhan as $item) {
        //     $item->increment('jumlah_download');
        // }
        return view('contents.Front.menu_halaman.publikasi.unduhan', [
            'title' => 'Unduhan',
            'unduhan' => $unduhan,
            'tautan' => $tautan,
        ]);
    }
    public function panduan(Request $request)
    {
        $query = Panduan::query();
        $tahun = $request->tahun;
        $bulan = $request->bulan;

        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }
        if ($bulan) {
            $query->whereMonth('created_at', $bulan);
        }
        $panduan = $query->paginate(5);

        $tautan = Tautan::with('list_kategori')->where('status_publish', '1')->orderByDesc('created_at')->get();
        return view('contents.Front.menu_halaman.publikasi.panduan', [
            'title' => 'Panduan',
            'panduan' => $panduan,
            'tautan' => $tautan,
        ]);
    }
    public function panduanDetail($id)
    {
        $tautan = Tautan::with('list_kategori')->where('status_publish', '1')->orderByDesc('created_at')->get();

        $panduan = Panduan::where('id', $id)->first();
        return view('contents.Front.menu_halaman.publikasi.panduan-detail', [
            'title' => 'Panduan Detail',
            'panduan' => $panduan,
            'tautan' => $tautan,
        ]);
    }
    //start pengumuman
    public function pengumuman(Request $request)
    {
        $query = Pengumuman::query();
        $tahun = $request->tahun;
        $bulan = $request->bulan;

        if ($tahun) {
            $query->whereYear('date', $tahun);
        }
        if ($bulan) {
            $query->whereMonth('date', $bulan);
        }
        $pengumuman = $query->paginate(5);

        $tautan = Tautan::with('list_kategori')->where('status_publish', '1')->orderByDesc('created_at')->get();
        return view('contents.Front.menu_halaman.publikasi.pengumuman', [
            'title' => 'Pengumuman',
            'pengumuman' => $pengumuman,
            'tautan' => $tautan,
        ]);
    }
    public function pengumumanDetail($id)
    {
        $tautan = Tautan::with('list_kategori')->where('status_publish', '1')->orderByDesc('created_at')->get();

        $pengumuman = Pengumuman::where('id', $id)->first();
        return view('contents.Front.menu_halaman.publikasi.pengumuman-detail', [
            'title' => 'Pengumuman Detail',
            'pengumuman' => $pengumuman,
            'tautan' => $tautan,
        ]);
    }

    //end pengumuman
    public function regulasi(Request $request)
    {
        $query = Regulasi::query();
        $tahun = $request->tahun;
        $bulan = $request->bulan;

        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }
        if ($bulan) {
            $query->whereMonth('created_at', $bulan);
        }
        $regulasi = $query->paginate(5);
        $tautan = Tautan::with('list_kategori')->where('status_publish', '1')->orderByDesc('created_at')->get();
        return view('contents.Front.menu_halaman.publikasi.regulasi', [
            'title' => 'Regulasi',
            'regulasi' => $regulasi,
            'tautan' => $tautan,
        ]);
    }
    public function regulasiDetail($slug)
    {
        $regulasi = Regulasi::where('slug', $slug)->first();
        $tautan = Tautan::with('list_kategori')->where('status_publish', '1')->orderByDesc('created_at')->get();

        return view('contents.Front.menu_halaman.publikasi.regulasi-detail', [
            'title' => 'Regulasi Detail',
            'regulasi' => $regulasi,
            'tautan' => $tautan,
        ]);
    }
    //END PUBLIKASI

    //START MENU PROGRAM LAYANAN
    public function sekolahPenggerak(Request $request)
    {
        $query = DB::table('program_layanan');
        $tautan = Tautan::with('list_kategori')->where('status_publish', '1')->orderByDesc('created_at')->get();

        $sekolah = DB::table('program_layanan')
            ->join('ref_kategori', 'program_layanan.id_kategori', '=', 'ref_kategori.id')
            ->select('program_layanan.*', 'ref_kategori.nama_kategori')
            ->where('program_layanan.id_kategori', '=', 19);
        $tahun = $request->tahun;
        $bulan = $request->bulan;

        if ($tahun) {
            $query->whereYear('publish_date', $tahun);
        }
        if ($bulan) {
            $query->whereMonth('publish_date', $bulan);
        }
        $sekolah = $query->paginate(5);
        return view('contents.Front.menu_halaman.program_layanan.sekolah-penggerak', [
            'title' => 'Pogram Pendidikan Guru Penggerak',
            'sekolah' => $sekolah,
            'tautan' => $tautan,
        ]);
    }
    public function sekolahPenggerakDetail($slug)
    {

        $tautan = Tautan::with('list_kategori')->where('status_publish', '1')->orderByDesc('created_at')->get();

        $sekolah = ProgramLayanan::where('slug', $slug)->first();
        // dd($sekolah);
        return view('contents.Front.menu_halaman.program_layanan.sekolah-penggerak-detail', [
            'title' => 'Detail Pogram Pendidikan Guru Penggerak ',
            'sekolah' => $sekolah,
            'tautan' => $tautan,
        ]);
    }
    public function guruPenggerak(Request $request)
    {
        $query = DB::table('program_layanan');
        $tautan = Tautan::with('list_kategori')->where('status_publish', '1')->orderByDesc('created_at')->get();

        $guru = DB::table('program_layanan')
            ->join('ref_kategori', 'program_layanan.id_kategori', '=', 'ref_kategori.id')
            ->select('program_layanan.*', 'ref_kategori.nama_kategori')
            ->where('program_layanan.id_kategori', '=', 20);
        $tahun = $request->tahun;
        $bulan = $request->bulan;

        if ($tahun) {
            $query->whereYear('publish_date', $tahun);
        }
        if ($bulan) {
            $query->whereMonth('publish_date', $bulan);
        }
        $guru =  $query->paginate(5);
        return view('contents.Front.menu_halaman.program_layanan.guru-penggerak', [
            'title' => 'Pogram Pendidikan Guru Penggerak',
            'guru' => $guru,
            'tautan' => $tautan,
        ]);
    }
    public function guruPenggerakDetail($slug)
    {
        $tautan = Tautan::with('list_kategori')->where('status_publish', '1')->orderByDesc('created_at')->get();

        $guru = ProgramLayanan::where('slug', $slug)->first();
        // dd($guru);
        return view('contents.Front.menu_halaman.program_layanan.guru-penggerak-detail', [
            'title' => 'Detail Pogram Pendidikan Guru Penggerak ',
            'guru' => $guru,
            'tautan' => $tautan,
        ]);
    }
    public function GaleriFoto()
    {
    }
}
