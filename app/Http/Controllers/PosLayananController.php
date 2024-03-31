<?php

namespace App\Http\Controllers;

use App\Model\Tautan;
use App\Model\ListKategori;
use App\Model\PosLayanan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PosLayananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_pos_layanan = PosLayanan::all();

        return view('contents.pos_layanan.list', [
            'title' => 'Pos Layanan',
            'list_pos_layanan' => $list_pos_layanan,
        ]);
    }

    public function switchStatus(Request $request)
    {
        try {
            $encrypted_id = $request->id;
            $decrypted_id = decrypt($encrypted_id);
            $pos_layanan = PosLayanan::findOrFail($decrypted_id);
            // dd($pos_layanan);

            $pos_layanan->status_publish = $request->value;

            if ($pos_layanan->isDirty()) {
                $pos_layanan->save();
            }

            if ($pos_layanan->wasChanged()) {
                return response()->json(['status' => true], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    public function data()
    {
        $list = PosLayanan::all();

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
            'tim_kerja' => 'required',
            'nama_pos' => 'required ',
            'tautan_dok' => 'required ',
        ], [
            'tim_kerja.required' => 'Tim kerja wajib diisi',
            'nama_pos.required' => 'Nama pos wajib diisi',
            'tautan_dok.required' => 'Tautan dokumen wajib diisi',


        ]);

        if ($validasi->fails()) {
            return response()->json(['erorrs' => $validasi->errors()]);
        } else {

            $data = [
                'tim_kerja' => $request->tim_kerja,
                'nama_pos' => $request->nama_pos,
                'tautan_dok' => $request->tautan_dok,
            ];
            PosLayanan::create($data);
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
        $data = PosLayanan::where('id', $id)->first();
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
            'tim_kerja' => $request->tim_kerja_edit,
            'nama_pos' => $request->nama_pos_edit,
            'tautan_dok' => $request->tautan_dok_edit,
        ];

        PosLayanan::where('id', $id)->update($data);
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
        $list_poslayanan_id = decrypt($request->id);

        try {
            $list_poslayanan = PosLayanan::find($list_poslayanan_id);

            $list_poslayanan->delete();


            if ($list_poslayanan->trashed()) {
                return response()->json(['status' => true], 200);
            }
            return response()->json(['status' => false], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
}
