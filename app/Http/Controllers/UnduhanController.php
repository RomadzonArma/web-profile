<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Model\Unduhan;
use App\Model\ListKategori;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UnduhanController extends Controller
{
    public function index()
    {

        $list = Unduhan::all();
        $kategori   = ListKategori::all();
        return view('contents.unduhan.index', [
            'title' => 'Data Unduhan',
            'list' => $list,
            'kategori' => $kategori,
        ]);
    }
    public function data(Request $request)
    {
        $list = Unduhan::with('kategori');
        return DataTables::of($list)
            ->addIndexColumn()
            ->make(true);
    }
    public function store(Request $request)
    {
        try {
            $coverName = time() . '.' . $request->cover->extension();
            $request->cover->move(public_path('cover-unduhan'), $coverName);

            $filePDFName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('file-unduhan'), $filePDFName);

            // dd($filePDFName);
            $unduhan = Unduhan::create([
                'judul'         => $request->judul,
                'tanggal'       => Carbon::now(),
                'file'          => $filePDFName, // Corrected line
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
    public function edit(Request $request)
    {
        $id_ubah = $request->id_ubah;
        $data = Unduhan::where('id', $id_ubah)->first();
        $list = [
            'data' => $data,
        ];
        return view('contents.unduhan.form_edit', $list);
    }

    public function update(Request $request)
    {
        try {
            // Validasi data yang diterima dari form
            $request->validate([
                'judul' => 'required|string',
                'cover' => 'image|mimes:jpeg,png,jpg', // Validasi cover sesuai kebutuhan Anda
                'file'  => 'mimes:pdf', // Validasi file PDF
            ]);

            // Temukan unduhan yang akan diupdate
            $unduhan = Unduhan::findOrFail($request->id);

            // Hapus file lama jika ada perubahan file cover
            if ($request->hasFile('cover')) {
                unlink(public_path('cover-unduhan') . '/' . $unduhan->cover);

                $coverName = time() . '.' . $request->cover->extension();
                $request->cover->move(public_path('cover-unduhan'), $coverName);
                $unduhan->cover = $coverName;
            }

            // Hapus file lama jika ada perubahan file PDF
            if ($request->hasFile('file')) {
                unlink(public_path('file-unduhan') . '/' . $unduhan->file);

                $filePDFName = time() . '.' . $request->file->extension();
                $request->file->move(public_path('file-unduhan'), $filePDFName);
                $unduhan->file = $filePDFName;
            }

            // Update data unduhan
            $unduhan->judul       = $request->judul;
            $unduhan->id_kategori = $request->id_kategori;
            $unduhan->save();

            return response()->json(['status' => true, 'msg' => 'Data unduhan berhasil diupdate'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
    public function destroy(Request $request)
    {
        try {
            // Temukan unduhan yang akan dihapus
            $unduhan = Unduhan::findOrFail($request->id);

            // Hapus file cover
            unlink(public_path('cover-unduhan') . '/' . $unduhan->cover);

            // Hapus file PDF
            unlink(public_path('file-unduhan') . '/' . $unduhan->file);

            // Hapus record dari database
            $unduhan->delete();

            return response()->json(['status' => true, 'msg' => 'Data unduhan berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
    public function download($id)
    {
        try {
            $unduhan = Unduhan::findOrFail($id);

            // Increment the download count if needed
            $unduhan->increment('jumlah_download');

            $filePath = public_path('file-unduhan') . '/' . $unduhan->file;

            return response()->download($filePath, $unduhan->judul . '.pdf');
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
}
