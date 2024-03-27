<?php

namespace App\Http\Controllers;

use App\Model\Tendik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use Yajra\DataTables\Facades\DataTables;

class TendikController extends Controller
{
    public function index(Request $request)
    {
        return view('contents.tendik.list', [
            'title' => 'Tendik',
        ]);
    }

    public function data()
    {
        $data = Tendik::orderBy('id', 'desc')
            ->get();
        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'foto_tendik' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'file_pdf' => 'nullable|mimes:pdf|max:5120',
                'video' => 'nullable|mimes:mp4,mov|max:10240',
            ]);

            $fotoName = null;
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                if ($file->isValid()) {
                    $name = time() . '_' . $file->getClientOriginalName();
                    $path = public_path('storage/uploads/tendik/image');
                    $file->move($path, $name);
                    $fotoName = 'storage/uploads/tendik/image/' . $name;
                } else {
                    throw new \Exception('Invalid file provided');
                }
            }
            $ImgName = null;
            if ($request->hasFile('foto_tendik')) {
                $img = $request->file('foto_tendik');
                if ($img->isValid()) {
                    $name = time() . '_' . $img->getClientOriginalName();
                    $path = public_path('storage/uploads/tendik/foto-tendik');
                    $img->move($path, $name);
                    $ImgName = 'storage/uploads/tendik/foto-tendik/' . $name;
                } else {
                    throw new \Exception('Invalid file provided');
                }
            }

            $videoPath = null;
            if ($request->hasFile('video')) {
                $video = $request->file('video');
                if ($video->isValid()) {
                    $videoName = time() . '_' . $video->getClientOriginalName();
                    $path = public_path('storage/uploads/tendik/video');
                    $video->move($path, $videoName);
                    $videoPath = 'storage/uploads/tendik/video/' . $videoName;
                } else {
                    throw new \Exception('Invalid video file provided');
                }
            }

            $filePath = null;
            if ($request->hasFile('file_pdf')) {
                $file = $request->file('file_pdf');
                if ($file->isValid()) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $path = public_path('storage/uploads/tendik/pdf');
                    $file->move($path, $fileName);
                    $filePath = 'storage/uploads/tendik/pdf/' . $fileName;
                } else {
                    throw new \Exception('Invalid PDF file provided');
                }
            }

            $data = [
                'nama_sub_program'      => $request->input('nama_sub_program'),
                'link' => $request->input('link'),
                'link_video' => $request->input('link_video'),
                'gambar'       => $fotoName,
                'video'      => $videoPath,
                'konten'     => $request->input('konten'),
                'file_pdf'   => $filePath,
                'foto_tendik' => $ImgName,
                'status_publish'  => 0,
            ];
            Tendik::create($data);

            return response()->json(['status' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'foto_tendik' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'file_pdf' => 'nullable|mimes:pdf|max:5120',
                'video' => 'nullable|mimes:mp4,mov|max:10240',
            ]);

            $Tendik = Tendik::findOrFail($request->id);
            if ($request->hasFile('gambar') && $Tendik->gambar) {
                if (file_exists(public_path($Tendik->gambar))) {
                    unlink(public_path($Tendik->gambar));
                }
            }

            if ($request->hasFile('video') && $Tendik->video) {
                if (file_exists(public_path($Tendik->video))) {
                    unlink(public_path($Tendik->video));
                }
            }

            if ($request->hasFile('file_pdf') && $Tendik->file_pdf) {
                if (file_exists(public_path($Tendik->file_pdf))) {
                    unlink(public_path($Tendik->file_pdf));
                }
            }

            if ($request->hasFile('foto_tendik') && $Tendik->foto_tendik) {
                if (file_exists(public_path($Tendik->foto_tendik))) {
                    unlink(public_path($Tendik->foto_tendik));
                }
            }

            $fotoName = null;
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                if ($file->isValid()) {
                    $name = time() . '_' . $file->getClientOriginalName();
                    $path = public_path('storage/uploads/tendik/image');
                    $file->move($path, $name);
                    $fotoName = 'storage/uploads/tendik/image/' . $name;
                } else {
                    throw new \Exception('Invalid file provided');
                }
            }

            $videoPath = null;
            if ($request->hasFile('video')) {
                $video = $request->file('video');
                if ($video->isValid()) {
                    $videoName = time() . '_' . $video->getClientOriginalName();
                    $path = public_path('storage/uploads/tendik/video');
                    $video->move($path, $videoName);
                    $videoPath = 'storage/uploads/tendik/video/' . $videoName;
                } else {
                    throw new \Exception('Invalid video file provided');
                }
            }
            $filePath = null;
            if ($request->hasFile('file_pdf')) {
                $file = $request->file('file_pdf');
                if ($file->isValid()) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $path = public_path('storage/uploads/tendik/pdf');
                    $file->move($path, $fileName);
                    $filePath = 'storage/uploads/tendik/pdf/' . $fileName;
                } else {
                    throw new \Exception('Invalid video file provided');
                }
            }
            $imagePath = null;
            if ($request->hasFile('foto_tendik')) {
                $image = $request->file('foto_tendik');
                if ($image->isValid()) {
                    $imageName = time() . '_' . $image->getClientOriginalName(); // Fix variable name here
                    $path = public_path('storage/uploads/tendik/foto_tendik');
                    $image->move($path, $imageName);
                    $imagePath = 'storage/uploads/tendik/foto_tendik/' . $imageName;
                } else {
                    throw new \Exception('Invalid image file provided');
                }
            }

            $Tendik->update([
                'nama_sub_program'      => $request->input('nama_sub_program'),
                'konten'      => $request->input('konten'),
                'link' => $request->input('link'),
                'link_video' => $request->input('link_video'),
                'gambar'       => $fotoName ?: $Tendik->gambar,
                'video'      => $videoPath ?: $Tendik->video,
                'file_pdf'  => $filePath ?: $Tendik->file_pdf,
                'foto_tendik' => $imagePath ?:  $Tendik->foto_tendik,
            ]);

            return response()->json(['status' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    public function switchStatus(Request $request)
    {
        try {
            $tendik = Tendik::find($request->id);

            $tendik->status_publish = $request->value;

            if ($tendik->isDirty()) {
                $tendik->save();
            }

            if ($tendik->wasChanged()) {
                return response()->json(['status' => true], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            $Tendik = Tendik::findOrFail($request->id);

            // Menghapus file foto jika ada
            if ($Tendik->gambar) {
                if (file_exists(public_path($Tendik->gambar))) {
                    unlink(public_path($Tendik->gambar));
                }
            }

            // Menghapus file video jika ada
            if ($Tendik->video) {
                if (file_exists(public_path($Tendik->video))) {
                    unlink(public_path($Tendik->video));
                }
            }
            if ($Tendik->file_pdf) {
                if (file_exists(public_path($Tendik->file_pdf))) {
                    unlink(public_path($Tendik->file_pdf));
                }
            }
            if ($Tendik->foto_tendik) {
                if (file_exists(public_path($Tendik->foto_tendik))) {
                    unlink(public_path($Tendik->foto_tendik));
                }
            }

            // Hapus data Tendik dari database
            $Tendik->delete();

            return response()->json(['status' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
}
