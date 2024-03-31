<?php

namespace App\Http\Controllers\Front;

use App\Model\Agenda;
use App\Model\Galeri;
use App\Model\Profil;
use App\Model\Swiper;
use App\Model\Tautan;
use App\Model\Artikel;
use App\Model\Panduan;
use App\Model\Podcast;
use App\Model\Unduhan;
use App\Model\Renstra;
use App\Model\Akuntabilitas;
use App\Model\Regulasi;
use App\Model\ListKanal;
use App\Model\CeritaBaik;
use App\Model\ListBerita;
use App\Model\Pengumuman;
use App\Model\Pengunjung;
use App\Model\Berprestasi;
use App\Model\PraktikBaik;
use App\Model\ListKategori;
use App\Model\ProgramFokus;
use Illuminate\Http\Request;
use App\Model\ProgramLayanan;
use App\Model\PengunjungAgenda;
use App\Model\PengunjungBerita;
use App\Model\PengunjungArtikel;
use App\Model\PengunjungPanduan;
use App\Model\PengunjungUnduhan;
use App\Model\PengunjungRegulasi;
use App\Model\Faq;
use Illuminate\Support\Facades\DB;
use App\Model\PengunjungPengumuman;
use App\Http\Controllers\Controller;
use App\Model\BeritaZIWBK;
use App\Model\DokumentasiLayanan;
use App\Model\KategoriFaq;
use App\Model\KeperluanFaq;
use App\Model\Lhkpn;
use App\Model\Maklumat;
use App\Model\PengunjungBeritaZiwbk;
use App\Model\PengunjungMaklumat;
use App\Model\PosLayanan;
use App\Model\SptPph21;
use App\Model\Tendik;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;


class LandingController extends Controller
{
    public function index()
    {

        $swiper = Swiper::where('is_active', '1')
            ->orderByDesc('created_at')
            ->take(5)
            ->get();
        $podcast = Podcast::where('status_publish', '1')->orderByDesc('created_at')->get();
        $berita = ListBerita::where('status_publish', '1')->take(2)->orderByDesc('date')->get();
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
        $program_fokus = ProgramFokus::where('status', '1')->orderBy('publish_date')->get();
        $praktik_baik  = PraktikBaik::where('is_active', '1')->orderBy('created_at')->get();
        $berprestasi   = Berprestasi::where('is_active', '1')->orderBy('created_at')->get();
        $cerita   = CeritaBaik::where('is_active', '1')->orderBy('created_at')->get();


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
            'praktik_baik'      => $praktik_baik,
            'berprestasi'       => $berprestasi,
            'cerita'            => $cerita,
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
        $query = ListBerita::where('status_publish', '1')->orderByDesc('date');

        $tahun = $request->tahun;
        $bulan = $request->bulan;

        if ($tahun) {
            $query->whereYear('date', $tahun);
        }
        if ($bulan) {
            $query->whereMonth('date', $bulan);
        }

        $berita = $query->paginate(8);

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
        $artikel = $query->paginate(8);
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
        $tautan = Tautan::with('list_kategori')->where('status_publish', '1')->orderByDesc('created_at')->get();
        $video = Galeri::where('status_publish', '1')->where('is_video', '=', '1')->get();
        $foto = Galeri::where('status_publish', '1')->where('is_image', '=', '1')->with('refGaleri')->get();
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

        $query->where('status_publish', '1');
        $agenda = $query->paginate(8);

        $tautan = Tautan::with('list_kategori')->where('status_publish', '1')->orderByDesc('created_at')->get();
        return view('contents.Front.menu_halaman.publikasi.agenda', [
            'title' => 'Agenda',
            'agenda' => $agenda,
            'tautan' => $tautan,
        ]);
    }
    public function agendaDetail($id)
    {

        $agenda = Agenda::where('id', $id)->first();
        $this->recordPengunjungAgenda(request(), $agenda->id);

        $jumlah_lihat = PengunjungAgenda::hitungPengunjungAgenda($agenda->id);
        $agenda->jumlah_lihat = $jumlah_lihat;
        $agenda->save();
        return view('contents.Front.menu_halaman.publikasi.agenda-detail', [
            'title' => 'Agenda Detail',
            'agenda' => $agenda,
        ]);
    }

    public function recordPengunjungAgenda(Request $request, $id_agenda)
    {
        $ipAddress = $request->ip();
        $userAgent = uniqid() . '-' . $request->header('User-Agent');

        PengunjungAgenda::create([
            'id_agenda' => $id_agenda,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
        ]);

        return response()->json(['success' => true]);
    }

    public function unduhan(Request $request)
    {
        $query = Unduhan::where('status_publish', '1')->orderByDesc('created_at');
        $tahun = $request->tahun;
        $bulan = $request->bulan;

        if ($tahun) {
            $query->whereYear('tanggal', $tahun);
        }
        if ($bulan) {
            $query->whereMonth('tanggal', $bulan);
        }
        $unduhan = $query->paginate(8);

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

    public function rekamPengunjungUnduhan(Request $request)
    {
        $data = $request->validate([
            'id_unduhan' => 'required|integer',
        ]);

        PengunjungUnduhan::create([
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'id_unduhan' => $data['id_unduhan'],
        ]);

        return response()->json(['message' => 'Pengunjung unduhan direkam.'], 200);
    }
    // public function recordPengunjungUnduhan(Request $request, $id_unduhan)
    // {
    //     $ipAddress = $request->ip();
    //     $userAgent = uniqid() . '-' . $request->header('User-Agent');

    //     PengunjungUnduhan::create([
    //         'id_unduhan' => $id_unduhan,
    //         'ip_address' => $ipAddress,
    //         'user_agent' => $userAgent,
    //     ]);

    //     return response()->json(['success' => true]);
    // }

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
        $panduan = $query->orderByDesc('created_at')->paginate(8);

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
        $this->recordPengunjungPanduan(request(), $panduan->id);
        $jumlah_lihat = PengunjungPanduan::hitungPengunjungPanduan($panduan->id);
        $panduan->jumlah_lihat = $jumlah_lihat;
        $panduan->save();
        return view('contents.Front.menu_halaman.publikasi.panduan-detail', [
            'title' => 'Panduan Detail',
            'panduan' => $panduan,
            'tautan' => $tautan,
        ]);
    }

    public function recordPengunjungPanduan(Request $request, $id_panduan)
    {
        $ipAddress = $request->ip();
        $userAgent = uniqid() . '-' . $request->header('User-Agent');

        PengunjungPanduan::create([
            'id_panduan' => $id_panduan,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
        ]);

        return response()->json(['success' => true]);
    }
    //start pengumuman
    public function pengumuman(Request $request)
    {
        $query = Pengumuman::where('status_publish', '1')->orderByDesc('date');
        $tahun = $request->tahun;
        $bulan = $request->bulan;

        if ($tahun) {
            $query->whereYear('date', $tahun);
        }
        if ($bulan) {
            $query->whereMonth('date', $bulan);
        }
        $pengumuman = $query->paginate(8);

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
        $this->recordPengunjungPengumuman(request(), $pengumuman->id);
        $jumlah_lihat = PengunjungPengumuman::hitungPengunjungPengumuman($pengumuman->id);
        $pengumuman->jumlah_lihat = $jumlah_lihat;
        $pengumuman->save();
        return view('contents.Front.menu_halaman.publikasi.pengumuman-detail', [
            'title' => 'Pengumuman Detail',
            'pengumuman' => $pengumuman,
            'tautan' => $tautan,
        ]);
    }

    public function recordPengunjungPengumuman(Request $request, $id_pengumuman)
    {
        $ipAddress = $request->ip();
        $userAgent = uniqid() . '-' . $request->header('User-Agent');

        PengunjungPengumuman::create([
            'id_pengumuman' => $id_pengumuman,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
        ]);

        return response()->json(['success' => true]);
    }

    //end pengumuman
    public function regulasi(Request $request)
    {
        // $query = Regulasi::query();
        $query = Regulasi::where('is_active', '1')->orderByDesc('tanggal');
        $tahun = $request->tahun;
        $bulan = $request->bulan;

        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }
        if ($bulan) {
            $query->whereMonth('created_at', $bulan);
        }
        $regulasi = $query->paginate(8);
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
        $this->recordPengunjungRegulasi(request(), $regulasi->id);

        $jumlah_lihat = PengunjungRegulasi::hitungPengunjungRegulasi($regulasi->id);
        $regulasi->jumlah_lihat = $jumlah_lihat;
        $regulasi->save();

        return view('contents.Front.menu_halaman.publikasi.regulasi-detail', [
            'title' => 'Regulasi Detail',
            'regulasi' => $regulasi,
            'tautan' => $tautan,
        ]);
    }

    public function recordPengunjungRegulasi(Request $request, $id_regulasi)
    {
        $ipAddress = $request->ip();
        $userAgent = uniqid() . '-' . $request->header('User-Agent');

        PengunjungRegulasi::create([
            'id_regulasi' => $id_regulasi,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
        ]);

        return response()->json(['success' => true]);
    }
    //END PUBLIKASI

    //START MENU PROGRAM LAYANAN
    public function sekolahPenggerak(Request $request)
    {
        // $query = DB::table('program_layanan');
        $tautan = Tautan::with('list_kategori')->where('status_publish', '1')->orderByDesc('created_at')->get();

        // $sekolah = DB::table('program_layanan')
        //     ->join('ref_kategori', 'program_layanan.id_kategori', '=', 'ref_kategori.id')
        //     ->select('program_layanan.*', 'ref_kategori.nama_kategori')
        //     ->where('program_layanan.id_kategori', '=', 55)
        //     ->whereNull('program_layanan.deleted_at');;
        $query = DB::table('program_layanan as pl')
            ->join('ref_kategori as rk', 'pl.id_kategori', '=', 'rk.id')
            ->select('pl.*')
            ->where('rk.nama_kategori', 'LIKE', '%sekolah penggerak%');
        $tahun = $request->tahun;
        $bulan = $request->bulan;
        if ($tahun) {
            $query->whereYear('publish_date', $tahun);
        }
        if ($bulan) {
            $query->whereMonth('publish_date', $bulan);
        }
        $sekolah = $query->paginate(8);
        return view('contents.Front.menu_halaman.program_layanan.sekolah-penggerak', [
            'title' => 'Program Pendidikan Sekolah Penggerak',
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
            'title' => 'Detail Program Pendidikan Sekolah Penggerak ',
            'sekolah' => $sekolah,
            'tautan' => $tautan,
        ]);
    }
    public function guruPenggerak(Request $request)
    {
        // $query = DB::table('program_layanan');
        $tautan = Tautan::with('list_kategori')->where('status_publish', '1')->orderByDesc('created_at')->get();

        // $query = DB::table('program_layanan')
        //     ->join('ref_kategori', 'program_layanan.id_kategori', '=', 'ref_kategori.id')
        //     ->select('program_layanan.*', 'ref_kategori.nama_kategori')
        // ->where('program_layanan.id_kategori', '=', 54)
        //     ->get();

        //     ->where('program_layanan.id_kategori', '=', 54);
        $query = DB::table('program_layanan as pl')
            ->join('ref_kategori as rk', 'pl.id_kategori', '=', 'rk.id')
            ->select('pl.*')
            ->where('rk.nama_kategori', 'LIKE', '%guru penggerak%');


        $tahun = $request->tahun;
        $bulan = $request->bulan;

        if ($tahun) {
            $query->whereYear('publish_date', $tahun);
        }
        if ($bulan) {
            $query->whereMonth('publish_date', $bulan);
        }
        $guru =  $query->paginate(8);
        return view('contents.Front.menu_halaman.program_layanan.guru-penggerak', [
            'title' => 'Program Pendidikan Guru Penggerak',
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
            'title' => 'Detail Program Pendidikan Guru Penggerak ',
            'guru' => $guru,
            'tautan' => $tautan,
        ]);
    }

    // public function FaqStore(Request $request)
    // {
    //     $validasi = Validator::make($request->all(), [
    //         'nama' => 'required',
    //         'email' => 'required ',
    //         'pertanyaan' => 'required ',
    //         'kategori' => 'required ',
    //         'keperluan' => 'required ',
    //         'nip' => 'required ',
    //         'instansi' => 'required ',
    //         'jabatan' => 'required ',
    //         'nomor_hp' => 'required ',
    //     ], [
    //         'nama.required' => 'Nama wajib diisi',
    //         'email.required' => 'Email  wajib diisi',
    //         'pertanyaan.required' => 'Pertanyaan  wajib diisi',
    //         'kategori.required' => 'Kategori  wajib diisi',
    //         'keperluan.required' => 'Keperluan  wajib diisi',
    //         'nip.required' => 'NIP  wajib diisi',
    //         'instansi.required' => 'Instansi  wajib diisi',
    //         'jabatan.required' => 'Jabatan  wajib diisi',
    //         'nomor_hp.required' => 'Nomor HP  wajib diisi',


    //     ]);

    //     if ($validasi->fails()) {
    //         return response()->json(['erorrs' => $validasi->errors()]);
    //     } else {

    //         $data = [
    //             'nama' => $request->nama,
    //             'email' => $request->email,
    //             'pertanyaan' => $request->pertanyaan,
    //             'kategori' => $request->kategori,
    //             'keperluan' => $request->keperluan,
    //             'nip' => $request->nip,
    //             'instansi' => $request->instansi,
    //             'jabatan' => $request->jabatan,
    //             'nomor_hp' => $request->nomor_hp,
    //             'tgl_pertanyaan' => now(),
    //         ];
    //         Faq::create($data);
    //         return response()->json(['status' => true], 200);
    //     }
    // }

    public function FaqStore(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            // 'nama' => 'required',
            // 'email' => 'required ',
            // 'pertanyaan' => 'required ',
            // 'id_kategori_faq' => 'required ',
            // 'id_keperluan_faq' => 'required ',
            // 'nip' => 'required ',
            // 'instansi' => 'required ',
            // 'jabatan' => 'required ',
            // 'nomor_hp' => 'required ',
        ], [
            // 'nama.required' => 'Nama wajib diisi',
            // 'email.required' => 'Email  wajib diisi',
            // 'pertanyaan.required' => 'Pertanyaan  wajib diisi',
            // 'id_kategori_faq.required' => 'Kategori  wajib diisi',
            // 'id_keperluan_faq.required' => 'Keperluan  wajib diisi',
            // 'nip.required' => 'NIP  wajib diisi',
            // 'instansi.required' => 'Instansi  wajib diisi',
            // 'jabatan.required' => 'Jabatan  wajib diisi',
            // 'nomor_hp.required' => 'Nomor HP  wajib diisi',


        ]);

        if ($validasi->fails()) {
            return response()->json(['erorrs' => $validasi->errors()]);
        } else {
            //Data Model FAQ
            $data = [
                'nama' => $request->nama,
                'email' => $request->email,
                'pertanyaan' => $request->pertanyaan,
                'id_kategori_faq' => $request->id_kategori_faq,
                'id_keperluan_faq' => $request->id_keperluan_faq,
                'nip' => $request->nip,
                'instansi' => $request->instansi,
                'jabatan' => $request->jabatan,
                'nomor_hp' => $request->nomor_hp,
                'tgl_pertanyaan' => now(),
            ];

            // dd($data);
            $FAQ = Faq::create($data);

            // Data API
            $DataApi = [
                'nama' => $request->nama,
                'imil' => $request->email,
                'pronote' => $request->pertanyaan,
                'ktg' => $request->id_kategori_faq,
                'idprob' =>  $request->id_keperluan_faq,
                'nip' => $request->nip,
                'tempat' => $request->instansi,
                'job' => $request->jabatan,
                'nohp' => $request->nomor_hp,
                'idksps' => '' . $FAQ->id,
            ];

            // dd($DataApi);
            // Mengirim data ke API
            $apiUrl = 'http://app.kspstendik.kemdikbud.go.id/front-office/modul/ksps/entriksps.php?token=';
            $garam1 = "layanantamu";
            $garam2 = "kspspichos";
            $garam3 = "20240326";

            $encodedData = base64_encode($garam3 . base64_encode(json_encode([$DataApi])));
            $tokenparam = hash("sha256", $garam1 . $encodedData . $garam2);
            // dd($tokenparam);
            $headers = [
                'Accept: application/json',
                'Content-Type: application/x-www-form-urlencoded',
            ];
            $postdata = http_build_query(['payload' => $encodedData], '', '&');
            $ch = curl_init($apiUrl . $tokenparam);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $result = curl_exec($ch);
            curl_close($ch);

            if ($result) {
                $resultDecoded = json_decode($result, true);
                if ($resultDecoded['result']) {
                    return response()->json(['status' => true], 200);
                } else {
                    return response()->json(['status' => false, 'data' => [
                        'reponse' => $result,
                        'payload' => $DataApi
                    ]], 200);
                }
            } else {
                return 'error';
            }

            return response()->json(['status' => true], 200);
        }
    }



    public function renstra(Request $request)
    {
        $query = Renstra::query();
        $tahun = $request->tahun;
        $bulan = $request->bulan;

        if ($tahun) {
            $query->whereYear('tanggal', $tahun);
        }
        if ($bulan) {
            $query->whereMonth('tanggal', $bulan);
        }
        $renstra = $query->paginate(5);

        $tautan = Tautan::with('list_kategori')->where('status_publish', '1')->orderByDesc('created_at')->get();

        // foreach ($renstra as $item) {
        //     $item->increment('jumlah_download');
        // }

        // dd($renstra);
        return view('contents.Front.ziwbk.sakip.renstra', [
            'title' => 'Renstra',
            'renstra' => $renstra,
            'tautan' => $tautan,
        ]);
    }

    public function akuntabilitas(Request $request)
    {
        $query = Akuntabilitas::query();
        $tahun = $request->tahun;
        $bulan = $request->bulan;

        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }
        if ($bulan) {
            $query->whereMonth('created_at', $bulan);
        }
        $akuntabilitas = $query->paginate(5);

        $tautan = Tautan::with('list_kategori')->where('status_publish', '1')->orderByDesc('created_at')->get();

        // foreach ($akuntabilitas as $item) {
        //     $item->increment('jumlah_download');
        // }


        // dd($akuntabilitas);
        return view('contents.Front.ziwbk.sakip.akuntabilitas', [
            'title' => 'Akuntabilitas',
            'akuntabilitas' => $akuntabilitas,
            'tautan' => $tautan,
        ]);
    }

    public function beritaZiwbk(Request $request)
    {
        $query = BeritaZIWBK::where('status_publish', '1')->orderByDesc('date');

        $tahun = $request->tahun;
        $bulan = $request->bulan;

        if ($tahun) {
            $query->whereYear('date', $tahun);
        }
        if ($bulan) {
            $query->whereMonth('date', $bulan);
        }

        $berita_ziwbk = $query->paginate(4);

        $tautan = Tautan::with('list_kategori')->where('status_publish', '1')->orderByDesc('created_at')->get();

        return view('contents.Front.ziwbk.berita_ziwbk', [
            'title' => 'Berita ZI/WBK',
            'berita_ziwbk' => $berita_ziwbk,
            'tautan' => $tautan,
        ]);
    }

    public function beritaZiwbkDetail($slug)
    {
        $tautan = Tautan::with('list_kategori')->where('status_publish', '1')->orderByDesc('created_at')->get();

        $berita_ziwbk = BeritaZIWBK::where('slug', $slug)->first();
        $this->recordPengunjungBeritaZiwbk(request(), $berita_ziwbk->id);

        $jumlah_lihat = PengunjungBeritaZiwbk::hitungPengunjungBeritaZiwbk($berita_ziwbk->id);
        $berita_ziwbk->jumlah_lihat = $jumlah_lihat;
        $berita_ziwbk->save();

        return view('contents.Front.ziwbk.berita_ziwbk-detail', [
            'title' => 'Berita ZI/WBK',
            'berita_ziwbk' => $berita_ziwbk,
            'tautan' => $tautan,
        ]);
    }

    public function recordPengunjungBeritaZiwbk(Request $request, $id_berita_ziwbk)
    {
        $ipAddress = $request->ip();
        $userAgent = uniqid() . '-' . $request->header('User-Agent');

        PengunjungBeritaZiwbk::create([
            'id_berita_ziwbk' => $id_berita_ziwbk,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
        ]);

        return response()->json(['success' => true]);
    }

    public function program_fokus_tendik()
    {
        $tendik = Tendik::where('status_publish', '1')->orderByDesc('created_at')->get();

        return view('contents.Front.portal_program_fokus.portal-program-fokus-tendik', [
            'tendik' => $tendik,
        ]);
    }

    public function program_fokus_harlindung()
    {
        return view("contents.Front.portal_program_fokus.portal-program-fokus-harlindung");
    }


    public function pos_layanan(Request $request)
    {
        $query = PosLayanan::where('status_publish', '1')->orderByDesc('created_at');
        $tahun = $request->tahun;
        $bulan = $request->bulan;

        if ($tahun) {
            $query->whereYear('tanggal', $tahun);
        }
        if ($bulan) {
            $query->whereMonth('tanggal', $bulan);
        }
        $pos_layanan = $query->paginate(8);

        $tautan = Tautan::with('list_kategori')->where('status_publish', '1')->orderByDesc('created_at')->get();

        // foreach ($unduhan as $item) {
        //     $item->increment('jumlah_download');
        // }

        return view('contents.Front.menu_halaman.pos_layanan.pos_layanan', [
            'title' => 'Pos Layanan',
            'pos_layanan' => $pos_layanan,
            'tautan' => $tautan,
        ]);
    }


    public function lke()
    {
        return view('contents.Front.lke');
    }
    public function lke_new()
    {
        return view('contents.Front.LKE');
    }

    public function maklumat(Request $request)
    {
        $query = Maklumat::where('status_publish', '1')->orderByDesc('created_at');
        $tahun = $request->tahun;
        $bulan = $request->bulan;

        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }
        if ($bulan) {
            $query->whereMonth('created_at', $bulan);
        }

        $maklumat = $query->paginate(4);

        $tautan = Tautan::with('list_kategori')->where('status_publish', '1')->orderByDesc('created_at')->get();

        return view('contents.Front.ziwbk.maklumat', [
            'title' => 'Maklumat',
            'maklumat' => $maklumat,
            'tautan' => $tautan,
        ]);
    }

    public function maklumatDetail($id)
    {
        $tautan = Tautan::with('list_kategori')->where('status_publish', '1')->orderByDesc('created_at')->get();

        $maklumat = Maklumat::where('id', $id)->first();
        // $this->recordPengunjungMaklumat(request(), $maklumat->id);

        // $jumlah_lihat = PengunjungMaklumat::hitungPengunjungMaklumat($maklumat->id);
        // $maklumat->jumlah_lihat = $jumlah_lihat;
        // $maklumat->save();

        return view('contents.Front.ziwbk.maklumat-detail', [
            'title' => 'Detail Maklumat',
            'maklumat' => $maklumat,
            'tautan' => $tautan,
        ]);
    }

    public function recordPengunjungMaklumat(Request $request, $id_maklumat)
    {
        $ipAddress = $request->ip();
        $userAgent = uniqid() . '-' . $request->header('User-Agent');

        PengunjungMaklumat::create([
            'id_maklumat' => $id_maklumat,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
        ]);

        return response()->json(['success' => true]);
    }

    public function dokumentasiLayanan()
    {
        $tautan = Tautan::with('list_kategori')->where('status_publish', '1')->orderByDesc('created_at')->get();
        // $video = Galeri::where('status_publish', '1')->where('is_video', '=', '1')->get();
        $foto = DokumentasiLayanan::where('status_publish', '1')->where('is_image', '=', '1')->with('refDokumentasiLayanan')->get();
        return view('contents.Front.ziwbk.dokumentasi_layanan', [
            'title' => 'Dokumentasi Layanan',
            // 'video' => $video,
            'foto' => $foto,
            'tautan' => $tautan,
        ]);
    }

    public function SptPph21(Request $request)
    {
        $query = SptPph21::orderByDesc('created_at');
        $tahun = $request->tahun;
        $bulan = $request->bulan;

        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }
        if ($bulan) {
            $query->whereMonth('created_at', $bulan);
        }

        $data = $query->paginate(4);

        $tautan = Tautan::with('list_kategori')->where('status_publish', '1')->orderByDesc('created_at')->get();

        return view('contents.Front.ziwbk.sptpph21', [
            'title' => 'SPT PPH 21',
            'data' => $data,
            'tautan' => $tautan,
        ]);
    }

    public function SptPph21Detail($id)
    {
        
        $tautan = Tautan::with('list_kategori')->where('status_publish', '1')->orderByDesc('created_at')->get();

        $data = SptPph21::where('id', $id)->first();
        foreach ($data->dokumen as $key => $value) {
            $value->encrypted_id = encrypt($value->id);
            $explode = explode('/', $value->file);
            $explode2 = explode('.', end($explode));
            $extension = end($explode2);
            $value->extension = $extension;
        }
        // $this->recordPengunjungMaklumat(request(), $maklumat->id);

        // $jumlah_lihat = PengunjungMaklumat::hitungPengunjungMaklumat($maklumat->id);
        // $maklumat->jumlah_lihat = $jumlah_lihat;
        // $maklumat->save();

        return view('contents.Front.ziwbk.sptpph21-detail', [
            'title' => 'Detail SPT PPH 21',
            'data' => $data,
            'tautan' => $tautan,
        ]);
    }

    public function lhkpn(Request $request)
    {
        $query = Lhkpn::orderByDesc('created_at');
        $tahun = $request->tahun;
        $bulan = $request->bulan;

        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }
        if ($bulan) {
            $query->whereMonth('created_at', $bulan);
        }

        $data = $query->paginate(4);

        $tautan = Tautan::with('list_kategori')->where('status_publish', '1')->orderByDesc('created_at')->get();

        return view('contents.Front.ziwbk.lhkpn', [
            'title' => 'LHKPN',
            'data' => $data,
            'tautan' => $tautan,
        ]);
    }

    public function lhkpnDetail($id)
    {
        
        $tautan = Tautan::with('list_kategori')->where('status_publish', '1')->orderByDesc('created_at')->get();

        $data = Lhkpn::where('id', $id)->first();
        foreach ($data->dokumen as $key => $value) {
            $value->encrypted_id = encrypt($value->id);
            $explode = explode('/', $value->file);
            $explode2 = explode('.', end($explode));
            $extension = end($explode2);
            $value->extension = $extension;
        }
        // $this->recordPengunjungMaklumat(request(), $maklumat->id);

        // $jumlah_lihat = PengunjungMaklumat::hitungPengunjungMaklumat($maklumat->id);
        // $maklumat->jumlah_lihat = $jumlah_lihat;
        // $maklumat->save();

        return view('contents.Front.ziwbk.lhkpn-detail', [
            'title' => 'Detail LHKPN',
            'data' => $data,
            'tautan' => $tautan,
        ]);
    }
}
