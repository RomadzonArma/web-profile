<?php

namespace App\Http\Controllers;

use App\Model\Maklumat;
use App\Model\Maklumatimage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;

class MaklumatController extends Controller
{
    public function index()
    {
        return view('contents.maklumat.list', [
            'title' => 'Maklumat'
        ]);
    }
    public function data()
    {
        $data = Maklumat::orderBy('id', 'desc')
            ->get();
        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([

                'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'foto_Maklumat' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'dokumen' => 'nullable|mimes:pdf|max:5120',
                'video' => 'nullable|mimes:mp4,mov|max:10240',
            ]);

            $fotoName = null;
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                if ($file->isValid()) {
                    $name = time() . '_' . $file->getClientOriginalName();
                    $path = public_path('storage/uploads/Maklumat/image');
                    $file->move($path, $name);
                    $fotoName = 'storage/uploads/Maklumat/image/' . $name;
                } else {
                    throw new \Exception('Invalid file provided');
                }
            }

            $filePath = null; // Inisialisasi variabel
            if ($request->hasFile('dokumen')) {
                $file = $request->file('dokumen');
                if ($file->isValid()) {
                    $filename = time() . '_' . $file->getClientOriginalName(); // Menggunakan $filename
                    $path = public_path('storage/uploads/Maklumat/dokumen');
                    $file->move($path, $filename); // Menggunakan $filename
                    $filePath = 'storage/uploads/Maklumat/dokumen/' . $filename;
                } else {
                    throw new \Exception('Invalid PDF file provided');
                }
            }

            $maklumat =  Maklumat::create([
                'judul_maklumat'      => $request->input('judul_maklumat'),
                'link' => $request->input('link'),
                'gambar'       => $fotoName,
                // 'konten'     => $request->input('konten'),
                'dokumen'   => $filePath,
                'status_publish'  => 0,
            ]);
            if ($request->file('image')) {
                foreach ($request->file('image') as $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = public_path('storage/uploads/Maklumat/foto-maklumat');
                    $file->move($path, $filename);
                    $filePath = 'storage/uploads/Maklumat/foto-maklumat/' . $filename;
                    Maklumatimage::create([
                        'id_maklumat' => $maklumat->id,
                        'image' => $filePath
                    ]);
                }
            }

            return response()->json(['status' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'foto_Maklumat' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'dokumen' => 'nullable|mimes:pdf|max:5120',
                'video' => 'nullable|mimes:mp4,mov|max:10240',
            ]);

            $maklumat = Maklumat::findOrFail($id);

            // Proses file gambar jika ada
            $fotoName = null;
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                if ($file->isValid()) {
                    $name = time() . '_' . $file->getClientOriginalName();
                    $path = public_path('storage/uploads/Maklumat/image');
                    $file->move($path, $name);
                    $fotoName = 'storage/uploads/Maklumat/image/' . $name;
                    // Hapus gambar lama jika ada
                    if ($maklumat->gambar) {
                        Storage::delete($maklumat->gambar);
                    }
                } else {
                    throw new \Exception('Invalid file provided');
                }
            }

            // Proses file dokumen jika ada
            $filePath = null;
            if ($request->hasFile('dokumen')) {
                $file = $request->file('dokumen');
                if ($file->isValid()) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = public_path('storage/uploads/Maklumat/dokumen');
                    $file->move($path, $filename);
                    $filePath = 'storage/uploads/Maklumat/dokumen/' . $filename;
                    // Hapus dokumen lama jika ada
                    if ($maklumat->dokumen) {
                        Storage::delete($maklumat->dokumen);
                    }
                } else {
                    throw new \Exception('Invalid PDF file provided');
                }
            }

            // Update entitas Maklumat
            $maklumat->update([
                'judul_maklumat' => $request->input('judul_maklumat'),
                'link' => $request->input('link'),
                'gambar' => $fotoName ? $fotoName : $maklumat->gambar,
                'dokumen' => $filePath ? $filePath : $maklumat->dokumen,
                'status_publish' => 0, // Pastikan Anda ingin mengatur ulang status publish saat mengupdate
            ]);

            if ($request->file('image')) {

                Maklumatimage::where('id_maklumat', $request->id)->delete();

                foreach ($request->file('image') as $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = public_path('storage/uploads/Maklumat/foto-maklumat');
                    $file->move($path, $filename);
                    $filePath = 'storage/uploads/Maklumat/foto-maklumat/' . $filename;
                    Maklumatimage::create([
                        'id_maklumat' => $maklumat->id,
                        'image' => $filePath
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
            $Maklumat = Maklumat::find($request->id);

            $Maklumat->status_publish = $request->value;

            if ($Maklumat->isDirty()) {
                $Maklumat->save();
            }

            if ($Maklumat->wasChanged()) {
                return response()->json(['status' => true], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            // Temukan Maklumat berdasarkan ID
            $maklumat = Maklumat::findOrFail($request->id);

            // Hapus gambar jika ada
            if (!is_null($maklumat->gambar)) {
                if (File::exists(public_path($maklumat->gambar))) {
                    File::delete(public_path($maklumat->gambar));
                }
            }

            // Hapus dokumen jika ada
            if (!is_null($maklumat->dokumen)) {
                if (File::exists(public_path($maklumat->dokumen))) {
                    File::delete(public_path($maklumat->dokumen));
                }
            }

            // Hapus foto-foto terkait jika ada
            $maklumatImages = MaklumatImage::where('id_maklumat', $request->id)->get();
            foreach ($maklumatImages as $maklumatImage) {
                if (File::exists(public_path($maklumatImage->image))) {
                    File::delete(public_path($maklumatImage->image));
                }
                $maklumatImage->delete();
            }

            // Hapus data Maklumat
            $maklumat->delete();

            return response()->json(['status' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
    public function getImages(Request $request)
    {
        try {
            $images = Maklumatimage::where('id_maklumat', $request->id)->pluck('image')->toArray();
            return response()->json(['status' => true, 'images' => $images], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
}
