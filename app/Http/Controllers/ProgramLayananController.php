<?php

namespace App\Http\Controllers;

use App\Model\ListKanal;
use App\Model\ListKategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Model\ProgramLayanan;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ProgramLayananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contents.program-layanan.index', [
            'title' => 'Program dan Layanan',
        ]);
    }
    public function data(Request $request)
    {
        $list = ProgramLayanan::with('list_kategori.list_kanal')->orderByDesc('created_at')->get();

        return DataTables::of($list)
            ->addIndexColumn()
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori   = ListKategori::all();
        return view('contents.program-layanan.create', [
            'title'     => 'Tambah Program Layanan',
            'kategori'  => $kategori,
        ]);
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
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('/storage/uploads/program-image'), $imageName);

            $program = ProgramLayanan::create([
                'title'             => $request->title,
                'slug'              => Str::slug($request->title),
                'short_description' => $request->short_description,
                'body'              => $request->body,
                'tag'               => $request->tag,
                'image'             => $imageName,
                'caption_image'     => $request->caption_image,
                'id_kategori'       => $request->id_kategori,
                'publish_date'       => $request->publish_date,

            ]);
            return response()->json(['success' => "Berhasil menyimpan data"]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $list = ProgramLayanan::with('kanal', 'kategori')->findOrFail($id);
        return view('contents.program-layanan.detail', [
            'title' => 'Detail Program Dan Layanan',
            'list'  => $list,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $list_kategori   = ListKategori::all();
        $data = ProgramLayanan::findOrFail($id);
        // dd($program);
        return view('contents.program-layanan.edit', [
            'title' => 'Edit Program Dan Layanan',
            'data'  => $data,
            'list_kategori'  => $list_kategori,
        ]);
    }


    public function update(Request $request, $id )
    {
        try {
            $program_id = decrypt($id);
            $program = ProgramLayanan::find($program_id );


            if ($request->hasFile('image')) {
                $oldImagePath = public_path('/storage/uploads/program-image') . '/' . $program->image;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }

                // Upload gambar baru
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('/storage/uploads/program-image'), $imageName);

                // Update data program dengan gambar baru
                $program->update([
                    'image' => $imageName,
                ]);
            }

            // Update data program tanpa gambar
            $program->update([
                'title'             => $request->title,
                'slug'              => Str::slug($request->title),
                'short_description' => $request->short_description,
                'body'              => $request->body,
                'tag'               => $request->tag,
                'caption_image'     => $request->caption_image,
                'id_kategori'       => $request->id_kategori,
                'publish_date'       => $request->publish_date,
            ]);

            return response()->json(['success' => "Berhasil memperbarui data"]);
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
            $program = ProgramLayanan::findOrFail($request->id);

            // Hapus gambar terkait jika ada
            $imagePath = public_path('/storage/uploads/program-image') . '/' . $program->image;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            // Hapus data program
            $program->delete();

            return response()->json(['success' => "Berhasil menghapus data"]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
    public function switchStatus(Request $request)
    {
        try{
            $program = ProgramLayanan::find($request->id);
            $program->status = $request->value;
            $program->save();
            // if($program->isDirty()){
            //     $program->save();
            // }
            if($program->wasChanged()){
                return response()->json(['status'=> true], 200);
            }
        }catch(\Exception $e){
            return response()->json(['status' => false, 'msg'=> $e->getMessage()], 400);
        }
    }

}
