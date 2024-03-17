<?php

namespace App\Http\Controllers;

use App\Model\ListKategori;
use App\Model\ZiWbk;
use App\Model\SubKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ZiWbkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_kategori = ListKategori::all();
        $sub = SubKategori::all();
        // dd($sub);
        return view('contents.zi_wbk.index', [
            'title' => 'List ZI/WBK',
            'kategori' => $list_kategori,
            'sub' => $sub,
        ]);
    }


    public function switchStatus(Request $request)
    {
        try {
            $encrypted_id = $request->id;
            $decrypted_id = decrypt($encrypted_id);
            $zi_wbk = ZiWbk::findOrFail($decrypted_id);
            // dd($zi_wbk);

            $zi_wbk->status_publish = $request->value;

            if ($zi_wbk->isDirty()) {
                $zi_wbk->save();
            }

            if ($zi_wbk->wasChanged()) {
                return response()->json(['status_publish' => true], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status_publish' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    public function data(Request $request)
    {
        $list = ZiWbk::with('list_kategori.list_kanal', 'sub_kategori')->get();
        // dd($list);
        return DataTables::of($list)
            ->addIndexColumn()
            ->addColumn('id', function ($row) {
                return encrypt($row->id);
            })

            ->make();
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'id_kategori'    => 'required',
                // 'link_kategori'  => 'required',
                // 'addMoreInputFields.*.link' => 'required'
            ]);

            DB::beginTransaction();

            $kategori = $request->id_kategori;
            $link_kategori = $request->link_kategori;

            foreach ($request->links as $link) {
                ZiWbk::create([
                    'id_kategori'     => $kategori,
                    'id_subkategori'  => $link['id_subkategori'] ?? null,
                    'link'            => $link['link'],
                    'link_kategori'   => $link_kategori,
                    'status_publish'   => 0,
                ]);
            }


            DB::commit();

            return response()->json(['status' => true, 'msg' => 'Data video berhasil disimpan'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
    // public function store(Request $request)
    // {
    //     try {
    //         $request->validate([
    //             'id_kategori'    => 'required',
    //             // 'link_kategori'  => 'required',
    //             // 'addMoreInputFields.*.link' => 'required'
    //         ]);

    //         DB::beginTransaction();

    //         $sub = SubKategori::create([
    //             'id_kategori'       => $request->id_kategori,
    //             'link_kategori'     => $request->link_kategori,
    //             'sub_kategori'      => $request->sub_kategori,
    //             'status_publish'    => 0,
    //         ]);

    //         if ($request->has('addMoreInputFields') && is_array($request->addMoreInputFields)) {
    //             foreach ($request->addMoreInputFields as $key => $value) {
    //                 ZiWbk::create([
    //                     'id_subkategori' => $sub->id,
    //                     'link'           => $value['link'],
    //                 ]);
    //             }
    //         }

    //         DB::commit();

    //         return response()->json(['status' => true, 'msg' => 'Data video berhasil disimpan'], 200);
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
    //     }
    // }


    // public function update(Request $request)
    // {
    //     try {
    //         $sub_id = decrypt($request->id);
    //         $request->validate([
    //             'id_kategori'    => 'required',
    //             // // 'sub_kategori'   => 'required',
    //             // 'addMoreInputFields.*.link' => 'required'
    //         ]);

    //         DB::beginTransaction();

    //         $sub = SubKategori::findOrFail($sub_id);
    //         $sub->update([
    //             'id_kategori'    => $request->id_kategori,
    //             'sub_kategori'   => implode(',', $request->sub_kategori),
    //             'link_kategori'  => $request->link_kategori,
    //         ]);

    //         // Hapus semua data ZiWbk yang terkait dengan subkategori ini
    //         ZiWbk::where('id_subkategori', $sub->id)->delete();

    //         // Tambahkan kembali data ZiWbk yang baru
    //         if ($request->has('addMoreInputFields') && is_array($request->addMoreInputFields)) {
    //             foreach ($request->addMoreInputFields as $key => $value) {
    //                 ZiWbk::create([
    //                     'id_subkategori' => $sub->id,
    //                     'link'           => $value['link'],
    //                 ]);
    //             }
    //         }

    //         DB::commit();

    //         return response()->json(['status' => true, 'msg' => 'Data video berhasil diperbarui'], 200);
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
    //     }
    // }

    public function update(Request $request)
    {
        try {
            $zi_id = decrypt($request->id);
            $ziWbk = ZiWbk::findOrFail($zi_id);

            $request->validate([
                'id_kategori' => 'required',
                // 'link_kategori' => 'required',
                // 'addMoreInputFields.*.link' => 'required'
            ]);

            $kategori = $request->id_kategori;
            $link_kategori = $request->link_kategori;

            foreach ($request->links as $link) {
                $ziWbk->update([
                    'id_kategori' => $kategori,
                    'id_subkategori' => $link['id_subkategori'] ?? null,
                    'link' => $link['link'],
                    'link_kategori' => $link_kategori,
                ]);
            }

            return response()->json(['status' => true, 'msg' => 'Data video berhasil diperbarui'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $zi_id = decrypt($request->id);
            $ziWbk = ZiWbk::findOrFail($zi_id);
            $ziWbk->delete();

            return response()->json(['status' => true, 'msg' => 'Data video berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }


    // public function destroy(Request $request)
    // {
    //     try {
    //         DB::beginTransaction();
    //         $sub_id = decrypt($request->id);
    //         $sub = SubKategori::findOrFail($sub_id);
    //         $sub->delete();

    //         // Hapus juga data ZiWbk yang terkait
    //         ZiWbk::where('id_subkategori', $sub->id)->delete();

    //         DB::commit();

    //         return response()->json(['status' => true, 'msg' => 'Data video berhasil dihapus'], 200);
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
    //     }
    // }

    public function getLink(Request $request)
    {
        try {
            $link = ZiWbk::where('id_subkategori', $request->id)->pluck('link')->toArray();
            return response()->json(['status' => true, 'link' => $link], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
}
