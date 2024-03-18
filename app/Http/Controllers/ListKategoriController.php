<?php

namespace App\Http\Controllers;

use App\Model\ListKanal;
use App\Model\ListKategori;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ListKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_kanal = ListKanal::all();
        // dd($list_kanal);
        return view('contents.ListKategori.list', [
            'title' => 'List Kategori',
            'list_kanal' => $list_kanal,
        ]);
    }
    public function data()
    {
        $list = ListKategori::with('list_kanal')->get();

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
            $list_kategori = ListKategori::findOrFail($decrypted_id);
            // dd($list_kategori);

            $list_kategori->status = $request->value;

            if ($list_kategori->isDirty()) {
                $list_kategori->save();
            }

            if ($list_kategori->wasChanged()) {
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

        $validasi = Validator::make($request->all(), [
            'id_kanal' => 'required',
            'nama_kategori' => 'required ',
        ], [
            'id_kanal.required' => 'Nama Kanal  wajib diisi',
            'nama_kategori.required' => 'Nama Kategori wajib diisi',


        ]);

        if ($validasi->fails()) {
            return response()->json(['erorrs' => $validasi->errors()]);
        } else {
            $data = [
                'id_kanal' => $request->id_kanal,
                'status' => '0',
                'nama_kategori' => $request->nama_kategori,
            ];
            ListKategori::create($data);
            return response()->json(['status' => true], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\ListKategori  $listKategori
     * @return \Illuminate\Http\Response
     */
    public function show(ListKategori $listKategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\ListKategori  $listKategori
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = decrypt($id);
        $data = ListKategori::where('id', $id)->first();
        return response()->json(['result' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\ListKategori  $listKategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = decrypt($id);


        $data = [
            'id_kanal' => $request->id_kanal_edit,
            'nama_kategori' => $request->nama_kategori_edit,
        ];

        ListKategori::where('id', $id)->update($data);
        return response()->json(['status' => true], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\ListKategori  $listKategori
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $list_kategori_id = decrypt($request->id);

        try {
            $list_kategori = Listkategori::find($list_kategori_id);

            $list_kategori->delete();


            if ($list_kategori->trashed()) {
                return response()->json(['status' => true], 200);
            }
            return response()->json(['status' => false], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
}
