<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Model\ListKategori;
use Illuminate\Support\Str;
use App\Model\Renstra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class RenstraController extends Controller
{
    public function index()
    {
        $kategori   = ListKategori::all();
        return view('contents.renstra.list', [
            'title' => 'List Renstra',
            'kategori' => $kategori,
        ]);
    }

    public function data()
    {
        $renstra = Renstra::with('kategori.list_kanal')->orderByDesc('created_at')->get();
        return DataTables::of($renstra)
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'judul'         => 'required|string|max:255',
                'gambar'        => 'required|file|mimes:jpg,jpeg,png|max:2048',
                // 'konten'        => 'required|string',
                'tag'           => 'required|string|max:255',
                'id_kategori'   => 'integer',
            ]);

            // Move and save the 'gambar' file
            $coverName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('/storage/uploads/gambar-renstra'), $coverName);

            $filePDFName = time() . '.' . $request->file('file')->getClientOriginalExtension();
            $request->file('file')->move(public_path('/storage/uploads/file-renstra'), $filePDFName);

            Renstra::create([
                'judul'             => $request->judul,
                'slug'              => Str::slug($request->judul),
                'gambar'            => $coverName,
                'konten'            => $request->konten,
                'tag'               => $request->tag,
                'link'              =>  $request->link,
                'status_publish'    => 0,
                'jumlah_lihat'      => 0,
                'id_kategori'       => $request->id_kategori,
                'tanggal' => Carbon::now(),
                'file' => $filePDFName,
                'jumlah_download' => 0,
            ]);


            return response()->json(['status' => true, 'msg' => 'Data renstra berhasil disimpan'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request)
    {
        try {
            $renstra = Renstra::findOrFail($request->id);

            // Cek apakah ada file gambar yang diunggah
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama jika ada
                $oldGambarPath = public_path('/storage/uploads/gambar-renstra') . '/' . $renstra->gambar;
                if (file_exists($oldGambarPath)) {
                    unlink($oldGambarPath);
                }

                // Upload gambar baru
                $gambarName = time() . '.' . $request->gambar->extension();
                $request->gambar->move(public_path('/storage/uploads/gambar-renstra'), $gambarName);

                // Update nama file gambar dalam database
                $renstra->gambar = $gambarName;
            }

            // Cek apakah ada file renstra yang diunggah
            if ($request->hasFile('file')) {
                // Hapus file renstra lama jika ada
                $oldFilePath = public_path('file-renstra') . '/' . $renstra->file;
                if (file_exists($oldFilePath) && is_file($oldFilePath)) {
                    unlink($oldFilePath);
                }

                // Upload file renstra baru
                $filePDFName = time() . '.' . $request->file('file')->getClientOriginalExtension();
                $request->file('file')->move(public_path('/storage/uploads/file-renstra'), $filePDFName);

                // Update nama file renstra dalam database
                $renstra->file = $filePDFName;
            }

            // Update data renstra yang lainnya
            $renstra->judul = $request->judul;
            $renstra->slug = Str::slug($request->judul);
            $renstra->konten = $request->konten;
            $renstra->tag = $request->tag;
            $renstra->link = $request->link;
            $renstra->id_kategori = $request->id_kategori;
            $renstra->tanggal = Carbon::now();
            $renstra->jumlah_download = 0;
            $renstra->save();

            return response()->json(['status' => true, 'msg' => 'Data renstra berhasil diperbarui'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }


    public function switchStatus(Request $request)
    {
        try {
            $renstra = Renstra::findOrFail($request->id);
            $renstra->status_publish = $request->value;

            if ($renstra->isDirty()) {
                $renstra->save();
            }

            if ($renstra->wasChanged()) {
                return response()->json(['status' => true], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $renstra = Renstra::findOrFail($request->id);

            if ($renstra->gambar) {
                Storage::delete('/storage/uploads/gambar-renstra/' . $renstra->gambar);
            }

            $renstra->delete();

            return response()->json(['status' => true, 'msg' => 'Data renstra berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
}
