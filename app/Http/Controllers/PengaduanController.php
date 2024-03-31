<?php

namespace App\Http\Controllers;

use App\Model\ListKategori;
use App\Model\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PengaduanController extends Controller
{
    public function index()
    {
        $list_kategori = ListKategori::all();

        return view('contents.pengaduan.list', [
            'title' => 'List pengaduan',
            'list_kategori' => $list_kategori,
        ]);
    }

    public function switchStatus(Request $request)
    {
        try {
            $encrypted_id = $request->id;
            $decrypted_id = decrypt($encrypted_id);
            $pengaduan = Pengaduan::findOrFail($decrypted_id);
            // dd($pengaduan);

            $pengaduan->status_publish = $request->value;

            if ($pengaduan->isDirty()) {
                $pengaduan->save();
            }

            if ($pengaduan->wasChanged()) {
                return response()->json(['status' => true], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    public function data()
    {
        $list = Pengaduan::with('list_kategori.list_kanal')->get();

        return DataTables::of($list)
            ->addIndexColumn()
            ->addColumn('id', function ($row) {
                return encrypt($row->id);
            })
            ->make();
    }

    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'id_kategori' => 'required',
            'link_pengaduan' => 'required ',
        ], [
            'id_kategori.required' => 'Kategori wajib diisi',
            'link_pengaduan.required' => 'Link pengaduan wajib diisi',


        ]);

        if ($validasi->fails()) {
            return response()->json(['erorrs' => $validasi->errors()]);
        } else {

            $data = [
                'id_kategori' => $request->id_kategori,
                'link_pengaduan' => $request->link_pengaduan,
                'status_publish' => 1,
            ];
            Pengaduan::create($data);
            return response()->json(['status' => true], 200);
        }
    }

    public function edit($id)
    {
        $id = decrypt($id);
        $data = Pengaduan::where('id', $id)->first();
        return response()->json(['result' => $data]);
    }

    public function update(Request $request, $id)
    {
        $id = decrypt($id);

        $data = [
            'id_kategori' => $request->id_kategori_edit,
            'link_pengaduan' => $request->link_pengaduan_edit,
        ];

        Pengaduan::where('id', $id)->update($data);
        return response()->json(['status' => true], 200);
    }

    public function delete(Request $request)
    {
        $list_pengaduan_id = decrypt($request->id);

        try {
            $list_pengaduan = Pengaduan::find($list_pengaduan_id);

            $list_pengaduan->delete();


            if ($list_pengaduan->trashed()) {
                return response()->json(['status' => true], 200);
            }
            return response()->json(['status' => false], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
}
