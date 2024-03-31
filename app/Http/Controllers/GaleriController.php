<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Model\Galeri;
use App\Model\RefGaleri;
use App\Model\ListKategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class GaleriController extends Controller
{

    public function index()
    {
        $galeri = Galeri::all();
        $kategori = ListKategori::all();
        return view('contents.galeri.list', [
            'title' => 'Data Galeri',
            'galeri' => $galeri,
            'kategori' => $kategori,
        ]);
    }


    public function data()
    {
        $galeri = Galeri::with('list_kategori.list_kanal')->orderByDesc('created_at')->get();

        return DataTables::of($galeri)
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request)
    {

        try {

            // // Move and save the 'video' file
            // $videoName = time() . '.' . $request->video->extension();
            // $request->video->move(public_path('file-galeri'), $videoName);

            // Create galeri
            $galeri = Galeri::create([
                'judul'             => $request->judul,
                'slug'              => Str::slug($request->judul),
                'deskripsi'         => $request->deskripsi,
                'tanggal'           => Carbon::now(),
                'tag'               => $request->tag,
                'link'              => $request->link,
                'is_video'          => !empty($request->link) ? 1 : 0,
                'is_image'          => $request->hasFile('image') ? 1 : 0,
                'jumlah_lihat'      => 0,
                'status_publish'    => 0,
                'id_kategori'       => $request->id_kategori,
            ]);

            if ($request->file('image')) {
                $alphanumeric = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

                foreach ($request->file('image') as $file) {
                    $extension = $file->getClientOriginalExtension();
                    $random = substr(str_shuffle($alphanumeric), 0, 4);
                    $filename = $galeri->judul . '-' . $random . now()->timestamp . '.' . $extension;
                    $file->move(public_path('/storage/uploads/file-galeri/gambar'), $filename);

                    RefGaleri::create([
                        'id_galeri' => $galeri->id,
                        'image' => $filename
                    ]);
                }
            }

            return response()->json(['status' => true, 'msg' => 'Data video berhasil disimpan'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request)
    {
        try {
            // Retrieve the existing galeri
            $galeri = Galeri::findOrFail($request->id);

            // Update galeri data
            $galeri->update([
                'judul'             => $request->judul,
                'slug'              => Str::slug($request->judul),
                'deskripsi'         => $request->deskripsi,
                'tanggal'           => $request->tanggal,
                'tag'               => $request->tag,
                'link'              => $request->link,
                'id_kategori'       => $request->id_kategori,
            ]);


            if ($request->file('image')) {

                $existingImages = RefGaleri::where('id_galeri', $request->id)->pluck('image')->toArray();

                if (!empty($existingImages)) {
                    foreach ($existingImages as $existingImage) {
                        $imagePath = public_path('/storage/uploads/file-galeri/gambar') . '/' . $existingImage;
                        if (file_exists($imagePath)) {
                            unlink($imagePath);
                        }
                    }
                }

                RefGaleri::where('id_galeri', $request->id)->delete();

                $alphanumeric = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

                foreach ($request->file('image') as $file) {
                    $extension = $file->getClientOriginalExtension();
                    $random = substr(str_shuffle($alphanumeric), 0, 4);
                    $filename = $galeri->judul . '-' . $random . now()->timestamp . '.' . $extension;
                    $file->move(public_path('/storage/uploads/file-galeri/gambar'), $filename);

                    RefGaleri::create([
                        'id_galeri' => $galeri->id,
                        'image' => $filename
                    ]);
                }
            }

            return response()->json(['status' => true, 'msg' => 'Data video berhasil diupdate'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }


    public function destroy(Request $request)
    {
        try {
            $galeri = Galeri::findOrFail($request->id);

            if ($galeri->video) {
                Storage::delete('/storage/uploads/file-galeri/' . $galeri->video);
            }
            $galeri->delete();
            return response()->json(['status' => true, 'msg' => 'Data artikel berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    public function switchStatus(Request $request)
    {
        try {
            $list_galeri = Galeri::findOrFail($request->id);
            $list_galeri->status_publish = $request->value;

            if ($list_galeri->isDirty()) {
                $list_galeri->save();
            }

            if ($list_galeri->wasChanged()) {

            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
    // Controller method to fetch images for a specific galeri
    public function getImages(Request $request)
    {
        try {
            $images = RefGaleri::where('id_galeri', $request->id)->pluck('image')->toArray();
            return response()->json(['status' => true, 'images' => $images], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
}
