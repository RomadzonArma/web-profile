<?php

namespace App\Http\Controllers;

use App\Model\ListKanal;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ListKanalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contents.ListKanal.list', [
            'title' => 'List Kanal'
        ]);
    }

    public function data()
    {
        $list = ListKanal::all();

        return DataTables::of($list)
            ->addIndexColumn()
            ->addColumn('id', function ($row) {
                return encrypt($row->id);
            })
            ->make();
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
            'nama_kanal' => 'required',
            'status' => 'required ',
        ], [
            'nama_kanal.required' => 'Nama Kanal  wajib diisi',
            'status.required' => 'Status Kanal wajib diisi',


        ]);

        if ($validasi->fails()) {
            return response()->json(['erorrs' => $validasi->errors()]);
        } else {
            $data = [
                'nama_kanal' => $request->nama_kanal,
                'status' => $request->status,
            ];

            ListKanal::create($data);
            return response()->json(['success' => "Berhasil menyimpan data"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\ListKanal  $listKanal
     * @return \Illuminate\Http\Response
     */
    public function show(ListKanal $listKanal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\ListKanal  $listKanal
     * @return \Illuminate\Http\Response
     */
    public function edit(ListKanal $listKanal ,$id)
    {
        $id = decrypt($id);
        $data = ListKanal::where('id', $id)->first();
        return response()->json(['result' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\ListKanal  $listKanal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ListKanal $listKanal, $id)
    {
        $id = decrypt($id);
        $validasi = Validator::make($request->all(), [
            'nama_kanal' => 'required',
            'status' => 'required ',
        ], [
            'nama_kanal.required' => 'Nama Kanal  wajib diisi',
            'status.required' => 'Status Kanal wajib diisi',


        ]);

        if ($validasi->fails()) {
            return response()->json(['erorrs' => $validasi->errors()]);
        } else {
            $data = [
                'nama_kanal' => $request->nama_kanal,
                'status' => $request->status,
            ];

            ListKanal::where('id',$id)->update($data);
            return response()->json(['success' => "Berhasil menyimpan data"]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\ListKanal  $listKanal
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $list_kanal_id = decrypt($request->id);

        try {
            $list_kanal = ListKanal::find($list_kanal_id);

            $list_kanal->delete();


            if ($list_kanal->trashed()) {
                return response()->json(['status' => true], 200);
            }
            return response()->json(['status' => false], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
}
