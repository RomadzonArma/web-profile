<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InformasiPublikController extends Controller
{
    public function index(Request $request)
    {
        return view('contents.informasi.list', [
            'title' => 'Informasi Publik'
        ]);
    }
}
