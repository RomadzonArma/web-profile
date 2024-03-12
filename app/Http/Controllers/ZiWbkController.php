<?php

namespace App\Http\Controllers;

use App\Model\ZiWbk;
use Illuminate\Http\Request;
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
        $list_kategori = ZiWbk::all();

        return view('contents.zi_wbk.list', [
            'title' => 'List ZI/WBK',
            'list_kategori' => $list_kategori,
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
                return response()->json(['status' => true], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    public function data()
    {
        $list = ZiWbk::with('list_kategori.list_kanal','sub_kategori.list_kategori')->get();

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\ZiWbk  $ziWbk
     * @return \Illuminate\Http\Response
     */
    public function show(ZiWbk $ziWbk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\ZiWbk  $ziWbk
     * @return \Illuminate\Http\Response
     */
    public function edit(ZiWbk $ziWbk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\ZiWbk  $ziWbk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ZiWbk $ziWbk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\ZiWbk  $ziWbk
     * @return \Illuminate\Http\Response
     */
    public function destroy(ZiWbk $ziWbk)
    {
        //
    }
}
