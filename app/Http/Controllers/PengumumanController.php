<?php

namespace App\Http\Controllers;

use App\Model\Pengumuman;
use App\Model\ListKategori;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contents.Pengumuman.list', [
            'title' => 'List Pengumuman'
        ]);
    }


    public function data()
    {
        $list = Pengumuman::with('list_kategori.list_kanal')->orderByDesc('created_at')->get();
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
            $list_pengumuman = Pengumuman::findOrFail($decrypted_id);
            // dd($list_webinar);

            $list_pengumuman->status_publish = $request->value;

            if ($list_pengumuman->isDirty()) {
                $list_pengumuman->save();
            }

            if ($list_pengumuman->wasChanged()) {
                return response()->json(['status' => true], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    public function tambah_data()
    {
        $list_kategori = ListKategori::all();
        return view('contents.Pengumuman.tambah-data', [
            'title' => 'Tambah Pengumuman',
            'list_kategori' => $list_kategori,
        ]);
    }


    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $validasi = Validator::make($request->all(), [
            'id_kategori' => 'required',
            'judul' => 'required',
            'konten' => 'required',
            'date' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048', // Validasi untuk file gambar
        ], [
            'id_kategori.required' => 'Pilih Kategori wajib diisi',
            'judul.required' => 'Judul wajib diisi',
            'konten.required' => 'Konten wajib diisi',
            'date.required' => 'Tanggal agenda wajib diisi',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.mimes' => 'Format gambar harus jpeg, png, atau jpg',
            'gambar.max' => 'Ukuran gambar tidak boleh melebihi 2MB',
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()]);
        } else {
            // Proses upload gambar
            $gambarName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('pengumuman'), $gambarName);


            $filePDFName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('file-pengumuman'), $filePDFName);
            // Data yang akan disimpan
            $data = [
                'id_kategori' => $request->id_kategori,
                'judul' => $request->judul,
                'konten' => $request->konten,
                'gambar' => $gambarName,
                'file' => $filePDFName,
                'date' => $request->date,
            ];

            Pengumuman::create($data);

            return response()->json(['status' => true], 200);
        }
    }

    public function edit($id)
    {
        $id = decrypt($id);
        $data = Pengumuman::findOrFail($id);

        // Ambil data yang diperlukan
        $list_kategori = ListKategori::all();

        // Return view dengan data yang diperlukan
        return view('contents.Pengumuman.edit-data', [
            'title' => 'Edit Pengumuman',
            'data' => $data,
            'list_kategori' => $list_kategori,
        ]);
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function show(Pengumuman $pengumuman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
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
                'konten' => $request->konten,
                'date' => $request->date,
            ];


            if ($request->hasFile('gambar')) {
                $gambarName = time() . '.' . $request->file('gambar')->extension();
                $request->gambar->move(public_path('pengumuman'), $gambarName);
                $data['gambar'] = $gambarName;
            }
            if ($request->hasFile('file')) {
                $filePDFName = time() . '.' . $request->file->extension();
                $request->file->move(public_path('file-pengumuman'), $filePDFName);
                $data['file'] = $filePDFName;
            }

            Pengumuman::where('id', $id)->update($data);
            return response()->json(['status' => true], 200);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $list_pengumuman_id = decrypt($request->id);

        try {
            $list_pengumuman = Pengumuman::find($list_pengumuman_id);

            $list_pengumuman->delete();


            if ($list_pengumuman->trashed()) {
                return response()->json(['status' => true], 200);
            }
            return response()->json(['status' => false], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
}
