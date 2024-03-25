<?php

namespace App\Http\Controllers;

use App\Model\Berprestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
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

    // public function store(Request $request)
    // {
    //     try {

    //         if ($request->hasFile('foto')) {
    //             $file = $request->file('foto');
    //             $name = time() . '_' . $file->getClientOriginalName();
    //             $path = public_path() . '/storage/uploads/prestasi';
    //             if (!File::isDirectory($path)) {
    //                 File::makeDirectory($path, 0775, true, true);
    //             }
    //             if ($file->move($path, $name)) {
    //                 $foto = $name;
    //             }
    //             $fotoName = 'storage/uploads/prestasi/' . $foto;
    //         }

    //         $data = [
    //             'judul' => $request->input('judul'),
    //             'link' => $request->input('link'),
    //         ];
    //         if (!empty($fotoName)) {
    //             $data['foto'] = $fotoName;
    //         }
    //         $data['created_at'] = date('Y-m-d H:i:s');
    //         $data['created_id'] = Auth::user()->id;
    //         Berprestasi::insert($data);

    //         return response()->json(['status' => true], 200);
    //     } catch (\Exception $e) {
    //         return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
    //     }
    // }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'foto_praktik' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'file_pdf' => 'nullable|mimes:pdf|max:5120',
                'video' => 'nullable|mimes:mp4,mov|max:10240',
            ]);
            $fotoName = null;
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $name = time() . '_' . $file->getClientOriginalName();
                $path = public_path() . '/storage/uploads/prestasi';
                if (!File::isDirectory($path)) {
                    File::makeDirectory($path, 0775, true, true);
                }
                if ($file->move($path, $name)) {
                    $fotoName = 'storage/uploads/prestasi/' . $name;
                }
            }

            $videoPath = null;
            if ($request->hasFile('video')) {
                $video = $request->file('video');
                $videoName = time() . '_' . $video->getClientOriginalName();
                $videoPath = 'storage/uploads/prestasi/' . $videoName;
                $video->move(public_path('storage/uploads/prestasi'), $videoName);
            }
            $filePath = null;
            if ($request->hasFile('file_pdf')) {
                $file = $request->file('file_pdf');
                if ($file->isValid()) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $path = public_path('storage/uploads/prestasi/pdf');
                    $file->move($path, $fileName);
                    $filePath = 'storage/uploads/prestasi/pdf' . $fileName;
                } else {
                    throw new \Exception('Invalid video file provided');
                }
            }
            $imagePath = null;
            if ($request->hasFile('foto_praktik')) {
                $image = $request->file('foto_praktik');
                if ($image->isValid()) {
                    $imageName = time() . '_' . $image->getClientOriginalName(); // Fix variable name here
                    $path = public_path('storage/uploads/prestasi/foto-praktik');
                    $image->move($path, $imageName);
                    $imagePath = 'storage/uploads/prestasi/foto-praktik' . $imageName;
                } else {
                    throw new \Exception('Invalid image file provided');
                }
            }


            $data = [
                'judul' => $request->input('judul'),
                'link' => $request->input('link'),
                'foto' => $fotoName,
                'video' => $videoPath,
                'file_pdf' => $filePath,
                'foto_praktik' => $imagePath,
                'created_at' => now(),
                'created_id' => Auth::user()->id,
            ];

            Berprestasi::create($data);

            return response()->json(['status' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }


    // public function update(Request $request)
    // {
    //     try {
    //         $request->validate([
    //             'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    //             'foto_praktik' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    //             'file_pdf' => 'nullable|mimes:pdf|max:5120',
    //             'video' => 'nullable|mimes:mp4,mov|max:10240',
    //         ]);

    //         $prestasi = Berprestasi::find($request->id);

    //         if ($request->hasFile('foto')) {
    //             $file = $request->file('foto');
    //             $name = time() . '_' . $file->getClientOriginalName();
    //             $path = public_path() . '/storage/uploads/prestasi';
    //             if (!File::isDirectory($path)) {
    //                 File::makeDirectory($path, 0775, true, true);
    //             }
    //             if ($file->move($path, $name)) {
    //                 $foto = $name;
    //             }

    //             if (!empty($prestasi->foto)) {
    //                 if (File::exists(public_path($prestasi->foto))) {
    //                     File::delete(public_path($prestasi->foto));
    //                 }
    //             }
    //             $fotoName = 'storage/uploads/prestasi/' . $foto;

    //             if (!empty($fotoName)) {
    //                 $prestasi->foto = $fotoName;
    //             }
    //         }
    //         if ($request->hasFile('video')) {
    //             $file = $request->file('video');
    //             $name = time() . '_' . $file->getClientOriginalName();
    //             $path = public_path() . '/storage/uploads/prestasi';
    //             if (!File::isDirectory($path)) {
    //                 File::makeDirectory($path, 0775, true, true);
    //             }
    //             if ($file->move($path, $name)) {
    //                 $video = $name;
    //             }

    //             if (!empty($prestasi->video)) {
    //                 if (File::exists(public_path($prestasi->video))) {
    //                     File::delete(public_path($prestasi->video));
    //                 }
    //             }
    //             $videoName = 'storage/uploads/prestasi/' . $video;

    //             if (!empty($videoName)) {
    //                 $prestasi->video = $videoName;
    //             }
    //         }
    //         if ($request->hasFile('file_pdf')) {
    //             // Handling file_pdf update
    //             // Code remains the same as your implementation
    //             if ($prestasi->file_pdf) {
    //                 $oldPdfPath = public_path($prestasi->file_pdf);
    //                 if (file_exists($oldPdfPath)) {
    //                     unlink($oldPdfPath);
    //                 }
    //             }

    //             $filePdf = $request->file('file_pdf');
    //             $pdfName = time() . '_' . $filePdf->getClientOriginalName();
    //             $filePdf->move(public_path('storage/uploads/prestasi/pdf'), $pdfName);
    //             $prestasi->file_pdf = 'storage/uploads/prestasi/pdf' . $pdfName;
    //         }
    //         if ($request->hasFile('foto_praktik')) {
    //             // Handling file_pdf update
    //             // Code remains the same as your implementation
    //             if ($prestasi->foto_praktik) {
    //                 $oldPdfPath = public_path($prestasi->foto_praktik);
    //                 if (file_exists($oldPdfPath)) {
    //                     unlink($oldPdfPath);
    //                 }
    //             }

    //             $fileImage = $request->file('foto_praktik');
    //             $imgName = time() . '_' . $fileImage->getClientOriginalName();
    //             $fileImage->move(public_path('storage/uploads/prestasi/foto-praktik'), $imgName);
    //             $prestasi->foto_praktik = 'storage/uploads/prestasi/foto-praktik' . $imgName;
    //         }


    //         $prestasi->judul = $request->judul;
    //         $prestasi->link = $request->link;
    //         $prestasi->updated_at = date('Y-m-d H:i:s');
    //         $prestasi->updated_id = Auth::user()->id;

    //         if ($prestasi->isDirty()) {
    //             $prestasi->save();
    //         }

    //         if ($prestasi->wasChanged()) {
    //             return response()->json(['status' => true], 200);
    //         }
    //     } catch (\Exception $e) {
    //         return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
    //     }
    // }


    public function update(Request $request)
    {
        try {
            $request->validate([
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'foto_praktik' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'file_pdf' => 'nullable|mimes:pdf|max:5120',
                'video' => 'nullable|mimes:mp4,mov|max:10240',
            ]);

            $praktikBaik = Berprestasi::findOrFail($request->id);
            if ($request->hasFile('foto') && $praktikBaik->foto) {
                if (file_exists(public_path($praktikBaik->foto))) {
                    unlink(public_path($praktikBaik->foto));
                }
            }

            if ($request->hasFile('video') && $praktikBaik->video) {
                if (file_exists(public_path($praktikBaik->video))) {
                    unlink(public_path($praktikBaik->video));
                }
            }

            if ($request->hasFile('file_pdf') && $praktikBaik->file_pdf) {
                if (file_exists(public_path($praktikBaik->file_pdf))) {
                    unlink(public_path($praktikBaik->file_pdf));
                }
            }

            $fotoName = null;
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $name = time() . '_' . $file->getClientOriginalName();
                $path = public_path() . '/storage/uploads/prestasi';
                if (!File::isDirectory($path)) {
                    File::makeDirectory($path, 0775, true, true);
                }
                if ($file->move($path, $name)) {
                    $fotoName = 'storage/uploads/prestasi/' . $name;
                }
            }

            $videoPath = null;
            if ($request->hasFile('video')) {
                $video = $request->file('video');
                $videoName = time() . '_' . $video->getClientOriginalName();
                $videoPath = 'storage/uploads/prestasi/' . $videoName;
                $video->move(public_path('storage/uploads/prestasi'), $videoName);
            }
            $filePath = null;
            if ($request->hasFile('file_pdf')) {
                $file = $request->file('file_pdf');
                if ($file->isValid()) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $path = public_path('storage/uploads/prestasi/pdf');
                    $file->move($path, $fileName);
                    $filePath = 'storage/uploads/prestasi/pdf' . $fileName;
                } else {
                    throw new \Exception('Invalid video file provided');
                }
            }
            $imagePath = null;
            if ($request->hasFile('foto_praktik')) {
                $image = $request->file('foto_praktik');
                if ($image->isValid()) {
                    $imageName = time() . '_' . $image->getClientOriginalName(); // Fix variable name here
                    $path = public_path('storage/uploads/prestasi/foto-praktik');
                    $image->move($path, $imageName);
                    $imagePath = 'storage/uploads/prestasi/foto-praktik' . $imageName;
                } else {
                    throw new \Exception('Invalid image file provided');
                }
            }
            $praktikBaik->update([
                'judul'      => $request->input('judul'),
                'konten'      => $request->input('konten'),
                'link' => $request->input('link'),
                'foto'       => $fotoName ?: $praktikBaik->foto,
                'video'      => $videoPath ?: $praktikBaik->video,
                'file_pdf'  => $filePath ?: $praktikBaik->file_pdf,
                'foto_praktik' => $imagePath ?:  $praktikBaik->foto_praktik,
            ]);

            return response()->json(['status' => true], 200);
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
