<?php

namespace App\Http\Controllers;

use App\Model\ListKategori;
use App\Model\SubKategori;
use Illuminate\Http\Request;

class SubKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_kategori = ListKategori::all();
        // dd($list_kanal);
        return view('contents.subkategori.list', [
            'title' => 'Sub Kategori',
            'list_kategori' => $list_kategori,
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
        //
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
    public function edit(SubKategori $subKategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\SubKategori  $subKategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubKategori $subKategori)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\SubKategori  $subKategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubKategori $subKategori)
    {
        //
    }
}
