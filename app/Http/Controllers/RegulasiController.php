<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Model\Regulasi;
use App\Model\ListKategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class RegulasiController extends Controller
{
    public function index()
    {
        $list = Regulasi::all();
        $kategori   = ListKategori::all();
        return view('contents.regulasi.list', [
            'title' => 'Daftar Regulasi',
            'list' => $list,
            'kategori' => $kategori,
        ]);
    }

    public function data(Request $request)
    {
        $list = Regulasi::with('kategori.list_kanal');

        return DataTables::of($list)
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required',
            'id_kategori' => 'required',
            'cover' => 'required',
            'file' => 'required',
        ], [
            'judul.required' => '<strong style="color: red;">Judul wajib diisi.</strong>',
            'id_kategori.required' => '<strong style="color: red;">Kategori wajib dipilih.</strong>',
            'cover.required' => '<strong style="color: red;">Cover wajib diisi.</strong>',
            'file.required' => '<strong style="color: red;">File PDF wajib diisi.</strong>',
        ]);
        try {
            $coverName = time() . '.' . $request->cover->extension();
            // $request->cover->storeAs('uploads/regulasi/cover', $coverName, 'public');
            $request->cover->move(public_path('/storage/uploads/cover-regulasi'), $coverName);

            $filePDFName = time() . '.' . $request->file->extension();
            // $request->file->storeAs('uploads/regulasi/file', $filePDFName, 'public');
            $request->file->move(public_path('/storage/uploads/file-regulasi'), $filePDFName);

            // dd($filePDFName);
            $unduhan = Regulasi::create([
                'judul'         => $request->judul,
                'slug'          => Str::slug($request->judul),
                'tanggal'       => Carbon::now(),
                'file'          => $filePDFName,
                'cover'         => $coverName,
                'id_kategori'   => $request->id_kategori,
                'jumlah_download'   => 0,

            ]);
            // $unduhan->increment('jumlah_download');
            return response()->json(['status' => true, 'msg' => 'Data unduhan berhasil disimpan'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    // public function store(Request $request)
    // {
    //     $this->validate($request, [
    //         'judul' => 'required',
    //         'id_kategori' => 'required',
    //         'gambar' => 'required|image|mimes:jpeg,png,jpg',
    //         'file' => 'required|mimes:pdf',
    //     ], [
    //         'judul.required' => '<strong style="color: red;">Judul wajib diisi.</strong>',
    //         'id_kategori.required' => '<strong style="color: red;">Kategori wajib dipilih.</strong>',
    //         'gambar.required' => '<strong style="color: red;">Gambar wajib diisi.</strong>',
    //         'file.required' => '<strong style="color: red;">File PDF wajib diisi.</strong>',
    //     ]);

    //     try {
    //         $coverName = time() . '.' . $request->cover->extension();
    //         $request->cover->move(public_path('cover-regulasi'), $coverName);

    //         $filePDFName = time() . '.' . $request->file->extension();
    //         $request->file->move(public_path('file-regulasi'), $filePDFName);

    //         $unduhan = Regulasi::create([
    //             'judul' => $request->judul,
    //             'slug' => Str::slug($request->judul),
    //             'tanggal' => Carbon::now(),
    //             'file' => $filePDFName,
    //             'cover' => $coverName,
    //             'id_kategori' => $request->id_kategori,
    //             'jumlah_download' => 0,
    //         ]);

    //         return response()->json(['status' => true, 'msg' => 'Data unduhan berhasil disimpan'], 200);
    //     } catch (\Exception $e) {
    //         return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
    //     }
    // }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'judul' => 'required|string',
                'cover' => 'image|mimes:jpeg,png,jpg',
                'file'  => 'mimes:pdf',
            ]);

            $regulasi = Regulasi::findOrFail($request->id);

            $regulasi->judul = $request->judul;
            $regulasi->id_kategori = $request->id_kategori;

            if ($request->hasFile('cover')) {
                if (file_exists(public_path("/storage/uploads/cover-regulasi/{$regulasi->cover}"))) {
                    unlink(public_path("/storage/uploads/cover-regulasi/{$regulasi->cover}"));
                }

                $coverName = time() . '.' . $request->cover->extension();
                $request->cover->move(public_path('/storage/uploads/cover-regulasi'), $coverName);
                $regulasi->cover = $coverName;
            }

            if ($request->hasFile('file')) {
                if (file_exists(public_path("/storage/uploads/file-regulasi/{$regulasi->file}"))) {
                    unlink(public_path("/storage/uploads/file-regulasi/{$regulasi->file}"));
                }

                $filePDFName = time() . '.' . $request->file->extension();
                $request->file->move(public_path('/storage/uploads/file-regulasi'), $filePDFName);
                $regulasi->file = $filePDFName;
            }

            $regulasi->save();

            return response()->json(['status' => true, 'msg' => 'Data unduhan berhasil diupdate'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    public function switchStatus(Request $request)
    {
        try {
            $regulasi = Regulasi::find($request->id);

            $regulasi->is_active = $request->value;

            if ($regulasi->isDirty()) {
                $regulasi->save();
            }

            if ($regulasi->wasChanged()) {
                return response()->json(['status' => true], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            $regulasi = Regulasi::find($request->id);

            $regulasi->delete();

            if ($regulasi->trashed()) {
                return response()->json(['status' => true], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
}
