<?php

namespace App\Http\Controllers;

use App\Model\ListBerita;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ListBeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contents.ListBerita.list', [
            'title' => 'List Berita'
        ]);
    }

    public function data()
    {
        $list = ListBerita::all();

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
     * @param  \App\Model\ListBerita  $listBerita
     * @return \Illuminate\Http\Response
     */
    public function show(ListBerita $listBerita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\ListBerita  $listBerita
     * @return \Illuminate\Http\Response
     */
    public function edit(ListBerita $listBerita)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\ListBerita  $listBerita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ListBerita $listBerita)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\ListBerita  $listBerita
     * @return \Illuminate\Http\Response
     */
    public function destroy(ListBerita $listBerita)
    {
        //
    }
}
