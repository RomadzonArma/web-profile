<?php

namespace App\Http\Controllers;

use App\Model\Podcast;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PodcastController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contents.Podcast.list', [
            'title' => 'List Podcast'
        ]);
    }

    public function data()
    {
        $list = Podcast::all();

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
            $list_podcast = Podcast::findOrFail($decrypted_id);
            // dd($list_podcast);

            $list_podcast->status_publish = $request->value;

            if ($list_podcast->isDirty()) {
                $list_podcast->save();
            }

            if ($list_podcast->wasChanged()) {
                return response()->json(['status' => true], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'judul' => 'required',
            'deskripsi' => 'required ',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validasi untuk file gambar
            'date' => 'required ',
            'link_podcast' => 'required ',
        ], [
            'judul.required' => 'Judul wajib diisi',
            'deskripsi.required' => 'Deskripsi wajib diisi',
            'date.required' => 'Tanggal podcast wajib diisi',
            'link_podcast.required' => 'Link Podcast wajib diisi',
            'gambar.required' => 'Gambar wajib diisi',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.mimes' => 'Format gambar harus jpeg, png, atau jpg',
            'gambar.max' => 'Ukuran gambar tidak boleh melebihi 2MB',


        ]);

        if ($validasi->fails()) {
            return response()->json(['erorrs' => $validasi->errors()]);
        } else {

            // Proses upload gambar
            $gambarName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('podcast'), $gambarName);

            $data = [
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'date' => $request->date,
                'link_podcast' => $request->link_podcast,
                'gambar' => $gambarName,
            ];
            Podcast::create($data);
            return response()->json(['status' => true], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Podcast  $podcast
     * @return \Illuminate\Http\Response
     */
    public function show(Podcast $podcast)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Podcast  $podcast
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = decrypt($id);
        $data = Podcast::where('id', $id)->first();
        return response()->json(['result' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Podcast  $podcast
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = decrypt($id);
        $validasi = Validator::make($request->all(), [
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048', // Validasi untuk file gambar
        ], [

            'gambar.image' => 'File harus berupa gambar',
            'gambar.mimes' => 'Format gambar harus jpeg, png, atau jpg',
            'gambar.max' => 'Ukuran gambar tidak boleh melebihi 2MB',
        ]);

        if ($validasi->fails()) {
            return response()->json(['erorrs' => $validasi->errors()]);
        } else {

            $data = [
                'judul' => $request->judul_edit,
                'deskripsi' => $request->deskripsi_edit,
                'date' => $request->date_edit,
                'link_podcast' => $request->link_podcast_edit,
            ];


            if ($request->hasFile('gambar_edit')) {
                $gambarName = time() . '.' . $request->file('gambar_edit')->extension();
                $request->gambar_edit->move(public_path('podcast'), $gambarName);
                $data['gambar'] = $gambarName;
            }

            Podcast::where('id', $id)->update($data);
            return response()->json(['status' => true], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Podcast  $podcast
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $list_podcast_id = decrypt($request->id);

        try {
            $list_podcast = Podcast::find($list_podcast_id);

            $list_podcast->delete();


            if ($list_podcast->trashed()) {
                return response()->json(['status' => true], 200);
            }
            return response()->json(['status' => false], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
}
