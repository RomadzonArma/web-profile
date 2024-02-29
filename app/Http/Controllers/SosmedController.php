<?php

namespace App\Http\Controllers;

use App\Model\Sosmed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class SosmedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contents.Sosmed.list', [
            'title' => 'Sosial Media',
            'data' => Sosmed::first(),
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Sosmed  $sosmed
     * @return \Illuminate\Http\Response
     */
    public function show(Sosmed $sosmed)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Sosmed  $sosmed
     * @return \Illuminate\Http\Response
     */
    public function edit(Sosmed $sosmed)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Sosmed  $sosmed
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $id = decrypt($id);
        $validasi = Validator::make($request->all(), [
            'telepon' => 'required',
            'email' => 'required ',
            'facebook' => 'required ',
            'twitter' => 'required ',
            'youtube' => 'required ',
            'instagram' => 'required ',
            'whatsapp' => 'required ',
        ], [
            'telepon.required' => 'telepon   wajib diisi',
            'email.required' => 'email  wajib diisi',
            'facebook.required' => 'facebook  wajib diisi',
            'twitter.required' => 'twitter  wajib diisi',
            'youtube.required' => 'youtube  wajib diisi',
            'instagram.required' => 'instagram  wajib diisi',
            'whatsapp.required' => 'whatsapp  wajib diisi',


        ]);

        if ($validasi->fails()) {
            return response()->json(['erorrs' => $validasi->errors()]);
        } else {
            $data = [
                'telepon' => $request->telepon,
                'email' => $request->email,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'youtube' => $request->youtube,
                'instagram' => $request->instagram,
                'whatsapp' => $request->whatsapp,
            ];

            Sosmed::where('id', $id)->update($data);
            return response()->json(['status' => true], 200);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Sosmed  $sosmed
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sosmed $sosmed)
    {
        //
    }
}
