<?php

namespace App\Http\Controllers;

use App\Model\DokumentasiLayanan;
use App\Model\ListKategori;
use App\Model\RefDokumentasiLayanan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class DokumentasiController extends Controller
{
    public function index()
    {
        $dokumentasi_layanan = DokumentasiLayanan::all();
        $kategori = ListKategori::all();
        return view('contents.dokumentasi_layanan.list', [
            'title' => 'Dokumentasi Layanan',
            'dokumentasi_layanan' => $dokumentasi_layanan,
            'kategori' => $kategori,
        ]);
    }

    public function data()
    {
        $dokumentasi_layanan = DokumentasiLayanan::with('list_kategori.list_kanal')->orderByDesc('created_at')->get();

        return DataTables::of($dokumentasi_layanan)
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request)
    {

        try {

            // // Move and save the 'video' file
            // $videoName = time() . '.' . $request->video->extension();
            // $request->video->move(public_path('file-dokumentasi-layanan'), $videoName);

            // Create dokumentasi_layanan
            $dokumentasi_layanan = DokumentasiLayanan::create([
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
                    $filename = $dokumentasi_layanan->judul . '-' . $random . now()->timestamp . '.' . $extension;
                    $file->move(public_path('/storage/uploads/file-dokumentasi-layanan/gambar'), $filename);

                    RefDokumentasiLayanan::create([
                        'id_dokumentasi_layanan' => $dokumentasi_layanan->id,
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
            $dokumentasi_layanan = DokumentasiLayanan::findOrFail($request->id);

            $dokumentasi_layanan->update([
                'judul'             => $request->judul,
                'slug'              => Str::slug($request->judul),
                'deskripsi'         => $request->deskripsi,
                'tanggal'           => $request->tanggal,
                'tag'               => $request->tag,
                'link'              => $request->link,
                'id_kategori'       => $request->id_kategori,
            ]);


            if ($request->file('image')) {

                $existingImages = RefDokumentasiLayanan::where('id_dokumentasi_layanan', $request->id)->pluck('image')->toArray();

                if (!empty($existingImages)) {
                    foreach ($existingImages as $existingImage) {
                        $imagePath = public_path('/storage/uploads/file-dokumentasi-layanan/gambar') . '/' . $existingImage;
                        if (file_exists($imagePath)) {
                            unlink($imagePath);
                        }
                    }
                }

                RefDokumentasiLayanan::where('id_dokumentasi_layanan', $request->id)->delete();

                $alphanumeric = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

                foreach ($request->file('image') as $file) {
                    $extension = $file->getClientOriginalExtension();
                    $random = substr(str_shuffle($alphanumeric), 0, 4);
                    $filename = $dokumentasi_layanan->judul . '-' . $random . now()->timestamp . '.' . $extension;
                    $file->move(public_path('/storage/uploads/file-dokumentasi-layanan/gambar'), $filename);

                    RefDokumentasiLayanan::create([
                        'id_dokumentasi_layanan' => $dokumentasi_layanan->id,
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
            $dokumentasi_layanan = DokumentasiLayanan::findOrFail($request->id);

            if ($dokumentasi_layanan->video) {
                Storage::delete('file-dokumentasi-layanan/' . $dokumentasi_layanan->video);
            }
            $dokumentasi_layanan->delete();
            return response()->json(['status' => true, 'msg' => 'Data artikel berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    public function switchStatus(Request $request)
    {
        try {
            $dokumentasi_layanan = DokumentasiLayanan::findOrFail($request->id);
            $dokumentasi_layanan->status_publish = $request->value;

            if ($dokumentasi_layanan->isDirty()) {
                $dokumentasi_layanan->save();
            }

            if ($dokumentasi_layanan->wasChanged()) {

            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    public function getImages(Request $request)
    {
        try {
            $images = RefDokumentasiLayanan::where('id_dokumentasi_layanan', $request->id)->pluck('image')->toArray();
            return response()->json(['status' => true, 'images' => $images], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
}
