<?php

namespace App\Http\Controllers;

use App\Model\Faq;
use Illuminate\Http\Request;
use App\Mail\JawabanPertanyaanEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\AnswerFAQMail;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_faq = Faq::all();

        return view('contents.Faq.list', [
            'title' => 'List Faq',
            'list_faq' => $list_faq,
        ]);
    }


    public function data()
    {
        $list = Faq::with('user')->get();

        return DataTables::of($list)
            ->addIndexColumn()
            ->addColumn('id', function ($row) {
                return encrypt($row->id);
            })
            ->make();
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
    // public function store(Request $request)
    // {
    //     $validasi = Validator::make($request->all(), [
    //         'nama' => 'required',
    //         'email' => 'required ',
    //         'pertanyaan' => 'required ',
    //         'kategori' => 'required ',
    //         'keperluan' => 'required ',
    //         'nip' => 'required ',
    //         'instansi' => 'required ',
    //         'jabatan' => 'required ',
    //         'nomor_hp' => 'required ',
    //     ], [
    //         'nama.required' => 'Nama wajib diisi',
    //         'email.required' => 'Email  wajib diisi',
    //         'pertanyaan.required' => 'Pertanyaan  wajib diisi',
    //         'kategori.required' => 'Kategori  wajib diisi',
    //         'keperluan.required' => 'Keperluan  wajib diisi',
    //         'nip.required' => 'NIP  wajib diisi',
    //         'instansi.required' => 'Instansi  wajib diisi',
    //         'jabatan.required' => 'Jabatan  wajib diisi',
    //         'nomor_hp.required' => 'Nomor HP  wajib diisi',


    //     ]);


    //     if ($validasi->fails()) {
    //         return response()->json(['erorrs' => $validasi->errors()]);
    //     } else {

    //         $data = [
    //             'nama' => $request->nama,
    //             'email' => $request->email,
    //             'pertanyaan' => $request->pertanyaan,
    //             'kategori' => $request->kategori,
    //             'keperluan' => $request->keperluan,
    //             'nip' => $request->nip,
    //             'instansi' => $request->instansi,
    //             'jabatan' => $request->jabatan,
    //             'nomor_hp' => $request->nomor_hp,
    //             'tgl_pertanyaan' => now(),
    //         ];


    //         return $data;
    //         // dd($data);
    //         Faq::create($data);
    //         return response()->json(['status' => true], 200);
    //     }
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = decrypt($id);
        $data = Faq::where('id', $id)->first();
        return response()->json(['result' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = decrypt($id);

        $data = [
            'jawaban' => $request->jawaban,
            'tgl_jawaban' => now(),
            'id_user' => Auth::id(),
        ];

        $faq = Faq::where('id', $id)->first();
        $faq->update($data);

        $userEmail = $faq->email; 
        Mail::to($userEmail)->send(new AnswerFAQMail($faq));

        return response()->json(['status' => true], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $list_faq_id = decrypt($request->id);

        try {
            $list_faq = Faq::find($list_faq_id);

            $list_faq->delete();


            if ($list_faq->trashed()) {
                return response()->json(['status' => true], 200);
            }
            return response()->json(['status' => false], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    
}
