<?php

namespace App\Http\Controllers;

use App\Model\Berprestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class BerprestasiController extends Controller
{
    public function index(Request $request)
    {
        return view('contents.berprestasi.list', [
            'title' => 'KSPSTK Berprestasi',
        ]);
    }

    public function data()
    {
        $data = Berprestasi::orderBy('id', 'desc')
            ->get();
        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function store(Request $request)
    {
        try {

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $name = time() . '_' . $file->getClientOriginalName();
                $path = public_path() . '/storage/uploads/prestasi';
                if (!File::isDirectory($path)) {
                    File::makeDirectory($path, 0775, true, true);
                }
                if ($file->move($path, $name)) {
                    $foto = $name;
                }
                $fotoName = 'storage/uploads/prestasi/' . $foto;
            }

            $data = [
                'judul' => $request->input('judul'),
                'link' => $request->input('link'),
            ];
            if (!empty($fotoName)) {
                $data['foto'] = $fotoName;
            }
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_id'] = Auth::user()->id;
            Berprestasi::insert($data);

            return response()->json(['status' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request)
    {
        try {
            $prestasi = Berprestasi::find($request->id);
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $name = time() . '_' . $file->getClientOriginalName();
                $path = public_path() . '/storage/uploads/prestasi';
                if (!File::isDirectory($path)) {
                    File::makeDirectory($path, 0775, true, true);
                }
                if ($file->move($path, $name)) {
                    $foto = $name;
                }

                if (!empty($prestasi->foto)) {
                    if (File::exists(public_path($prestasi->foto))) {
                        File::delete(public_path($prestasi->foto));
                    }
                }
                $fotoName = 'storage/uploads/prestasi/' . $foto;

                if (!empty($fotoName)) {
                    $prestasi->foto = $fotoName;
                }
            }
            if ($request->hasFile('video')) {
                $file = $request->file('video');
                $name = time() . '_' . $file->getClientOriginalName();
                $path = public_path() . '/storage/uploads/prestasi';
                if (!File::isDirectory($path)) {
                    File::makeDirectory($path, 0775, true, true);
                }
                if ($file->move($path, $name)) {
                    $video = $name;
                }

                if (!empty($prestasi->video)) {
                    if (File::exists(public_path($prestasi->video))) {
                        File::delete(public_path($prestasi->video));
                    }
                }
                $videoName = 'storage/uploads/prestasi/' . $video;

                if (!empty($videoName)) {
                    $prestasi->video = $videoName;
                }
            }

            $prestasi->judul = $request->judul;
            $prestasi->link = $request->link;
            $prestasi->updated_at = date('Y-m-d H:i:s');
            $prestasi->updated_id = Auth::user()->id;

            if ($prestasi->isDirty()) {
                $prestasi->save();
            }

            if ($prestasi->wasChanged()) {
                return response()->json(['status' => true], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    public function switchStatus(Request $request)
    {
        try {
            $prestasi = Berprestasi::find($request->id);

            $prestasi->is_active = $request->value;

            if ($prestasi->isDirty()) {
                $prestasi->save();
            }

            if ($prestasi->wasChanged()) {
                return response()->json(['status' => true], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            $prestasi = Berprestasi::find($request->id);

            $prestasi->deleted_id = Auth::user()->id;
            $prestasi->save();
            $prestasi->delete();

            if ($prestasi->trashed()) {
                return response()->json(['status' => true], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
}
