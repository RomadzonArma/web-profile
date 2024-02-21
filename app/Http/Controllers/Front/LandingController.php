<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        return view('contents.Front.index', [
        // return view('layouts.front.app', [
            'title' => 'Beranda'
        ]);
    }
}
