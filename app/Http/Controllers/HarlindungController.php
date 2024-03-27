<?php

namespace App\Http\Controllers;

use App\Model\Harlindung;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class HarlindungController extends Controller
{
    public function index(Request $request)
    {
        return view('contents.harlindung.list', [
            'title' => 'Harlindung',
        ]);
    }

    public function data()
    {
        $data = Harlindung::orderBy('id', 'desc')
            ->get();
        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([

                'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'foto_Harlindung' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'file_pdf' => 'nullable|mimes:pdf|max:5120',
                'video' => 'nullable|mimes:mp4,mov|max:10240',
            ]);

            $fotoName = null;
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                if ($file->isValid()) {
                    $name = time() . '_' . $file->getClientOriginalName();
                    $path = public_path('storage/uploads/Harlindung/image');
                    $file->move($path, $name);
                    $fotoName = 'storage/uploads/Harlindung/image/' . $name;
                } else {
                    throw new \Exception('Invalid file provided');
                }
            }
            $ImgName = null;
            if ($request->hasFile('foto_harlindung')) {
                $img = $request->file('foto_harlindung');
                if ($img->isValid()) {
                    $name = time() . '_' . $img->getClientOriginalName();
                    $path = public_path('storage/uploads/Harlindung/foto-Harlindung');
                    $img->move($path, $name);
                    $ImgName = 'storage/uploads/Harlindung/foto-Harlindung/' . $name;
                } else {
                    throw new \Exception('Invalid file provided');
                }
            }

            $videoPath = null;
            if ($request->hasFile('video')) {
                $video = $request->file('video');
                if ($video->isValid()) {
                    $videoName = time() . '_' . $video->getClientOriginalName();
                    $path = public_path('storage/uploads/Harlindung/video');
                    $video->move($path, $videoName);
                    $videoPath = 'storage/uploads/Harlindung/video/' . $videoName;
                } else {
                    throw new \Exception('Invalid video file provided');
                }
            }

            $filePath = null;
            if ($request->hasFile('file_pdf')) {
                $file = $request->file('file_pdf');
                if ($file->isValid()) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $path = public_path('storage/uploads/Harlindung/pdf');
                    $file->move($path, $fileName);
                    $filePath = 'storage/uploads/Harlindung/pdf/' . $fileName;
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
                'foto_harlindung' => $ImgName,
                'status_publish'  => 0,
            ];
            Harlindung::create($data);

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
                'foto_Harlindung' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'file_pdf' => 'nullable|mimes:pdf|max:5120',
                'video' => 'nullable|mimes:mp4,mov|max:10240',
            ]);

            $Harlindung = Harlindung::findOrFail($request->id);
            if ($request->hasFile('gambar') && $Harlindung->gambar) {
                if (file_exists(public_path($Harlindung->gambar))) {
                    unlink(public_path($Harlindung->gambar));
                }
            }

            if ($request->hasFile('video') && $Harlindung->video) {
                if (file_exists(public_path($Harlindung->video))) {
                    unlink(public_path($Harlindung->video));
                }
            }

            if ($request->hasFile('file_pdf') && $Harlindung->file_pdf) {
                if (file_exists(public_path($Harlindung->file_pdf))) {
                    unlink(public_path($Harlindung->file_pdf));
                }
            }

            if ($request->hasFile('foto_Harlindung') && $Harlindung->foto_Harlindung) {
                if (file_exists(public_path($Harlindung->foto_Harlindung))) {
                    unlink(public_path($Harlindung->foto_Harlindung));
                }
            }

            $fotoName = null;
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                if ($file->isValid()) {
                    $name = time() . '_' . $file->getClientOriginalName();
                    $path = public_path('storage/uploads/Harlindung/image');
                    $file->move($path, $name);
                    $fotoName = 'storage/uploads/Harlindung/image/' . $name;
                } else {
                    throw new \Exception('Invalid file provided');
                }
            }

            $videoPath = null;
            if ($request->hasFile('video')) {
                $video = $request->file('video');
                if ($video->isValid()) {
                    $videoName = time() . '_' . $video->getClientOriginalName();
                    $path = public_path('storage/uploads/Harlindung/video');
                    $video->move($path, $videoName);
                    $videoPath = 'storage/uploads/Harlindung/video/' . $videoName;
                } else {
                    throw new \Exception('Invalid video file provided');
                }
            }
            $filePath = null;
            if ($request->hasFile('file_pdf')) {
                $file = $request->file('file_pdf');
                if ($file->isValid()) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $path = public_path('storage/uploads/Harlindung/pdf');
                    $file->move($path, $fileName);
                    $filePath = 'storage/uploads/Harlindung/pdf/' . $fileName;
                } else {
                    throw new \Exception('Invalid video file provided');
                }
            }
            $imagePath = null;
            if ($request->hasFile('foto_harlindung')) {
                $image = $request->file('foto_harlindung');
                if ($image->isValid()) {
                    $imageName = time() . '_' . $image->getClientOriginalName(); // Fix variable name here
                    $path = public_path('storage/uploads/Harlindung/foto_Harlindung');
                    $image->move($path, $imageName);
                    $imagePath = 'storage/uploads/Harlindung/foto_Harlindung/' . $imageName;
                } else {
                    throw new \Exception('Invalid image file provided');
                }
            }

            $Harlindung->update([
                'nama_sub_program'      => $request->input('nama_sub_program'),
                'konten'      => $request->input('konten'),
                'link' => $request->input('link'),
                'link_video' => $request->input('link_video'),
                'gambar'       => $fotoName ?: $Harlindung->gambar,
                'video'      => $videoPath ?: $Harlindung->video,
                'file_pdf'  => $filePath ?: $Harlindung->file_pdf,
                'foto_harlindung' => $imagePath ?:  $Harlindung->foto_harlindung,
            ]);

            return response()->json(['status' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    public function switchStatus(Request $request)
    {
        try {
            $Harlindung = Harlindung::find($request->id);

            $Harlindung->status_publish = $request->value;

            if ($Harlindung->isDirty()) {
                $Harlindung->save();
            }

            if ($Harlindung->wasChanged()) {
                return response()->json(['status' => true], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            $Harlindung = Harlindung::findOrFail($request->id);

            // Menghapus file foto jika ada
            if ($Harlindung->gambar) {
                if (file_exists(public_path($Harlindung->gambar))) {
                    unlink(public_path($Harlindung->gambar));
                }
            }

            // Menghapus file video jika ada
            if ($Harlindung->video) {
                if (file_exists(public_path($Harlindung->video))) {
                    unlink(public_path($Harlindung->video));
                }
            }
            if ($Harlindung->file_pdf) {
                if (file_exists(public_path($Harlindung->file_pdf))) {
                    unlink(public_path($Harlindung->file_pdf));
                }
            }
            if ($Harlindung->foto_Harlindung) {
                if (file_exists(public_path($Harlindung->foto_Harlindung))) {
                    unlink(public_path($Harlindung->foto_Harlindung));
                }
            }

            // Hapus data Harlindung dari database
            $Harlindung->delete();

            return response()->json(['status' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
}

