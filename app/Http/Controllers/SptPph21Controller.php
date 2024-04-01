<?php

namespace App\Http\Controllers;

use App\Model\SptPph21;
use App\Model\SptPph21HasDokumen;
use App\User;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class SptPph21Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(SptPph21::with('dokumen')->get());
        return view('contents.spt_pph_21.index', [
            'title' => 'List SPT PPH 21'
        ]);
    }

    public function data()
    {
        $list = SptPph21::with('dokumen')->select(DB::raw('*'));

        return DataTables::of($list)
            ->addIndexColumn()
            ->addColumn('id', function ($row) {
                return encrypt($row->id);
            })
            ->addColumn('files', function ($row) {
                if (count($row->dokumen)) {
                    $html = '<button type="button" class="btn btn-success btn-rounded"  onclick="lihat_dokumen(\'' . encrypt($row->id) . '\');">
                        <i class="fas fa-download mr-1"></i> Lihat Dokumen
                    </button>';
                } else {
                    $html = '<button type="button" class="btn btn-danger btn-rounded" onclick="$(\'#input-file-ini-' . ($row->id) . '\').trigger(\'click\');">
                        <i class="fas fa-ban mr-1"></i> Tidak Ada Dokumen
                    </button><input style="display: none;" accept=".pdf" type="file" name="dokumen[]" multiple id="input-file-ini-' . ($row->id) . '" data-id="' . encrypt($row->id) . '" onchange="upload_dokumen(this)">
                    ';
                }
                return $html;
            })
            ->rawColumns(['files'])
            ->make();
    }

    /**
     * Show the form 
     *
     * @return \Illuminate\Http\Response
     */
    public function form(Request $request)
    {
        if ($request->id) {
            $id = decrypt($request->id);
            $data = SptPph21::find($id);
            $data->encrypted_id = encrypt($data->id);
        } else {
            $data = [];
        }
        return view('contents.spt_pph_21.form', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $validasi = Validator::make($request->all(), [
            'judul' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validasi untuk file gambar
            'dokumen' => 'required', // Validasi untuk file dokumen
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validasi->errors()
            ]);
        } else {
            // Proses upload gambar
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $name = time() . '_' . $file->getClientOriginalName();
                $path = public_path() . '/storage/uploads/spt_pph_21';
                if (!File::isDirectory($path)) {
                    File::makeDirectory($path, 0775, true, true);
                }
                if ($file->move($path, $name)) {
                    $gambar = $name;
                }
                $gambarName = 'storage/uploads/spt_pph_21/' . $gambar;
            }

            // Data yang akan disimpan
            $insert = new SptPph21();
            $insert->judul = $request->judul;
            $insert->gambar = $gambarName;
            $insert->saveOrFail();

            if ($request->hasFile('dokumen')) {
                $allowedfileExtension = ['pdf'];
                $files = $request->file('dokumen');
                $insert_batch = [];
                foreach ($files as $file) {
                    $extension = $file->getClientOriginalExtension();
                    $check = in_array($extension, $allowedfileExtension);
                    if ($check) {
                        $names = time() . '_' . $file->getClientOriginalName();
                        $path = public_path() . '/storage/uploads/spt_pph_21';
                        if (!File::isDirectory($path)) {
                            File::makeDirectory($path, 0775, true, true);
                        }
                        if ($file->move($path, $names)) {
                            $gambar = $names;
                        }
                        $gambarName = 'storage/uploads/spt_pph_21/' . $gambar;
                        $insert_batch[] = [
                            'id_ref' => $insert->id,
                            'file' => $gambarName
                        ];
                    }
                }

                if (!empty($insert_batch)) {
                    SptPph21HasDokumen::insert($insert_batch);
                }
            }

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menyimpan data'
            ], 200);
        }
    }

    public function update(Request $request)
    {
        $id = decrypt($request->id);
        // Validasi data yang diterima dari form
        $validasi = Validator::make($request->all(), [
            'judul' => 'required',
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validasi->errors()
            ]);
        } else {
            $update = SptPph21::findOrFail($id);
            $update->judul = $request->judul;

            // Proses upload gambar
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $name = time() . '_' . $file->getClientOriginalName();
                $path = public_path() . '/storage/uploads/spt_pph_21';
                if (!File::isDirectory($path)) {
                    File::makeDirectory($path, 0775, true, true);
                }
                if ($file->move($path, $name)) {
                    $gambar = $name;
                }
                $gambarName = 'storage/uploads/spt_pph_21/' . $gambar;
                if (File::isFile(public_path() . $update->gambar)) {
                    File::delete($update->gambar);
                }
                $update->gambar = $gambarName;
            }

            // Data yang akan disimpan
            $update->saveOrFail();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menyimpan data'
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $id = decrypt($request->id);
        try {
            $data = SptPph21::findOrFail($id);
            $data->delete();
            if ($data->trashed()) {
                return response()->json(['status' => true], 200);
            }
            return response()->json(['status' => false], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    function lihat_dokumen(Request $request)
    {
        $id = decrypt($request->id);
        $data = SptPph21::with(['dokumen' => function ($q) {
            $q->orderBy('id', 'desc');
        }])->find($id);
        $data->encrypted_id = encrypt($data->id);
        foreach ($data->dokumen as $key => $value) {
            $value->encrypted_id = encrypt($value->id);
            $explode = explode('/', $value->file);
            $explode2 = explode('.', end($explode));
            $extension = end($explode2);
            $value->extension = $extension;
        }
        return view('contents.spt_pph_21.lihat_dokumen', compact('data'));
    }

    function hapus_dokumen(Request $request)
    {
        $id = decrypt($request->id);
        $id_ref = decrypt($request->id_ref);
        $data = SptPph21HasDokumen::find($id);
        if (File::isFile($data->file)) {
            File::delete($data->file);
        }

        $data->delete();

        $count = SptPph21HasDokumen::where('id_ref', $id_ref)->get()->count();
        if ($count) $reload = false;
        else $reload = true;

        return response()->json([
            'status' => true,
            'message' => 'Berhasil menghapus dokumen',
            'reload' => $reload
        ]);
    }

    function upload_dokumen(Request $request)
    {
        $id = decrypt($request->id);
        if ($request->hasFile('dokumen')) {
            $allowedfileExtension = ['pdf', 'jpeg', 'jpg', 'png'];
            $files = $request->file('dokumen');
            $insert_batch = [];
            foreach ($files as $file) {
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension, $allowedfileExtension);
                if ($check) {
                    $names = time() . '_' . $file->getClientOriginalName();
                    $path = public_path() . '/storage/uploads/spt_pph_21';
                    if (!File::isDirectory($path)) {
                        File::makeDirectory($path, 0775, true, true);
                    }
                    if ($file->move($path, $names)) {
                        $gambar = $names;
                    }
                    $gambarName = 'storage/uploads/spt_pph_21/' . $gambar;
                    $insert_batch[] = [
                        'id_ref' => $id,
                        'file' => $gambarName
                    ];
                }
            }

            if (!empty($insert_batch)) {
                SptPph21HasDokumen::insert($insert_batch);
            }
        }
        return response()->json([
            'status' => true,
            'message' => 'Berhasil mengupload dokumen',
        ]);
    }
}
