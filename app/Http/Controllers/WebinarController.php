<?php

namespace App\Http\Controllers;

use App\Model\Webinar;
use App\Model\ListKategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class WebinarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contents.Webinar.list', [
            'title' => 'List Webinar'
        ]);
    }

    public function data()
    {
        $list = Webinar::with('list_kategori.list_kanal')->get();

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
            $list_webinar = Webinar::findOrFail($decrypted_id);
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

    public function tambah_data()
    {
        $list_kategori = ListKategori::all();
        return view('contents.Webinar.tambah-data', [
            'title' => 'Tambah Webinar',
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
    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $validasi = Validator::make($request->all(), [
            // 'id_kategori' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal_webinar' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validasi untuk file gambar
        ], [
            // 'id_kategori.required' => 'Pilih Kategori wajib diisi',
            'judul.required' => 'Judul wajib diisi',
            'deskripsi.required' => 'Konten wajib diisi',
            'tanggal_webinar.required' => 'Tanggal agenda wajib diisi',
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
            $request->gambar->move(public_path('webinar'), $gambarName);

            // Data yang akan disimpan
            $data = [
                // 'id_kategori' => $request->id_kategori,
                'judul' => $request->judul,
                'slug' => Str::slug($request->judul),
                'deskripsi' => $request->deskripsi,
                'gambar' => $gambarName,
                'tanggal_webinar' => $request->tanggal_webinar,
                'link_webinar' => $request->link_webinar,
            ];

            Webinar::create($data);

            return response()->json(['status' => true], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Webinar  $webinar
     * @return \Illuminate\Http\Response
     */
    public function show(Webinar $webinar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Webinar  $webinar
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = decrypt($id);
        $data = Webinar::findOrFail($id);

        // Ambil data yang diperlukan
        $list_kategori = ListKategori::all();

        // Return view dengan data yang diperlukan
        return view('contents.Webinar.edit-data', [
            'title' => 'Edit Webinar',
            'data' => $data,
            'list_kategori' => $list_kategori,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Webinar  $webinar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Webinar $webinar, $id)
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
                // 'id_kategori' => $request->id_kategori,
                'judul' => $request->judul,
                'slug' => Str::slug($request->judul),
                'deskripsi' => $request->deskripsi,
                'tanggal_webinar' => $request->tanggal_webinar,
                'link_webinar' => $request->link_webinar,
            ];


            if ($request->hasFile('gambar')) {
                $gambarName = time() . '.' . $request->file('gambar')->extension();
                $request->gambar->move(public_path('webinar'), $gambarName);
                $data['gambar'] = $gambarName;
            }

            Webinar::where('id', $id)->update($data);
            return response()->json(['status' => true], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Webinar  $webinar
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $list_webinar_id = decrypt($request->id);

        try {
            $list_webinar = Webinar::find($list_webinar_id);

            $list_webinar->delete();


            if ($list_webinar->trashed()) {
                return response()->json(['status' => true], 200);
            }
            return response()->json(['status' => false], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
}
