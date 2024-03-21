<?php

namespace App\Http\Controllers;

use App\Model\ListKategori;
use Illuminate\Support\Str;
use App\Model\Akuntabilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class AkuntabilitasController extends Controller
{
    public function index()
    {
        $kategori   = ListKategori::all();
        return view('contents.akuntabilitas.list', [
            'title' => 'List Akuntabilitas',
            'kategori' => $kategori,
        ]);
    }

    public function data()
    {
        $Akuntabilitas = Akuntabilitas::with('kategori.list_kanal')->orderByDesc('created_at')->get();
        return DataTables::of($Akuntabilitas)
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'judul'         => 'required|string|max:255',
                'konten'        => 'required|string',
                'tag'           => 'required|string|max:255',
                'id_kategori'   => 'integer',
            ]);

            // Move and save the 'gambar' file
            if ($request->hasFile('foto')) {
                $fotoName = time() . '.' . $request->foto->extension();
                $request->foto->move(public_path('akuntabilitas/gambar-Akuntabilitas'), $fotoName);
            }

            if ($request->hasFile('file')) {
                $fileName = time() . '.' . $request->file->extension();
                $request->file->move(public_path('akuntabilitas/file-Akuntabilitas'), $fileName);
            }

            Akuntabilitas::create([
                'judul'             => $request->judul,
                'slug'              => Str::slug($request->judul),
                'konten'            => $request->konten,
                'foto'              => $fotoName ?? null,
                'file'              => $fileName ?? null,
                'tag'               => $request->tag,
                'is_active'         => 0,
                'jumlah_lihat'      => 0,
                'id_kategori'       => $request->id_kategori,
            ]);

            return response()->json(['status' => true, 'msg' => 'Data Akuntabilitas berhasil disimpan'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }


    public function update(Request $request)
{
    try {
        $request->validate([
            'judul'         => 'required|string|max:255',
            'konten'        => 'required|string',
            'tag'           => 'required|string|max:255',
            'id_kategori'   => 'integer',
        ]);

        $akuntabilitas = Akuntabilitas::findOrFail($request->id);

        // Move and save the 'foto' file if it exists
        if ($request->hasFile('foto')) {
            $fotoName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('akuntabilitas/gambar-Akuntabilitas'), $fotoName);
            // Delete old foto if it exists
            if ($akuntabilitas->foto && file_exists(public_path($akuntabilitas->foto))) {
                unlink(public_path($akuntabilitas->foto));
            }
            $akuntabilitas->foto = $fotoName;
        }

        // Move and save the 'file' if it exists
        if ($request->hasFile('file')) {
            $fileName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('akuntabilitas/file-Akuntabilitas'), $fileName);
            // Delete old file if it exists
            if ($akuntabilitas->file && file_exists(public_path($akuntabilitas->file))) {
                unlink(public_path($akuntabilitas->file));
            }
            $akuntabilitas->file = $fileName;
        }

        $akuntabilitas->judul = $request->judul;
        $akuntabilitas->slug = Str::slug($request->judul);
        $akuntabilitas->konten = $request->konten;
        $akuntabilitas->tag = $request->tag;
        $akuntabilitas->id_kategori = $request->id_kategori;

        $akuntabilitas->save();

        return response()->json(['status' => true, 'msg' => 'Data Akuntabilitas berhasil diperbarui'], 200);
    } catch (\Exception $e) {
        return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
    }
}


    public function switchStatus(Request $request)
    {
        try {
            $Akuntabilitas = Akuntabilitas::findOrFail($request->id);
            $Akuntabilitas->is_active = $request->value;

            if ($Akuntabilitas->isDirty()) {
                $Akuntabilitas->save();
            }

            if ($Akuntabilitas->wasChanged()) {
                return response()->json(['status' => true], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $Akuntabilitas = Akuntabilitas::findOrFail($request->id);

            if ($Akuntabilitas->foto) {
                Storage::delete('gambar-Akuntabilitas/' . $Akuntabilitas->foto);
            }

            $Akuntabilitas->delete();

            return response()->json(['status' => true, 'msg' => 'Data Akuntabilitas berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
}
