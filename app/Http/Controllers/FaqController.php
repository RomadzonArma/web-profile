<?php

namespace App\Http\Controllers;

use App\Model\Faq;
use Illuminate\Http\Request;
use App\Mail\JawabanPertanyaanEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required ',
            'pertanyaan' => 'required ',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'email.required' => 'Email tautan wajib diisi',
            'pertanyaan.required' => 'Pertanyaan tautan wajib diisi',


        ]);

        if ($validasi->fails()) {
            return response()->json(['erorrs' => $validasi->errors()]);
        } else {

            $data = [
                'nama' => $request->nama,
                'email' => $request->email,
                'pertanyaan' => $request->pertanyaan,
                'tgl_pertanyaan' => now(),
            ];
            Faq::create($data);
            return response()->json(['status' => true], 200);
        }
    }

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

        Faq::where('id', $id)->update($data);


        // Mengambil data pertanyaan
        // $faq = Faq::find($id);

        // // Memeriksa apakah pertanyaan ditemukan
        // if ($faq) {
        //     // Memeriksa apakah ada pengguna terkait dengan pertanyaan
        //     $user = $faq->user;
        //     if ($user) {
        //         // Kirim email jawaban
        //         $email = new JawabanPertanyaanEmail($faq, $user);
        //         Mail::to($user->email)->send($email);
        //     } else {
        //         // Tindakan jika pengguna tidak ditemukan
        //         // Misalnya, log pesan kesalahan atau tindakan lain yang sesuai
        //     }
        // } else {
        //     // Tindakan jika pertanyaan tidak ditemukan
        //     // Misalnya, log pesan kesalahan atau tindakan lain yang sesuai
        // }

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
