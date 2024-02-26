<?php

namespace App\Http\Controllers;

use App\Model\ListKanal;
use App\Model\ListKategori;
use App\Model\Profil;
use App\Model\ProfilHasFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ProfilController extends Controller
{
    public function index(Request $request)
    {
        // $roles = Role::all();
        return view('contents.profil.list', [
            'title' => 'Profil',
        ]);
    }

    public function data(Request $request)
    {
        $list = Profil::with('list_kategori', 'list_kanal')->get();
        return DataTables::of($list)
            ->addIndexColumn()
            ->addColumn('id', function ($row) {
                return encrypt($row->id);
            })
            ->make();
    }

    public function switchStatus(Request $request)
    {
        try {
            $encrypted_id = $request->id;
            $decrypted_id = decrypt($encrypted_id);
            $profil = Profil::findOrFail($decrypted_id);
            // dd($profil);

            $profil->is_active = $request->value;

            if ($profil->isDirty()) {
                $profil->save();
            }

            if ($profil->wasChanged()) {
                return response()->json(['status' => true], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    public function store(Request $request)
    {
        $list_kanal = ListKanal::all();
        $list_kategori = ListKategori::all();
        return view('contents.profil.store', [
            'title' => 'Tambah Profil',
            'list_kanal' => $list_kanal,
            'list_kategori' => $list_kategori,
        ]);
    }

    public function do_store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required',
            'id_kanal' => 'required',
            'id_kategori' => 'required',
            'konten' => 'required'
        ]);
        try {
            DB::beginTransaction();
            $konten = $request->konten;

            $dom = new \DomDocument();
            $dom->loadHtml($konten, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $imageFile = $dom->getElementsByTagName('img');
            // Create profil first
            $fileUpload = new Profil;
            $fileUpload->judul = $request->judul;
            $fileUpload->id_kanal = $request->id_kanal;
            $fileUpload->id_kategori = $request->id_kategori;
            $fileUpload->konten = ''; // Will be updated later
            $fileUpload->save();
            foreach ($imageFile as $item => $image) {
                $data = $image->getAttribute('src');
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $imgeData = base64_decode($data);
                $fileName = time() . $item . '.png';
                $directory = "uploads/profil/{$fileUpload->id}"; // Use the ID of the profil as part of the directory

                // Store the image using Laravel's Storage
                Storage::put("public/$directory/$fileName", $imgeData);

                // Update the image src attribute in the HTML content
                $newSrc = Storage::url("$directory/$fileName");
                $image->setAttribute('src', $newSrc);
                $fileUploadFile = new ProfilHasFile();
                $fileUploadFile->path = $directory;
                $fileUploadFile->file = $fileName;
                $fileUploadFile->profil_id = $fileUpload->id;
                $fileUploadFile->save();
            }

            $konten = $dom->saveHTML();
            // Update profil with the final content
            $fileUpload->konten = $dom->saveHTML();
            $fileUpload->save();


            DB::commit();
            return response()->json(['status' => true, 'image' => $imageFile], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $decryptedId = decrypt($id);
            $data = Profil::findOrFail($decryptedId);

            $list_kanal = ListKanal::where('status', '1')->get();
            $list_kategori = ListKategori::where('status', '1')->get();

            return view('contents.profil.update', [
                'title' => 'Edit Profil',
                'data' => $data,
                'list_kanal' => $list_kanal,
                'list_kategori' => $list_kategori,
            ]);
        } catch (\Exception $e) {
            return redirect()->route('profil')->with('error', 'Invalid ID or Profil not found.');
        }
    }


    public function do_update(Request $request, $id)
    {
        $this->validate($request, [
            'judul' => 'required',
            'id_kanal' => 'required',
            'id_kategori' => 'required',
            'konten' => 'required'
        ]);

        try {
            DB::beginTransaction();

            $decrypted_id = decrypt($id);

            $konten = $request->konten;

            $dom = new \DomDocument();
            $dom->loadHtml($konten, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $imageFile = $dom->getElementsByTagName('img');

            // Update existing Profil
            $profil = Profil::findOrFail($decrypted_id);
            $profil->judul = $request->judul;
            $profil->id_kanal = $request->id_kanal;
            $profil->id_kategori = $request->id_kategori;
            $profil->konten = ''; // Will be updated later
            $profil->save();

            // Remove existing files related to the Profil
            ProfilHasFile::where('profil_id', $profil->id)->delete();

            // Process and save new files
            foreach ($imageFile as $item => $image) {
                $data = $image->getAttribute('src');
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $imgeData = base64_decode($data);
                $fileName = time() . $item . '.png';
                $directory = "uploads/profil/{$profil->id}";

                // Store the image using Laravel's Storage
                Storage::put("public/$directory/$fileName", $imgeData);

                // Update the image src attribute in the HTML content
                $newSrc = Storage::url("$directory/$fileName");
                $image->setAttribute('src', $newSrc);

                $fileUploadFile = new ProfilHasFile();
                $fileUploadFile->path = $directory;
                $fileUploadFile->file = $fileName;
                $fileUploadFile->profil_id = $profil->id;
                $fileUploadFile->save();
            }

            $konten = $dom->saveHTML();
            // Update Profil with the final content
            $profil->konten = $dom->saveHTML();
            $profil->save();

            DB::commit();
            return response()->json(['status' => true, 'image' => $imageFile], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }



    public function delete(Request $request)
    {
        $profil_id = decrypt($request->id);

        try {
            $profil = Profil::find($profil_id);

            $profil->delete();

            ProfilHasFile::where('profil_id', $profil_id)->delete();
            Storage::deleteDirectory("public/uploads/profil/{$profil_id}");

            if ($profil->trashed()) {
                return response()->json(['status' => true], 200);
            }
            return response()->json(['status' => false], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
}
