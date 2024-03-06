<?php

namespace App\Http\Controllers;

use App\Model\Artikel;
use App\Model\ListKategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ArtikelController extends Controller
{

    public function index()
    {
        $kategori   = ListKategori::all();
        return view('contents.artikel.list', [
            'title' => 'List Artikel',
            'kategori' => $kategori,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $artikel = Artikel::with('kategori.list_kanal')->get();
        return DataTables::of($artikel)
            ->addIndexColumn()
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // Validasi input
            $validatedData = $request->validate([
                'judul'         => 'required|string|max:255',
                'gambar'        => 'required|file|mimes:jpg,jpeg,png|max:2048',
                'konten'        => 'required|string',
                'tag'           => 'required|string|max:255',
                'id_kategori'   => 'integer',
            ]);

            // Move and save the 'gambar' file
            $coverName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('gambar-artikel'), $coverName);

            $artikel = Artikel::create([
                'judul'             => $request->judul,
                'slug'              => Str::slug($request->judul),
                'gambar'            => $coverName,
                'konten'            => $request->konten,
                'tag'               => $request->tag,
                'link'              =>  $request->link,
                'status_publish'    => 0,
                'jumlah_lihat'      => 0,
                'id_kategori'       => $request->id_kategori,
            ]);


            return response()->json(['status' => true, 'msg' => 'Data artikel berhasil disimpan'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }


    public function update(Request $request)
    {
        try {

            $artikel = Artikel::findOrFail($request->id);

            // $coverName = time() . '.' . $request->gambar->extension();
            // $request->gambar->move(public_path('gambar-artikel'), $coverName);

            if ($request->hasFile('gambar')) {
                $oldgambarPath = public_path('gambar-artikel') . '/' . $artikel->gambar;
                if (file_exists($oldgambarPath)) {
                    unlink($oldgambarPath);
                }

                // Upload gambar baru
                $gambarName = time() . '.' . $request->gambar->extension();
                $request->gambar->move(public_path('gambar-artikel'), $gambarName);

                // Update data program dengan gambar baru
                $artikel->update([
                    'gambar' => $gambarName,
                ]);
            }

            $artikel->update([
                'judul'         => $request->judul,
                'slug'          => Str::slug($request->judul),
                'konten'        => $request->konten,
                'tag'           => $request->tag,
                'link'          =>  $request->link,
                'id_kategori'   => $request->id_kategori,
            ]);

            return response()->json(['status' => true, 'msg' => 'Data artikel berhasil diperbarui'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request)
    {
        try {
            // Ambil artikel yang akan dihapus
            $artikel = Artikel::findOrFail($request->id);

            // Hapus file gambar jika ada
            if ($artikel->gambar) {
                Storage::delete('gambar-artikel/' . $artikel->gambar);
            }

            // Hapus artikel dari database
            $artikel->delete();

            return response()->json(['status' => true, 'msg' => 'Data artikel berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
}
