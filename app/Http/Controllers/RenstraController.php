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
            $request->gambar->move(public_path('gambar-renstra'), $coverName);

            $filePDFName = time() . '.' . $request->file('file')->getClientOriginalExtension();
            $request->file('file')->move(public_path('file-renstra'), $filePDFName);

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

            // $coverName = time() . '.' . $request->gambar->extension();
            // $request->gambar->move(public_path('gambar-renstra'), $coverName);

            if ($request->hasFile('gambar')) {
                $oldgambarPath = public_path('gambar-renstra') . '/' . $renstra->gambar;
                if (file_exists($oldgambarPath)) {
                    unlink($oldgambarPath);
                }

                // Upload gambar baru
                $gambarName = time() . '.' . $request->gambar->extension();
                $request->gambar->move(public_path('gambar-renstra'), $gambarName);

                // Update data program dengan gambar baru
                $renstra->update([
                    'gambar' => $gambarName,
                ]);
            }

            $renstra->update([
                'judul'         => $request->judul,
                'slug'          => Str::slug($request->judul),
                'konten'        => $request->konten,
                'tag'           => $request->tag,
                'link'          =>  $request->link,
                'id_kategori'   => $request->id_kategori,
            ]);

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
                Storage::delete('gambar-renstra/' . $renstra->gambar);
            }

            $renstra->delete();

            return response()->json(['status' => true, 'msg' => 'Data renstra berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
}
