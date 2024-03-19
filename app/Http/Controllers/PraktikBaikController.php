<?php

namespace App\Http\Controllers;

use App\Model\PraktikBaik;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PraktikBaikController extends Controller
{
    public function index(Request $request)
    {
        return view('contents.praktik.list', [
            'title' => 'praktik Praktik Baik',
        ]);
    }

    public function data()
    {
        $data = PraktikBaik::orderBy('id', 'desc')
            ->get();
        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function store(Request $request)
    {
        try {
            $data = [
                'judul' => $request->input('judul'),
                'link_video' => $request->input('link_video'),
            ];
            PraktikBaik::insert($data);

            return response()->json(['status' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request)
    {
        try {
            $praktik = PraktikBaik::find($request->id);
            $praktik->judul = $request->judul;
            // $praktik->link = $request->link;
            $praktik->link_video = $request->link_video;
            $praktik->save();

            if ($praktik->wasChanged()) {
                return response()->json(['status' => true], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    public function switchStatus(Request $request)
    {
        try {
            $praktik = PraktikBaik::find($request->id);

            $praktik->is_active = $request->value;

            if ($praktik->isDirty()) {
                $praktik->save();
            }

            if ($praktik->wasChanged()) {
                return response()->json(['status' => true], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            $swiper = PraktikBaik::find($request->id);

            $swiper->delete();

            if ($swiper->trashed()) {
                return response()->json(['status' => true], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
}
