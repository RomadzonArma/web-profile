<?php

namespace App\Http\Controllers;

use App\Model\Tautan;
use App\Model\ListKategori;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class TautanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_kategori = ListKategori::all();

        return view('contents.Tautan.list', [
            'title' => 'List Tautan',
            'list_kategori' => $list_kategori,
        ]);
    }

    public function switchStatus(Request $request)
    {
        try {
            $encrypted_id = $request->id;
            $decrypted_id = decrypt($encrypted_id);
            $list_webinar = Tautan::findOrFail($decrypted_id);
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

    public function data()
    {
        $list = Tautan::with('list_kategori.list_kanal')->get();

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
            'id_kategori' => 'required',
            'link_tautan' => 'required ',
        ], [
            'id_kategori.required' => 'Kategori wajib diisi',
            'link_tautan.required' => 'Link tautan wajib diisi',


        ]);

        if ($validasi->fails()) {
            return response()->json(['erorrs' => $validasi->errors()]);
        } else {

            $data = [
                'id_kategori' => $request->id_kategori,
                'link_tautan' => $request->link_tautan,
            ];
            Tautan::create($data);
            return response()->json(['status' => true], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Tautan  $tautan
     * @return \Illuminate\Http\Response
     */
    public function show(Tautan $tautan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Tautan  $tautan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = decrypt($id);
        $data =Tautan::where('id', $id)->first();
        return response()->json(['result' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Tautan  $tautan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = decrypt($id);

            $data = [
                'id_kategori' => $request->id_kategori_edit,
                'link_tautan' => $request->link_tautan_edit,
            ];

            Tautan::where('id', $id)->update($data);
            return response()->json(['status' => true], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Tautan  $tautan
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $list_tautan_id = decrypt($request->id);

        try {
            $list_tautan = Tautan::find($list_tautan_id);

            $list_tautan->delete();


            if ($list_tautan->trashed()) {
                return response()->json(['status' => true], 200);
            }
            return response()->json(['status' => false], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
}
