<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\ListKanal;
use App\Model\ListBerita;
use App\Model\ListKategori;
use App\Model\Ref_berita_has_file;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ListBeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contents.ListBerita.list', [
            'title' => 'List Berita'
        ]);
    }

    public function data()
    {
        $list = ListBerita::with('user', 'list_kategori', 'list_kanal')->get();

        return DataTables::of($list)
            ->addIndexColumn()
            ->addColumn('id', function ($row) {
                return encrypt($row->id);
            })
            ->make();
    }

    public function tambah_data()
    {
        $list_kanal = ListKanal::all();
        $list_kategori = ListKategori::all();
        $penulis = User::all();
        return view('contents.ListBerita.tambah-data', [
            'title' => 'Tambah Berita',
            'list_kanal' => $list_kanal,
            'list_kategori' => $list_kategori,
            'penulis' => $penulis,
        ]);
    }

    public function switchStatus(Request $request)
    {
        try {
            $encrypted_id = $request->id;
            $decrypted_id = decrypt($encrypted_id);
            $list_berita = ListBerita::findOrFail($decrypted_id);
            // dd($list_berita);

            $list_berita->status_publish = $request->value;

            if ($list_berita->isDirty()) {
                $list_berita->save();
            }

            if ($list_berita->wasChanged()) {
                return response()->json(['status' => true], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Validasi data yang diterima dari form
        $validasi = Validator::make($request->all(), [
            'id_kanal' => 'required',
            'id_kategori' => 'required',
            'judul' => 'required',
            'lead' => 'required',
            'isi_konten' => 'required',
            'tag_dinamis' => 'required',
            'id_penulis' => 'required',
            'date' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validasi untuk file gambar
        ], [
            'id_kanal.required' => 'Pilih Kanal wajib diisi',
            'id_kategori.required' => 'Pilih Kategori wajib diisi',
            'judul.required' => 'Judul wajib diisi',
            'lead.required' => 'Lead wajib diisi',
            'isi_konten.required' => 'Konten wajib diisi',
            'tag_dinamis.required' => 'Tag Dinamis wajib diisi',
            'id_penulis.required' => 'Penulis wajib diisi',
            'date.required' => 'Waktu Tayang wajib diisi',
            'gambar.required' => 'Gambar wajib diisi',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.mimes' => 'Format gambar harus jpeg, png, atau jpg',
            'gambar.max' => 'Ukuran gambar tidak boleh melebihi 2MB',
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()]);
        } else {
            // Proses upload gambar
            $gambarName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('list_berita'), $gambarName);

            // Data yang akan disimpan
            $data = [
                'id_kanal' => $request->id_kanal,
                'id_kategori' => $request->id_kategori,
                'judul' => $request->judul,
                'slug' => Str::slug($request->judul),
                'lead' => $request->lead,
                'isi_konten' => $request->isi_konten,
                'tag_dinamis' => $request->tag_dinamis,
                'id_penulis' => $request->id_penulis,
                'status_video' => $request->has('status_video') ? true : false,
                'url_video' => $request->url_video,
                'status_headline' => $request->has('status_headline') ? true : false,
                'gambar' => $gambarName,
                'caption_gambar' => $request->caption_gambar,
                'date' => $request->date,
            ];

            ListBerita::create($data);

            return response()->json(['success' => "Berhasil menyimpan data"]);
        }




        // $this->validate($request, [
        //     'id_kanal' => 'required',
        //     'id_kategori' => 'required',
        //     'judul' => 'required',
        //     'lead' => 'required',
        //     'isi_konten' => 'required',
        //     'tag_dinamis' => 'required',
        //     'id_penulis' => 'required',
        //     'date' => 'required',
        //     'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        // ]);
        // try {
        //     DB::beginTransaction();
        //     $isi_konten = $request->isi_konten;
        //     $gambar = $request->gambar;

        //     $dom = new \DomDocument();
        //     $dom->loadHtml($isi_konten, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        //     $dom->loadHtml($gambar, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        //     $imageFile = $dom->getElementsByTagName('img');
        //     // Create Informasi_publik first
        //     $fileUpload = new ListBerita();

        //     $fileUpload->id_kanal = $request->judul;
        //     $fileUpload->id_kategori = $request->judul;
        //     $fileUpload->judul = $request->judul;
        //     $fileUpload->slug = $request->judul;
        //     $fileUpload->lead = $request->judul;
        //     // $fileUpload->isi_konten = $request->judul;
        //     $fileUpload->tag_dinamis = $request->kategori;
        //     $fileUpload->id_penulis = $request->kategori;
        //     $fileUpload->status_video = $request->kategori;
        //     $fileUpload->url_video = $request->kategori;
        //     $fileUpload->status_headline = $request->kategori;
        //     $fileUpload->gambar = $request->kategori;
        //     $fileUpload->caption_gambar = $request->kategori;
        //     $fileUpload->date = $request->kategori;
        //     $fileUpload->isi_konten = ''; // Will be updated later
        //     $fileUpload->save();
        //     foreach ($imageFile as $item => $image) {
        //         $data = $image->getAttribute('src');
        //         list($type, $data) = explode(';', $data);
        //         list(, $data)      = explode(',', $data);
        //         $imgeData = base64_decode($data);
        //         $fileName = time() . $item . '.png';
        //         $directory = "uploads/list_berita/{$fileUpload->id}"; // Use the ID of the Informasi_publik as part of the directory

        //         // Store the image using Laravel's Storage
        //         Storage::put("public/$directory/$fileName", $imgeData);

        //         // Update the image src attribute in the HTML content
        //         $newSrc = Storage::url("$directory/$fileName");
        //         $image->setAttribute('src', $newSrc);
        //         $fileUploadFile = new Ref_berita_has_file();
        //         $fileUploadFile->path = $directory;
        //         $fileUploadFile->file = $fileName;
        //         $fileUploadFile->ref_berita_id = $fileUpload->id;
        //         $fileUploadFile->save();
        //     }

        //     $isi_konten = $dom->saveHTML();
        //     // Update Informasi_publik with the final content
        //     $fileUpload->isi_konten = $dom->saveHTML();
        //     $fileUpload->save();


        //     DB::commit();
        //     return response()->json(['status' => true, 'image' => $imageFile], 200);
        // } catch (\Exception $e) {
        //     DB::rollback();
        //     return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\ListBerita  $listBerita
     * @return \Illuminate\Http\Response
     */
    public function show(ListBerita $listBerita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\ListBerita  $listBerita
     * @return \Illuminate\Http\Response
     */
    public function edit(ListBerita $listBerita)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\ListBerita  $listBerita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ListBerita $listBerita)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\ListBerita  $listBerita
     * @return \Illuminate\Http\Response
     */
    public function delete(ListBerita $listBerita, Request $request)
    {
        $list_berita_id = decrypt($request->id);

        try {
            $list_berita = Listberita::find($list_berita_id);

            $list_berita->delete();


            if ($list_berita->trashed()) {
                return response()->json(['status' => true], 200);
            }
            return response()->json(['status' => false], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
}
