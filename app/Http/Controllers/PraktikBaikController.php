<?php

namespace App\Http\Controllers;

use App\Model\PraktikBaik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use Yajra\DataTables\Facades\DataTables;

class PraktikBaikController extends Controller
{
    public function index(Request $request)
    {
        return view('contents.praktik.list', [
            'title' => 'praktik Baik Guru Penggrak',
        ]);
    }

    public function data()
    {
        $data = PraktikBaik::orderBy('id', 'desc')
            ->get();
        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    // public function store(Request $request)
    // {
    //     try {
    //         $fotoName = null;
    //         if ($request->hasFile('foto')) {
    //             $file = $request->file('foto');
    //             if ($file->isValid()) {
    //                 $name = time() . '_' . $file->getClientOriginalName();
    //                 $path = public_path('storage/uploads/praktik-image');
    //                 $file->move($path, $name);
    //                 $fotoName = 'storage/uploads/praktik-image/' . $name;
    //             } else {
    //                 throw new \Exception('Invalid file provided');
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

    //         $filePath = null;
    //         if ($request->hasFile('file_pdf')) {
    //             $file = $request->file('file_pdf');
    //             if ($file->isValid()) {
    //                 $fileName = time() . '_' . $file->getClientOriginalName();
    //                 $path = public_path('storage/uploads/praktik-pdf');
    //                 $file->move($path, $fileName);
    //                 $filePath = 'storage/uploads/praktik-pdf/' . $fileName;
    //             } else {
    //                 throw new \Exception('Invalid video file provided');
    //             }
    //         }
    //         $imagePath = null;
    //         if ($request->hasFile('foto_praktik')) {
    //             $image = $request->file('foto_praktik');
    //             if ($image->isValid()) {
    //                 $imageName = time() . '_' . $file->getClientOriginalName();
    //                 $path = public_path('storage/uploads/praktik/foto_praktik');
    //                 $image->move($path, $imageName);
    //                 $imagePath = 'storage/uploads/praktik/foto_praktik/' . $fileName;
    //             } else {
    //                 throw new \Exception('Invalid video file provided');
    //             }
    //         }

    //         $data = [
    //             'judul'      => $request->input('judul'),
    //             'link_video' => $request->input('link_video'),
    //             'foto'       => $fotoName,
    //             'video'      => $videoPath,
    //             'konten'    => $request->input('konten'),
    //             'file_pdf'  => $filePath,
    //             'konten'    => $request->input('konten'),
    //             'foto_praktik'  => $imagePath,
    //             // 'is_active'  => 0,
    //         ];
    //         PraktikBaik::create($data);

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
                if ($file->isValid()) {
                    $name = time() . '_' . $file->getClientOriginalName();
                    $path = public_path('storage/uploads/praktik-image');
                    $file->move($path, $name);
                    $fotoName = 'storage/uploads/praktik-image/' . $name;
                } else {
                    throw new \Exception('Invalid file provided');
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

            $filePath = null;
            if ($request->hasFile('file_pdf')) {
                $file = $request->file('file_pdf');
                if ($file->isValid()) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $path = public_path('storage/uploads/praktik-pdf');
                    $file->move($path, $fileName);
                    $filePath = 'storage/uploads/praktik-pdf/' . $fileName;
                } else {
                    throw new \Exception('Invalid PDF file provided');
                }
            }

            $imagePath = null;
            if ($request->hasFile('foto_praktik')) {
                $image = $request->file('foto_praktik');
                if ($image->isValid()) {
                    $imageName = time() . '_' . $image->getClientOriginalName(); // Fix variable name here
                    $path = public_path('storage/uploads/praktik/foto_praktik');
                    $image->move($path, $imageName);
                    $imagePath = 'storage/uploads/praktik/foto_praktik/' . $imageName;
                } else {
                    throw new \Exception('Invalid image file provided');
                }
            }

            $data = [
                'judul'      => $request->input('judul'),
                'link_video' => $request->input('link_video'),
                'foto'       => $fotoName,
                'video'      => $videoPath,
                'konten'     => $request->input('konten'),
                'file_pdf'   => $filePath,
                'foto_praktik' => $imagePath,
                // 'is_active'  => 0,
            ];
            PraktikBaik::create($data);

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

            $praktikBaik = PraktikBaik::findOrFail($request->id);
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

            if ($request->hasFile('foto_praktik') && $praktikBaik->foto_praktik) {
                if (file_exists(public_path($praktikBaik->foto_praktik))) {
                    unlink(public_path($praktikBaik->foto_praktik));
                }
            }

            $fotoName = null;
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                if ($file->isValid()) {
                    $name = time() . '_' . $file->getClientOriginalName();
                    $path = public_path('storage/uploads/praktik-image');
                    $file->move($path, $name);
                    $fotoName = 'storage/uploads/praktik-image/' . $name;
                } else {
                    throw new \Exception('Invalid file provided');
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
            $filePath = null;
            if ($request->hasFile('file_pdf')) {
                $file = $request->file('file_pdf');
                if ($file->isValid()) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $path = public_path('storage/uploads/praktik-pdf');
                    $file->move($path, $fileName);
                    $filePath = 'storage/uploads/praktik-pdf/' . $fileName;
                } else {
                    throw new \Exception('Invalid video file provided');
                }
            }
            $imagePath = null;
            if ($request->hasFile('foto_praktik')) {
                $image = $request->file('foto_praktik');
                if ($image->isValid()) {
                    $imageName = time() . '_' . $image->getClientOriginalName(); // Fix variable name here
                    $path = public_path('storage/uploads/praktik/foto_praktik');
                    $image->move($path, $imageName);
                    $imagePath = 'storage/uploads/praktik/foto_praktik/' . $imageName;
                } else {
                    throw new \Exception('Invalid image file provided');
                }
            }

            $praktikBaik->update([
                'judul'      => $request->input('judul'),
                'konten'      => $request->input('konten'),
                'link_video' => $request->input('link_video'),
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



    // public function update(Request $request)
    // {
    //     try {
    //         $praktik = PraktikBaik::find($request->id);
    //         $praktik->judul = $request->judul;
    //         // $praktik->link = $request->link;
    //         $praktik->link_video = $request->link_video;
    //         $praktik->save();

    //         if ($praktik->wasChanged()) {
    //             return response()->json(['status' => true], 200);
    //         }
    //     } catch (\Exception $e) {
    //         return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
    //     }
    // }

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
            $praktikBaik = PraktikBaik::findOrFail($request->id);

            // Menghapus file foto jika ada
            if ($praktikBaik->foto) {
                if (file_exists(public_path($praktikBaik->foto))) {
                    unlink(public_path($praktikBaik->foto));
                }
            }

            // Menghapus file video jika ada
            if ($praktikBaik->video) {
                if (file_exists(public_path($praktikBaik->video))) {
                    unlink(public_path($praktikBaik->video));
                }
            }
            if ($praktikBaik->file_pdf) {
                if (file_exists(public_path($praktikBaik->file_pdf))) {
                    unlink(public_path($praktikBaik->file_pdf));
                }
            }
            if ($praktikBaik->foto_praktik) {
                if (file_exists(public_path($praktikBaik->foto_praktik))) {
                    unlink(public_path($praktikBaik->foto_praktik));
                }
            }

            // Hapus data praktikBaik dari database
            $praktikBaik->delete();

            return response()->json(['status' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
}
