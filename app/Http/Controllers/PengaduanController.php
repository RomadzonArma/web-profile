<?php

namespace App\Http\Controllers;

use App\Model\ListKategori;
use Illuminate\Http\Request;

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
}
