<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Model\Panduan;
use App\Model\ListKategori;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class PanduanController extends Controller
{
    public function index()
    {

        $list = Panduan::all();
        $kategori   = ListKategori::all();
        return view('contents.panduan.list', [
            'title' => 'Data Panduan',
            'list' => $list,
            'kategori' => $kategori,
        ]);
    }
    public function data(Request $request)
    {
        $list = Panduan::with('kategori.list_kanal')->orderByDesc('created_at')->get();

        return DataTables::of($list)
            ->addIndexColumn()
            ->make(true);
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'judul' => 'required|string',
                'gambar' => 'required|image|mimes:jpeg,png,jpg',
                'file_pdf' => 'required|mimes:pdf|max:5000', // Ukuran maksimum dalam kilobyte (KB)
                'id_kategori' => 'required',
            ], [
                'file_pdf.max' => '<strong style="color: red;">Ukuran file PDF tidak boleh melebihi 5MB.</strong>'
            ]);

            // Check if the 'gambar' file is present in the request
            if (!$request->hasFile('gambar')) {
                throw new \Exception('Gambar is required.');
            }

            // Check if the 'file_pdf' file is present in the request
            if (!$request->hasFile('file_pdf')) {
                throw new \Exception('File PDF is required.');
            }

            // Move and save the 'gambar' file
            $coverName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('/storage/uploads/gambar-panduan'), $coverName);

            // Move and save the 'file_pdf' file
            $filePDFName = time() . '.' . $request->file_pdf->extension();
            $request->file_pdf->move(public_path('/storage/uploads/file-panduan'), $filePDFName);

            // Create a new Panduan record
            $panduan = Panduan::create([
                'judul' => $request->judul,
                'konten' => $request->konten,
                'file_pdf' => $filePDFName,
                'gambar' => $coverName,
                'id_kategori' => $request->id_kategori,
                'jumlah_lihat' => 0,
            ]);

            return response()->json(['status' => true, 'msg' => 'Data panduan berhasil disimpan'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }



    public function update(Request $request)
    {
        try {
            $request->validate([
                'judul' => 'required|string',
                'gambar' => 'image|mimes:jpeg,png,jpg',
                'file_pdf' => 'mimes:pdf|max:5000', // Ukuran maksimum dalam kilobyte (KB)
            ], [
                'file_pdf.max' => 'Ukuran file PDF tidak boleh melebihi 5MB.'
            ]);

            // Temukan panduan yang akan diupdate
            $panduan = Panduan::findOrFail($request->id);

            // Hapus file lama jika ada perubahan file cover
            if ($request->hasFile('gambar')) {
                // unlink file lama jika ada
                if (file_exists(public_path('/storage/uploads/gambar-panduan') . '/' . $panduan->gambar)) {
                    unlink(public_path('/storage/uploads/gambar-panduan') . '/' . $panduan->gambar);
                }

                $coverName = time() . '.' . $request->gambar->extension();
                $request->gambar->move(public_path('/storage/uploads/gambar-panduan'), $coverName);
                $panduan->gambar = $coverName;
            }

            // Hapus file lama jika ada perubahan file PDF
            if ($request->hasFile('file_pdf')) {
                // unlink file lama jika ada
                if (file_exists(public_path('/storage/uploads/file-panduan') . '/' . $panduan->file_pdf)) {
                    unlink(public_path('/storage/uploads/file-panduan') . '/' . $panduan->file_pdf);
                }

                $filePDFName = time() . '.' . $request->file_pdf->extension();
                $request->file_pdf->move(public_path('/storage/uploads/file-panduan'), $filePDFName);
                $panduan->file_pdf = $filePDFName;
            }

            // Update data panduan
            $panduan->judul       = $request->judul;
            $panduan->konten      = $request->konten;
            $panduan->id_kategori = $request->id_kategori;
            $panduan->save();

            return response()->json(['status' => true, 'msg' => 'Data panduan berhasil diupdate'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    public function destroy(Request $request)
    {
        try {
            // Temukan panduan yang akan dihapus
            $panduan = Panduan::findOrFail($request->id);
            // Hapus file cover (jika ada) menggunakan metode delete
            Storage::delete('/storage/uploads/gambar-panduan/' . $panduan->gambar);

            // Hapus file PDF (jika ada) menggunakan metode delete
            Storage::delete('/storage/uploads/file-punduan/' . $panduan->file_pdf);
            $panduan->delete();

            return response()->json(['status' => true, 'msg' => 'Data panduan berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
    public function download($id)
    {
        try {
            $panduan = Panduan::findOrFail($id);

            // Increment the download count if needed
            $panduan->increment('jumlah_download');

            $filePath = public_path('/storage/uploads/file-panduan') . '/' . $panduan->file;

            return response()->download($filePath, $panduan->judul . '.pdf');
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
}
