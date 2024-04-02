<?php

namespace App\Http\Controllers;

use App\Model\Laboran;
use App\Model\RefLaboran;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LaboranController extends Controller
{
    public function index(Request $request)
    {
        return view('contents.laboran.list', [
            'title' => 'Laboran',
        ]);
    }

    public function data()
    {
        $data = Laboran::orderBy('id', 'desc')->with('refLaboran');
        return DataTables::of($data)->addIndexColumn()->make(true);
    }


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
                    $path = public_path('storage/uploads/laboran/image');
                    $file->move($path, $name);
                    $fotoName = 'storage/uploads/laboran/image/' . $name;
                } else {
                    throw new \Exception('Invalid file provided');
                }
            }
            $filePath = null;
            if ($request->hasFile('file_pdf')) {
                $file = $request->file('file_pdf');
                if ($file->isValid()) {
                    $name = time() . '_' . $file->getClientOriginalName();
                    $path = public_path('storage/uploads/laboran/file-pdf');
                    $file->move($path, $name);
                    $filePath = 'storage/uploads/laboran/file-pdf/' . $name;
                } else {
                    throw new \Exception('Invalid file provided');
                }
            }

            $data = Laboran::create([
                'judul'         => $request->input('judul'),
                'gambar'        => $fotoName,
                'konten'        => $request->input('konten'),
                'file_pdf'      => $filePath,
                'is_active'  => 0,
            ]);

            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = public_path('storage/uploads/laboran/ref_image');
                    $file->move($path, $filename);
                    $filePath = 'storage/uploads/laboran/ref_image/' . $filename;
                    RefLaboran::create([
                        'id_Laboran' => $data->id,
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
            $Laboran = Laboran::findOrFail($request->id);

            $request->validate([
                'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'judul' => 'required',
                // 'foto_praktik' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'file_pdf' => 'nullable|mimes:pdf|max:5120',
            ]);

            if ($request->hasFile('file_pdf')) {
                if ($Laboran->file_pdf && file_exists(public_path($Laboran->file_pdf))) {
                    unlink(public_path($Laboran->file_pdf));
                }
            }
            if ($request->hasFile('gambar')) {
                if ($Laboran->gambar && file_exists(public_path($Laboran->gambar))) {
                    unlink(public_path($Laboran->gambar));
                }
            }

            $fotoName = $Laboran->gambar;
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                if ($file->isValid()) {
                    $name = time() . '_' . $file->getClientOriginalName();
                    $path = public_path('storage/uploads/laboran/image');
                    $file->move($path, $name);
                    $fotoName = 'storage/uploads/laboran/image/' . $name;
                } else {
                    throw new \Exception('Invalid file provided');
                }
            }

            $filePath = $Laboran->file_pdf;
            if ($request->hasFile('file_pdf')) {
                $file = $request->file('file_pdf');
                if ($file->isValid()) {
                    $name = time() . '_' . $file->getClientOriginalName();
                    $path = public_path('storage/uploads/laboran/file-pdf');
                    $file->move($path, $name);
                    $filePath = 'storage/uploads/laboran/file-pdf/' . $name;
                } else {
                    throw new \Exception('Invalid file provided');
                }
            }

            $Laboran->update([
                'judul'         => $request->input('judul'),
                'gambar'        => $fotoName,
                'konten'        => $request->input('konten'),
                'file_pdf'      => $filePath,
                // 'is_active'  => 0,
            ]);

            if ($request->hasFile('image')) {

                $existingImages = RefLaboran::where('id_laboran', $request->id)->pluck('image')->toArray();

                if (!empty($existingImages)) {
                    foreach ($existingImages as $existingImage) {
                        $imagePath = public_path('storage/uploads/laboran/ref_image') . '/' . $existingImage;
                        if (file_exists($imagePath)) {
                            unlink($imagePath);
                        }
                    }
                }

                RefLaboran::where('id_laboran', $request->id)->delete();

                foreach ($request->file('image') as $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = public_path('storage/uploads/laboran/ref_image');
                    $file->move($path, $filename);
                    $filePath = 'storage/uploads/laboran/ref_image/' . $filename;
                    RefLaboran::create([
                        'id_laboran' => $Laboran->id,
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
            $Laboran = Laboran::find($request->id);

            $Laboran->is_active = $request->value;

            if ($Laboran->isDirty()) {
                $Laboran->save();
            }

            if ($Laboran->wasChanged()) {
                return response()->json(['status' => true], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            $praktikBaik = Laboran::findOrFail($request->id);

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
            $images = RefLaboran::where('id_laboran', $id)->pluck('image')->toArray();
            // dd($images);
            return response()->json(['status' => true, 'images' => $images], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
}
