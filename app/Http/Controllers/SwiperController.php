<?php

namespace App\Http\Controllers;

use App\Model\Swiper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class SwiperController extends Controller
{
    public function index(Request $request)
    {
        // $roles = Role::all();
        return view('contents.swiper.list', [
            'title' => 'Swiper',
            // 'roles' => $roles,
        ]);
    }

    public function data()
    {
        $data = Swiper::orderBy('id', 'desc')
            ->get();
        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,jfif|max:10240',
        ], [
            'foto.required' => '<strong style="color: red;">Foto Swiper wajib diunggah.</strong>',
            'foto.image' => '<strong style="color: red;">File yang diunggah harus berupa gambar.</strong>',
            'foto.mimes' => '<strong style="color: red;">Format gambar harus JPEG, PNG, JPG atau JFIF.</strong>',
            'foto.max' => '<strong style="color: red;">Maksimal ukuran gambar adalah 10240KB.</strong>',
        ]);

        try {

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $name = time() . '_' . $file->getClientOriginalName();
                $path = public_path() . '/storage/uploads/swiper';
                if (!File::isDirectory($path)) {
                    File::makeDirectory($path, 0775, true, true);
                }
                if ($file->move($path, $name)) {
                    $foto = $name;
                }
                $fotoName = 'storage/uploads/swiper/' . $foto;
            }

            $data = [
                'judul' => $request->input('judul'),
                // 'desc' => $request->input('desc'),
                // 'urutan' => $request->input('urutan'),
                // 'updated_at' => date('Y-m-d H:i:s'),
                // 'updated_id' => Auth::user()->id,
            ];
            if (!empty($fotoName)) {
                $data['foto'] = $fotoName;
            }
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_id'] = Auth::user()->id;
            Swiper::insert($data);

            return response()->json(['status' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    // public function update(Request $request)
    // {
    //     $id = $request->input('id');
    //     // $decryptedId = decrypt($id);
    //     $data = Swiper::find($id);

    //     try {
    //         if ($request->hasFile('foto')) {
    //             $file = $request->file('foto');
    //             $name = time() . '_' . $file->getClientOriginalName();
    //             $path = public_path() . '/uploads/swiper';
    //             if (!File::isDirectory($path)) {
    //                 File::makeDirectory($path, 0775, true, true);
    //             }
    //             if ($file->move($path, $name)) {
    //                 $foto = $name;
    //             }

    //             if (!empty($data->foto)) {
    //                 if (File::exists(public_path($data->foto))) {
    //                     File::delete(public_path($data->foto));
    //                 }
    //             }
    //             $fotoName = '/uploads/swiper/' . $foto;
    //         }
    //         $data = [
    //             'judul' => $request->input('judul'),
    //             // 'desc' => $request->input('desc'),
    //             // 'urutan' => $request->input('urutan'),
    //             'updated_at' => date('Y-m-d H:i:s'),
    //             'updated_id' => Auth::user()->id,
    //         ];
    //         if (!empty($fotoName)) {
    //             $data['foto'] = $fotoName;
    //         }
    //         Swiper::where('id', $id)->update($data);
    //     } catch (\Exception $e) {
    //         return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
    //     }
    // }
    public function update(Request $request)
    {
        try {
            $swiper = Swiper::find($request->id);
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $name = time() . '_' . $file->getClientOriginalName();
                $path = public_path() . '/storage/uploads/swiper';
                if (!File::isDirectory($path)) {
                    File::makeDirectory($path, 0775, true, true);
                }
                if ($file->move($path, $name)) {
                    $foto = $name;
                }

                if (!empty($swiper->foto)) {
                    if (File::exists(public_path($swiper->foto))) {
                        File::delete(public_path($swiper->foto));
                    }
                }
                $fotoName = 'storage/uploads/swiper/' . $foto;

                if (!empty($fotoName)) {
                    $swiper->foto = $fotoName;
                }
            }

            $swiper->judul = $request->judul;
            $swiper->updated_at = date('Y-m-d H:i:s');
            $swiper->updated_id = Auth::user()->id;

            if ($swiper->isDirty()) {
                $swiper->save();
            }

            if ($swiper->wasChanged()) {
                return response()->json(['status' => true], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }


    public function switchStatus(Request $request)
    {
        try {
            $swiper = Swiper::find($request->id);

            $swiper->is_active = $request->value;

            if ($swiper->isDirty()) {
                $swiper->save();
            }

            if ($swiper->wasChanged()) {
                return response()->json(['status' => true], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            $swiper = Swiper::find($request->id);

            $swiper->delete();

            if ($swiper->trashed()) {
                return response()->json(['status' => true], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
}
