<?php

namespace App\Http\Controllers;

use App\Model\BeritaZIWBK;
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

class BeritaZIWBKController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contents.BeritaZiwbk.list', [
            'title' => 'Berita ZI/WBK'
        ]);
    }

    public function data()
    {
        $list = BeritaZIWBK::with('user', 'list_kategori.list_kanal')->get();

        return DataTables::of($list)
            ->addIndexColumn()
            ->addColumn('id', function ($row) {
                return encrypt($row->id);
            })
            ->make();
    }

    public function tambah_data()
    {
        $list_kategori = ListKategori::all();
        $penulis = User::all();
        return view('contents.BeritaZiwbk.tambah-data', [
            'title' => 'Tambah Berita ZI/WBK',
            'list_kategori' => $list_kategori,
            'penulis' => $penulis,
        ]);
    }

    public function switchStatus(Request $request)
    {
        try {
            $encrypted_id = $request->id;
            $decrypted_id = decrypt($encrypted_id);
            $list_berita_ziwbk = BeritaZIWBK::findOrFail($decrypted_id);
            // dd($list_berita);

            $list_berita_ziwbk->status_publish = $request->value;

            if ($list_berita_ziwbk->isDirty()) {
                $list_berita_ziwbk->save();
            }

            if ($list_berita_ziwbk->wasChanged()) {
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
            'id_kategori' => 'required',
            'judul' => 'required',
            'isi_konten' => 'required',
            'tag_dinamis' => 'required',
            'id_penulis' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validasi untuk file gambar
        ], [
            'id_kategori.required' => 'Pilih Kategori wajib diisi',
            'judul.required' => 'Judul wajib diisi',
            'isi_konten.required' => 'Konten wajib diisi',
            'tag_dinamis.required' => 'Tag Dinamis wajib diisi',
            'id_penulis.required' => 'Penulis wajib diisi',
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
            $request->gambar->move(public_path('berita_ziwbk'), $gambarName);

            // Data yang akan disimpan
            $data = [
                'id_kategori' => $request->id_kategori,
                'judul' => $request->judul,
                'slug' => Str::slug($request->judul),
                'isi_konten' => $request->isi_konten,
                'tag_dinamis' => $request->tag_dinamis,
                'id_penulis' => $request->id_penulis,
                'status_publish' => '0',
                'status_video' => $request->has('status_video') ? true : false,
                'url_video' => $request->url_video,
                'gambar' => $gambarName,
                'caption_gambar' => $request->caption_gambar,
                'date' => now(),
            ];

            BeritaZIWBK::create($data);

            return response()->json(['status' => true], 200);
        }
    }

    public function edit(ListBerita $listBerita, $id)
    {
        $id = decrypt($id);
        $data = BeritaZIWBK::findOrFail($id);

        // Ambil data yang diperlukan
        $list_kategori = ListKategori::all();
        $penulis = User::all();
        // dd($data);
        // Return view dengan data yang diperlukan
        return view('contents.BeritaZiwbk.edit-data', [
            'title' => 'Edit Berita ZI/WBK',
            'data' => $data,
            'list_kategori' => $list_kategori,
            'penulis' => $penulis,
        ]);
    }

    public function update(Request $request, $id)
    {
        $id = decrypt($id);
        $validasi = Validator::make($request->all(), [
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048', // Validasi untuk file gambar
        ], [

            'gambar.image' => 'File harus berupa gambar',
            'gambar.mimes' => 'Format gambar harus jpeg, png, atau jpg',
            'gambar.max' => 'Ukuran gambar tidak boleh melebihi 2MB',
        ]);

        if ($validasi->fails()) {
            return response()->json(['erorrs' => $validasi->errors()]);
        } else {

            $data = [
                'id_kategori' => $request->id_kategori,
                'judul' => $request->judul,
                'slug' => Str::slug($request->judul),
                'isi_konten' => $request->isi_konten,
                'tag_dinamis' => $request->tag_dinamis,
                'id_penulis' => $request->id_penulis,
                'status_publish' => '0',
                'status_video' => $request->has('status_video') ? true : false,
                'url_video' => $request->url_video,
                'caption_gambar' => $request->caption_gambar,
                'date' => now(),
            ];


            if ($request->hasFile('gambar')) {
                $gambarName = time() . '.' . $request->file('gambar')->extension();
                $request->gambar->move(public_path('berita_ziwbk'), $gambarName);
                $data['gambar'] = $gambarName;
            }

            ListBerita::where('id', $id)->update($data);
            return response()->json(['status' => true], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\ListBerita  $listBerita
     * @return \Illuminate\Http\Response
     */
    
    public function delete(BeritaZIWBK $BeritaZIWBK, Request $request)
    {
        $berita_ziwbk_id = decrypt($request->id);

        try {
            $BeritaZIWBK = BeritaZIWBK::find($berita_ziwbk_id);

            $BeritaZIWBK->delete();


            if ($BeritaZIWBK->trashed()) {
                return response()->json(['status' => true], 200);
            }
            return response()->json(['status' => false], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
}
