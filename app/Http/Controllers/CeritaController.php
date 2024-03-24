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
            $request->validate([
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'foto_praktik' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'file_pdf' => 'nullable|mimes:pdf|max:5120',
                'video' => 'nullable|mimes:mp4,mov|max:10240',
            ]);

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
            $filePath = null;
            if ($request->hasFile('file_pdf')) {
                $file = $request->file('file_pdf');
                if ($file->isValid()) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $path = public_path('storage/uploads/cerita/pdf');
                    $file->move($path, $fileName);
                    $filePath = 'storage/uploads/cerita/pdf' . $fileName;
                } else {
                    throw new \Exception('Invalid video file provided');
                }
            }
            $imagePath = null;
            if ($request->hasFile('foto_praktik')) {
                $image = $request->file('foto_praktik');
                if ($image->isValid()) {
                    $imageName = time() . '_' . $image->getClientOriginalName(); // Fix variable name here
                    $path = public_path('storage/uploads/cerita/foto-praktik');
                    $image->move($path, $imageName);
                    $imagePath = 'storage/uploads/cerita/foto-praktik' . $imageName;
                } else {
                    throw new \Exception('Invalid image file provided');
                }
            }

            $data = [
                'judul' => $request->input('judul'),
                'link_video'  => $request->input('link_video'),
                'konten' => $request->input('konten'),
                'video'      => $videoPath,
                'file_pdf' => $filePath,
                'foto_praktik' => $imagePath,
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
            $request->validate([
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'foto_praktik' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'file_pdf' => 'nullable|mimes:pdf|max:5120',
                'video' => 'nullable|mimes:mp4,mov|max:10240',
            ]);
            $cerita = CeritaBaik::find($request->id);

            if (!$cerita) {
                return response()->json(['status' => false, 'msg' => 'Cerita not found.'], 404);
            }

            if ($request->hasFile('foto')) {
                // Handling foto update
                // Code remains the same as your implementation

                if (!empty($cerita->foto)) {
                    if (File::exists(public_path($cerita->foto))) {
                        File::delete(public_path($cerita->foto));
                    }
                }
                $cerita->foto = $fotoName;
            }

            if ($request->hasFile('video')) {
                // Handling video update
                // Code remains the same as your implementation
                $cerita->video = $videoPath;
            }

            if ($request->hasFile('file_pdf')) {
                // Handling file_pdf update
                // Code remains the same as your implementation
                if ($cerita->file_pdf) {
                    $oldPdfPath = public_path($cerita->file_pdf);
                    if (file_exists($oldPdfPath)) {
                        unlink($oldPdfPath);
                    }
                }

                $filePdf = $request->file('file_pdf');
                $pdfName = time() . '_' . $filePdf->getClientOriginalName();
                $filePdf->move(public_path('storage/uploads/cerita/pdf'), $pdfName);
                $cerita->file_pdf = 'storage/uploads/cerita/pdf/' . $pdfName;
            }
            if ($request->hasFile('foto_praktik')) {
                // Handling file_pdf update
                // Code remains the same as your implementation
                if ($cerita->foto_praktik) {
                    $oldImagePath = public_path($cerita->foto_praktik);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                $filePdf = $request->file('file_pdf');
                $imgName = time() . '_' . $filePdf->getClientOriginalName();
                $filePdf->move(public_path('storage/uploads/cerita/pdf'), $imgName);
                $cerita->foto_praktik = 'storage/uploads/cerita/pdf/' . $imgName;
            }

            // Update other fields
            $cerita->judul = $request->judul;
            // $cerita->link = $request->link;
            $cerita->video = $videoPath;
            $cerita->link_video = $request->link_video;
            $cerita->konten = $request->konten;
            $cerita->updated_at = now();
            $cerita->updated_id = Auth::user()->id;

            // Save changes if any
            $cerita->save();

            return response()->json(['status' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    // public function update(Request $request)
    // {
    //     try {
    //         $cerita = CeritaBaik::find($request->id);
    //         if ($request->hasFile('foto')) {
    //             $file = $request->file('foto');
    //             $name = time() . '_' . $file->getClientOriginalName();
    //             $path = public_path() . '/storage/uploads/cerita';
    //             if (!File::isDirectory($path)) {
    //                 File::makeDirectory($path, 0775, true, true);
    //             }
    //             if ($file->move($path, $name)) {
    //                 $foto = $name;
    //             }

    //             if (!empty($cerita->foto)) {
    //                 if (File::exists(public_path($cerita->foto))) {
    //                     File::delete(public_path($cerita->foto));
    //                 }
    //             }
    //             $fotoName = 'storage/uploads/cerita/' . $foto;

    //             if (!empty($fotoName)) {
    //                 $cerita->foto = $fotoName;
    //             }
    //         }
    //         $videoPath = null;
    //         if ($request->hasFile('video')) {
    //             $video = $request->file('video');
    //             if ($video->isValid()) {
    //                 $videoName = time() . '_' . $video->getClientOriginalName();
    //                 $path = public_path('storage/uploads/praktik-video');
    //                 $video->move($path, $videoName);
    //                 $videoPath = 'storage/uploads/praktik-video/' . $videoName;
    //             } else {
    //                 throw new \Exception('Invalid video file provided');
    //             }
    //         }
    //         if ($cerita->file_pdf) {
    //             $oldPdfPath = public_path($cerita->file_pdf);
    //             if (file_exists($oldPdfPath)) {
    //                 unlink($oldPdfPath);
    //             }
    //         } if ($request->hasFile('file_pdf')) {
    //             $filePdf = $request->file('file_pdf');
    //             $pdfName = time() . '_' . $filePdf->getClientOriginalName();
    //             $filePdf->move(public_path('storage/uploads/cerita/pdf'), $pdfName);
    //             $data['file_pdf'] = 'storage/uploads/cerita/pdf' . $pdfName;
    //         }

    //         $cerita->judul = $request->judul;
    //         // $cerita->link = $request->link;
    //         $cerita->video = $videoPath;
    //         $cerita->link_video = $request->link_video;
    //         $cerita->konten = $request->konten;
    //         $cerita->updated_at = date('Y-m-d H:i:s');
    //         $cerita->updated_id = Auth::user()->id;

    //         if ($cerita->isDirty()) {
    //             $cerita->save();
    //         }

    //         if ($cerita->wasChanged()) {
    //             return response()->json(['status' => true], 200);
    //         }
    //     } catch (\Exception $e) {
    //         return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
    //     }
    // }

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
