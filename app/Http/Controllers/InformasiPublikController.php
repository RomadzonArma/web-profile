<?php

namespace App\Http\Controllers;

use App\Model\Informasi_publik;
use App\Model\Informasi_publik_has_file;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class InformasiPublikController extends Controller
{
    public function index(Request $request)
    {
        return view('contents.informasi.list', [
            'title' => 'Informasi Publik'
        ]);
    }

    public function data(Request $request)
    {
        $list = Informasi_publik::select(DB::raw('*'));

        return DataTables::of($list)
            ->addIndexColumn()
            ->addColumn('id', function ($row) {
                return encrypt($row->id);
            })
            ->make();
    }

    public function store(Request $request)
    {
        return view('contents.informasi.store', [
            'title' => 'Tambah Informasi Publik'
        ]);
    }
    public function update(Request $request, $id)
    {
        $id = decrypt($id);
        $data = Informasi_publik::where('id', $id)->first();
        return view('contents.informasi.update', [
            'title' => 'Tambah Informasi Publik',
            'data' => $data,
        ]);
    }
    public function do_update(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required',
            'kategori' => 'required',
            'konten' => 'required'
        ]);

        try {
            DB::beginTransaction();
            $konten = $request->konten;
            $informasi_publik_id = $request->informasi_publik_id;
            if ($informasi_publik_id) {
                // Informasi_publik_has_file::where('informasi_publik_id', $informasi_publik_id)->delete();
                // Storage::deleteDirectory("public/uploads/informasi_publik/{$informasi_publik_id}");
                // Update existing record
                $fileUpload = Informasi_publik::find($informasi_publik_id);
                $fileUpload->judul = $request->judul;
                $fileUpload->kategori = $request->kategori;
                $fileUpload->konten = ''; // Will be updated later
                $fileUpload->save();
            } else {
                // Create new record
                $fileUpload = new Informasi_publik;
                $fileUpload->judul = $request->judul;
                $fileUpload->kategori = $request->kategori;
                $fileUpload->konten = ''; // Will be updated later
                $fileUpload->save();
            }

            $dom = new \DomDocument();
            $dom->loadHtml($konten, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $imageFile = $dom->getElementsByTagName('img');

            if ($imageFile) {
                foreach ($imageFile as $item => $image) {
                    $data = $image->getAttribute('src');
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $imgeData = base64_decode($data);
                    $fileName = time() . $item . '.png';
                    $directory = "uploads/informasi_publik/{$fileUpload->id}";

                    // Store the image using Laravel's Storage
                    Storage::put("public/$directory/$fileName", $imgeData);

                    // Update the image src attribute in the HTML content
                    $newSrc = Storage::url("$directory/$fileName");
                    $image->setAttribute('src', $newSrc);

                    $fileUploadFile = new Informasi_publik_has_file;
                    $fileUploadFile->path = $directory;
                    $fileUploadFile->file = $fileName;
                    $fileUploadFile->informasi_publik_id = $fileUpload->id;
                    $fileUploadFile->save();
                }
            }


            $konten = $dom->saveHTML();

            // Update Informasi_publik with the final content
            $fileUpload->konten = $konten;
            $fileUpload->save();

            DB::commit();
            return response()->json(['status' => true], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
    public function do_store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required',
            'kategori' => 'required',
            'konten' => 'required'
        ]);
        try {
            DB::beginTransaction();
            $konten = $request->konten;

            $dom = new \DomDocument();
            $dom->loadHtml($konten, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $imageFile = $dom->getElementsByTagName('img');
            // Create Informasi_publik first
            $fileUpload = new Informasi_publik;
            $fileUpload->judul = $request->judul;
            $fileUpload->kategori = $request->kategori;
            $fileUpload->konten = ''; // Will be updated later
            $fileUpload->save();
            foreach ($imageFile as $item => $image) {
                $data = $image->getAttribute('src');
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $imgeData = base64_decode($data);
                $fileName = time() . $item . '.png';
                $directory = "uploads/informasi_publik/{$fileUpload->id}"; // Use the ID of the Informasi_publik as part of the directory

                // Store the image using Laravel's Storage
                Storage::put("public/$directory/$fileName", $imgeData);

                // Update the image src attribute in the HTML content
                $newSrc = Storage::url("$directory/$fileName");
                $image->setAttribute('src', $newSrc);
                $fileUploadFile = new Informasi_publik_has_file;
                $fileUploadFile->path = $directory;
                $fileUploadFile->file = $fileName;
                $fileUploadFile->informasi_publik_id = $fileUpload->id;
                $fileUploadFile->save();
            }

            $konten = $dom->saveHTML();
            // Update Informasi_publik with the final content
            $fileUpload->konten = $dom->saveHTML();
            $fileUpload->save();


            DB::commit();
            return response()->json(['status' => true, 'image' => $imageFile], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request)
    {
        $informasi_id = decrypt($request->id);

        try {
            $informasi = Informasi_publik::find($informasi_id);

            $informasi->delete();

            Informasi_publik_has_file::where('informasi_publik_id', $informasi_id)->delete();
            Storage::deleteDirectory("public/uploads/informasi_publik/{$informasi_id}");

            if ($informasi->trashed()) {
                return response()->json(['status' => true], 200);
            }
            return response()->json(['status' => false], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
}
