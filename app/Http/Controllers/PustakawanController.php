<?php

namespace App\Http\Controllers;

use App\Model\Pustakawan;
use App\Model\RefPustakawan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PustakawanController extends Controller
{
    public function index(Request $request)
    {
        return view('contents.pustakawan.list', [
            'title' => 'Pustakawan',
        ]);
    }

    public function data()
    {
        $data = Pustakawan::orderBy('id', 'desc')->with('ref_pustakawan');
        return DataTables::of($data)->addIndexColumn()->make(true);
    }
    // public function data()
    // {
    //     $data = Pustakawan::orderBy('id', 'desc')->with('ref_psutakawan')->get(); // Pilih kolom yang diinginkan

    //     return DataTables::of($data)->addIndexColumn()
    //     // ->addcolumn('file_pdf', function($data){
    //     //     $file_pdf = $data->ref_pustaakawan->file_pdf ?? '';
    //     //     return '<button class="btn btn-sm btn-success btnOpen">Buka PDF</button>';
    //     // })
    //     ->make(true);
    // }


    public function store(Request $request)
    {
        try {
            $request->validate([
                'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'judul' => 'required',
                // 'foto_praktik' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'file_pdf' => 'nullable|mimes:pdf|max:5120',
            ]);

            $fotoName = null;
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                if ($file->isValid()) {
                    $name = time() . '_' . $file->getClientOriginalName();
                    $path = public_path('storage/uploads/pustakawan/image');
                    $file->move($path, $name);
                    $fotoName = 'storage/uploads/pustakawan/image/' . $name;
                } else {
                    throw new \Exception('Invalid file provided');
                }
            }
            $filePath = null;
            if ($request->hasFile('file_pdf')) {
                $file = $request->file('file_pdf');
                if ($file->isValid()) {
                    $name = time() . '_' . $file->getClientOriginalName();
                    $path = public_path('storage/uploads/pustakawan/file-pdf');
                    $file->move($path, $name);
                    $filePath = 'storage/uploads/pustakawan/file-pdf/' . $name;
                } else {
                    throw new \Exception('Invalid file provided');
                }
            }

            $data = Pustakawan::create([
                'judul'         => $request->input('judul'),
                'gambar'        => $fotoName,
                'konten'        => $request->input('konten'),
                'file_pdf'      => $filePath,
                // 'is_active'  => 0,
            ]);

            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = public_path('storage/uploads/pustakawan/ref_image');
                    $file->move($path, $filename);
                    $filePath = 'storage/uploads/pustakawan/ref_image/' . $filename;
                    RefPustakawan::create([
                        'id_pustakawan' => $data->id,
                        'image' => $filePath,
                    ]);
                }
            }

            return response()->json(['status' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }


    public function update(Request $request)
    {
        try {
            $pustakawan = Pustakawan::findOrFail($request->id);

            $request->validate([
                'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'judul' => 'required',
                // 'foto_praktik' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'file_pdf' => 'nullable|mimes:pdf|max:5120',
            ]);
            if ($request->hasFile('file_pdf')) {
                if ($pustakawan->file_pdf && file_exists(public_path($pustakawan->file_pdf))) {
                    unlink(public_path($pustakawan->file_pdf));
                }
            }
            if ($request->hasFile('gambar')) {
                if ($pustakawan->gambar && file_exists(public_path($pustakawan->gambar))) {
                    unlink(public_path($pustakawan->gambar));
                }
            }

            $fotoName = $pustakawan->gambar;
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                if ($file->isValid()) {
                    $name = time() . '_' . $file->getClientOriginalName();
                    $path = public_path('storage/uploads/pustakawan/image');
                    $file->move($path, $name);
                    $fotoName = 'storage/uploads/pustakawan/image/' . $name;
                } else {
                    throw new \Exception('Invalid file provided');
                }
            }

            $filePath = $pustakawan->file_pdf;
            if ($request->hasFile('file_pdf')) {
                $file = $request->file('file_pdf');
                if ($file->isValid()) {
                    $name = time() . '_' . $file->getClientOriginalName();
                    $path = public_path('storage/uploads/pustakawan/file-pdf');
                    $file->move($path, $name);
                    $filePath = 'storage/uploads/pustakawan/file-pdf/' . $name;
                } else {
                    throw new \Exception('Invalid file provided');
                }
            }

            $pustakawan->update([
                'judul'         => $request->input('judul'),
                'gambar'        => $fotoName,
                'konten'        => $request->input('konten'),
                'file_pdf'      => $filePath,
                // 'is_active'  => 0,
            ]);

            if ($request->hasFile('image')) {

                $existingImages = RefPustakawan::where('id_pustakawan', $request->id)->pluck('image')->toArray();

                if (!empty($existingImages)) {
                    foreach ($existingImages as $existingImage) {
                        $imagePath = public_path('storage/uploads/pustakawan/ref_image') . '/' . $existingImage;
                        if (file_exists($imagePath)) {
                            unlink($imagePath);
                        }
                    }
                }

                RefPustakawan::where('id_pustakawan', $request->id)->delete();

                foreach ($request->file('image') as $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = public_path('storage/uploads/pustakawan/ref_image');
                    $file->move($path, $filename);
                    $filePath = 'storage/uploads/pustakawan/ref_image/' . $filename;
                    RefPustakawan::create([
                        'id_pustakawan' => $pustakawan->id,
                        'image' => $filePath,
                    ]);
                }
            }

            return response()->json(['status' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }



    public function switchStatus(Request $request)
    {
        try {
            $pustakawan = Pustakawan::find($request->id);

            $pustakawan->is_active = $request->value;

            if ($pustakawan->isDirty()) {
                $pustakawan->save();
            }

            if ($pustakawan->wasChanged()) {
                return response()->json(['status' => true], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            $praktikBaik = Pustakawan::findOrFail($request->id);

            // Menghapus file foto jika ada
            if ($praktikBaik->gambar) {
                if (file_exists(public_path($praktikBaik->gambar))) {
                    unlink(public_path($praktikBaik->gambar));
                }
            }


            if ($praktikBaik->file_pdf) {
                if (file_exists(public_path($praktikBaik->file_pdf))) {
                    unlink(public_path($praktikBaik->file_pdf));
                }
            }


            // Hapus data praktikBaik dari database
            $praktikBaik->delete();

            return response()->json(['status' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
    public function getImages(Request $request,  $id = null)
    {
        try {
            $images = RefPustakawan::where('id_pustakawan', $id)->pluck('image')->toArray();
            // dd($images);
            return response()->json(['status' => true, 'images' => $images], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
}
