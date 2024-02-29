<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\Agenda;
use App\Model\ListKanal;
use App\Model\ListKategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contents.Agenda.list', [
            'title' => 'List Agenda'
        ]);
    }

    public function data()
    {
        $list = Agenda::with('user', 'list_kategori', 'list_kanal')->get();

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
            $list_agenda = Agenda::findOrFail($decrypted_id);
            // dd($list_agenda);

            $list_agenda->status_publish = $request->value;

            if ($list_agenda->isDirty()) {
                $list_agenda->save();
            }

            if ($list_agenda->wasChanged()) {
                return response()->json(['status' => true], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    public function tambah_data()
    {
        $list_kanal = ListKanal::all();
        $list_kategori = ListKategori::all();
        $penulis = User::all();
        return view('contents.Agenda.tambah-data', [
            'title' => 'Tambah Agenda',
            'list_kanal' => $list_kanal,
            'list_kategori' => $list_kategori,
            'penulis' => $penulis,
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
            'id_kanal' => 'required',
            'id_kategori' => 'required',
            'judul' => 'required',

            'konten' => 'required',

            'id_penulis' => 'required',
            'tanggal_agenda' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validasi untuk file gambar
        ], [
            'id_kanal.required' => 'Pilih Kanal wajib diisi',
            'id_kategori.required' => 'Pilih Kategori wajib diisi',
            'judul.required' => 'Judul wajib diisi',
            'konten.required' => 'Konten wajib diisi',
            'id_penulis.required' => 'Penulis wajib diisi',
            'tanggal_agenda.required' => 'Tanggal agenda wajib diisi',
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
            $request->gambar->move(public_path('agenda'), $gambarName);

            // Data yang akan disimpan
            $data = [
                'id_kanal' => $request->id_kanal,
                'id_kategori' => $request->id_kategori,
                'judul' => $request->judul,
                'slug' => Str::slug($request->judul),
                'konten' => $request->konten,
                'id_penulis' => $request->id_penulis,
                'gambar' => $gambarName,
                'tanggal_agenda' => $request->tanggal_agenda,
                'link_agenda' => $request->link_agenda,
            ];

            Agenda::create($data);

            return response()->json(['status' => true], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function show(Agenda $agenda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function edit ($id)
    {
        $id = decrypt($id);
        $data = Agenda::findOrFail($id);

        // Ambil data yang diperlukan
        $list_kanal = ListKanal::all();
        $list_kategori = ListKategori::all();
        $penulis = User::all();
        // dd($data);
        // Return view dengan data yang diperlukan
        return view('contents.Agenda.edit-data', [
            'title' => 'Edit Agenda',
            'data' => $data,
            'list_kanal' => $list_kanal,
            'list_kategori' => $list_kategori,
            'penulis' => $penulis,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agenda $agenda,$id)
    {
        $id = decrypt($id);
        $validasi = Validator::make($request->all(), [
            'id_kanal' => 'required',
            'id_kategori' => 'required',
            'judul' => 'required',

            'konten' => 'required',

            'id_penulis' => 'required',
            'tanggal_agenda' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validasi untuk file gambar
        ], [
            'id_kanal.required' => 'Pilih Kanal wajib diisi',
            'id_kategori.required' => 'Pilih Kategori wajib diisi',
            'judul.required' => 'Judul wajib diisi',
            'konten.required' => 'Konten wajib diisi',
            'id_penulis.required' => 'Penulis wajib diisi',
            'tanggal_agenda.required' => 'Tanggal agenda wajib diisi',
            'gambar.required' => 'Gambar wajib diisi',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.mimes' => 'Format gambar harus jpeg, png, atau jpg',
            'gambar.max' => 'Ukuran gambar tidak boleh melebihi 2MB',
        ]);

        if ($validasi->fails()) {
            return response()->json(['erorrs' => $validasi->errors()]);
        } else {
            // Proses upload gambar
            $gambarName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('agenda'), $gambarName);

            // Data yang akan disimpan
            $data = [
                'id_kanal' => $request->id_kanal,
                'id_kategori' => $request->id_kategori,
                'judul' => $request->judul,
                'slug' => Str::slug($request->judul),
                'konten' => $request->konten,
                'id_penulis' => $request->id_penulis,
                'gambar' => $gambarName,
                'tanggal_agenda' => $request->tanggal_agenda,
                'link_agenda' => $request->link_agenda,
            ];


            Agenda::where('id',$id)->update($data);
            return response()->json(['status' => true], 200);
        }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $list_agenda_id = decrypt($request->id);

        try {
            $list_agenda = Agenda::find($list_agenda_id);

            $list_agenda->delete();


            if ($list_agenda->trashed()) {
                return response()->json(['status' => true], 200);
            }
            return response()->json(['status' => false], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
}
