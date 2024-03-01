<?php

namespace App\Http\Controllers;

use App\Model\ListKategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Model\Informasi_publik;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Model\Informasi_publik_has_file;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class InformasiPublikController extends Controller
{
    public function index(Request $request)
    {
        return view('contents.informasi.list', [
            'title' => 'Informasi Publik'
        ]);
    }

    public function data(Request $request)
    {
        $list = Informasi_publik::with('list_kategori.list_kanal')->get();

        return DataTables::of($list)
            ->addIndexColumn()
            ->addColumn('id', function ($row) {
                return encrypt($row->id);
            })
            ->make();
    }


    public function switchStatus(Request $request)
    {
        try {
            $encrypted_id = $request->id;
            $decrypted_id = decrypt($encrypted_id);
            $list_webinar = Informasi_publik::findOrFail($decrypted_id);
            // dd($list_webinar);

            $list_webinar->status_publish = $request->value;

            if ($list_webinar->isDirty()) {
                $list_webinar->save();
            }

            if ($list_webinar->wasChanged()) {
                return response()->json(['status' => true], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }


    public function store(Request $request)
    {
        $list_kategori = ListKategori::all();
        return view('contents.informasi.store', [
            'title' => 'Tambah Informasi Publik',
            'list_kategori' => $list_kategori,
        ]);
    }
    public function update(Request $request, $id)
    {
        $id = decrypt($id);
        $data = Informasi_publik::findOrFail($id);

        $list_kategori = ListKategori::all();

        return view('contents.informasi.update', [
            'title' => 'Edit Informasi Publik',
            'data' => $data,
            'list_kategori' => $list_kategori,
        ]);
    }
    public function do_update(Request $request, $id)
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
                'konten' => $request->konten,
                'tag' => $request->tag,
                'caption_gambar' => $request->caption_gambar,
            ];


            if ($request->hasFile('gambar')) {
                $gambarName = time() . '.' . $request->file('gambar')->extension();
                $request->gambar->move(public_path('informasi_publik'), $gambarName);
                $data['gambar'] = $gambarName;
            }

            Informasi_publik::where('id', $id)->update($data);
            return response()->json(['status' => true], 200);
        }
    }

    public function do_store(Request $request)
    {
        // Validasi data yang diterima dari form
        $validasi = Validator::make($request->all(), [
            'judul' => 'required',
            'id_kategori' => 'required',
            'konten' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validasi untuk file gambar
        ], [
            'id_kategori.required' => 'Pilih Kategori wajib diisi',
            'judul.required' => 'Judul wajib diisi',
            'konten.required' => 'Konten wajib diisi',
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
            $request->gambar->move(public_path('informasi_publik'), $gambarName);

            // Data yang akan disimpan
            $data = [
                'id_kategori' => $request->id_kategori,
                'judul' => $request->judul,
                'slug' => Str::slug($request->judul),
                'konten' => $request->konten,
                'gambar' => $gambarName,
                'tag' => $request->tag,
                'caption_gambar' => $request->caption_gambar,
            ];

            Informasi_publik::create($data);

            return response()->json(['status' => true], 200);
        }
    }

    public function delete(Request $request)
    {
        $informasi_id = decrypt($request->id);

        try {
            $informasi = Informasi_publik::find($informasi_id);

            $informasi->delete();

            Informasi_publik_has_file::where('informasi_publik_id', $informasi_id)->delete();
            Storage::deleteDirectory("public/uploads/informasi_publik/{$informasi_id}");

            if ($informasi->trashed()) {
                return response()->json(['status' => true], 200);
            }
            return response()->json(['status' => false], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
}
