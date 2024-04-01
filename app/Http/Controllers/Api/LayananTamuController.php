<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

class LayananTamuController extends Controller
{
    public function getJawaban()
    {
        try {
            
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
}
