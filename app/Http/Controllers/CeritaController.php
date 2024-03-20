<?php

namespace App\Http\Controllers;

use App\Model\CeritaBaik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class CeritaController extends Controller
{
    public function index(Request $request)
    {
        return view('contents.cerita.list', [
            'title' => 'Cerita Praktik Baik',
        ]);
    }

    public function data()
    {
        $data = CeritaBaik::orderBy('id', 'desc')
            ->get();
        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function store(Request $request)
    {
        try {

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $name = time() . '_' . $file->getClientOriginalName();
                $path = public_path() . '/storage/uploads/cerita';
                if (!File::isDirectory($path)) {
                    File::makeDirectory($path, 0775, true, true);
                }
                if ($file->move($path, $name)) {
                    $foto = $name;
                }
                $fotoName = 'storage/uploads/cerita/' . $foto;
            }
            $videoPath = null;
            if ($request->hasFile('video')) {
                $video = $request->file('video');
                if ($video->isValid()) {
                    $videoName = time() . '_' . $video->getClientOriginalName();
                    $path = public_path('storage/uploads/cerita/video');
                    $video->move($path, $videoName);
                    $videoPath = 'storage/uploads/cerita/video/' . $videoName;
                } else {
                    throw new \Exception('Invalid video file provided');
                }
            }

            $data = [
                'judul' => $request->input('judul'),
                'link_video'  => $request->input('link_video'),
                'konten' => $request->input('konten'),
                'video'      => $videoPath,
            ];
            if (!empty($fotoName)) {
                $data['foto'] = $fotoName;
            }
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_id'] = Auth::user()->id;
            CeritaBaik::insert($data);

            return response()->json(['status' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request)
    {
        try {
            $cerita = CeritaBaik::find($request->id);
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $name = time() . '_' . $file->getClientOriginalName();
                $path = public_path() . '/storage/uploads/cerita';
                if (!File::isDirectory($path)) {
                    File::makeDirectory($path, 0775, true, true);
                }
                if ($file->move($path, $name)) {
                    $foto = $name;
                }

                if (!empty($cerita->foto)) {
                    if (File::exists(public_path($cerita->foto))) {
                        File::delete(public_path($cerita->foto));
                    }
                }
                $fotoName = 'storage/uploads/cerita/' . $foto;

                if (!empty($fotoName)) {
                    $cerita->foto = $fotoName;
                }
            }
            $videoPath = null;
            if ($request->hasFile('video')) {
                $video = $request->file('video');
                if ($video->isValid()) {
                    $videoName = time() . '_' . $video->getClientOriginalName();
                    $path = public_path('storage/uploads/praktik-video');
                    $video->move($path, $videoName);
                    $videoPath = 'storage/uploads/praktik-video/' . $videoName;
                } else {
                    throw new \Exception('Invalid video file provided');
                }
            }

            $cerita->judul = $request->judul;
            // $cerita->link = $request->link;
            $cerita->video = $videoName;
            $cerita->link_video = $request->link_video;
            $cerita->konten = $request->konten;
            $cerita->updated_at = date('Y-m-d H:i:s');
            $cerita->updated_id = Auth::user()->id;

            if ($cerita->isDirty()) {
                $cerita->save();
            }

            if ($cerita->wasChanged()) {
                return response()->json(['status' => true], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    public function switchStatus(Request $request)
    {
        try {
            $cerita = CeritaBaik::find($request->id);

            $cerita->is_active = $request->value;

            if ($cerita->isDirty()) {
                $cerita->save();
            }

            if ($cerita->wasChanged()) {
                return response()->json(['status' => true], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            $swiper = CeritaBaik::find($request->id);

            $swiper->delete();

            if ($swiper->trashed()) {
                return response()->json(['status' => true], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
}
