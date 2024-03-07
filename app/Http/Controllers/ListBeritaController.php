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
        $list = ListBerita::with('user', 'list_kategori.list_kanal')->get();

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
        return view('contents.ListBerita.tambah-data', [
            'title' => 'Tambah Berita',
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
            'id_kategori' => 'required',
            'judul' => 'required',
            'lead' => 'required',
            'isi_konten' => 'required',
            'tag_dinamis' => 'required',
            'id_penulis' => 'required',
            'date' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validasi untuk file gambar
        ], [
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

            return response()->json(['status' => true], 200);
        }
    }

    public function edit(ListBerita $listBerita, $id)
    {
        $id = decrypt($id);
        $data = ListBerita::findOrFail($id);

        // Ambil data yang diperlukan
        $list_kategori = ListKategori::all();
        $penulis = User::all();
        // dd($data);
        // Return view dengan data yang diperlukan
        return view('contents.ListBerita.edit-data', [
            'title' => 'Edit Berita',
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
                'lead' => $request->lead,
                'isi_konten' => $request->isi_konten,
                'tag_dinamis' => $request->tag_dinamis,
                'id_penulis' => $request->id_penulis,
                'status_video' => $request->has('status_video') ? true : false,
                'url_video' => $request->url_video,
                'status_headline' => $request->has('status_headline') ? true : false,
                'caption_gambar' => $request->caption_gambar,
                'date' => $request->date,
            ];


            if ($request->hasFile('gambar')) {
                $gambarName = time() . '.' . $request->file('gambar')->extension();
                $request->gambar->move(public_path('list_berita'), $gambarName);
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
