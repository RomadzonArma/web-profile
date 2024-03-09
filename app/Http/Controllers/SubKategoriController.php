<?php

namespace App\Http\Controllers;

use App\Model\SubKategori;
use App\Model\ListKategori;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class SubKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_kategori = ListKategori::with('list_kanal')->get();
        // dd($list_kanal);
        return view('contents.subkategori.list', [
            'title' => 'Sub Kategori',
            'list_kategori' =>  $list_kategori,
        ]);
    }

    public function data()
    {
        $list = SubKategori::with('list_kategori.list_kanal')->get();

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
            $sub_kategori = SubKategori::findOrFail($decrypted_id);
            // dd($sub_kategori);

            $sub_kategori->status_publish = $request->value;

            if ($sub_kategori->isDirty()) {
                $sub_kategori->save();
            }

            if ($sub_kategori->wasChanged()) {
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
            'id_kategori' => 'required',
            'sub_kategori' => 'required ',
        ], [
            'id_kategori.required' => 'Kategori wajib diisi',
            'sub_kategori.required' => 'Sub Kategori wajib diisi',


        ]);

        if ($validasi->fails()) {
            return response()->json(['erorrs' => $validasi->errors()]);
        } else {

            $data = [
                'id_kategori' => $request->id_kategori,
                'sub_kategori' => $request->sub_kategori,
            ];
            SubKategori::create($data);
            return response()->json(['status' => true], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\SubKategori  $subKategori
     * @return \Illuminate\Http\Response
     */
    public function show(SubKategori $subKategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\SubKategori  $subKategori
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = decrypt($id);
        $data = SubKategori::where('id', $id)->first();
        return response()->json(['result' => $data]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\SubKategori  $subKategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubKategori $subKategori, $id)
    {
        $id = decrypt($id);

        $data = [
            'id_kategori' => $request->id_kategori_edit,
            'sub_kategori' => $request->sub_kategori_edit,
        ];

        SubKategori::where('id', $id)->update($data);
        return response()->json(['status' => true], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\SubKategori  $subKategori
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $sub_kategori_id = decrypt($request->id);

        try {
            $sub_kategori = SubKategori::find($sub_kategori_id);

            $sub_kategori->delete();


            if ($sub_kategori->trashed()) {
                return response()->json(['status' => true], 200);
            }
            return response()->json(['status' => false], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
}
