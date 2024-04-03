<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AnswerFAQMail;
use App\Model\Faq;

class LayananTamuController extends Controller
{
    public function getJawaban(Request $request)
    {
        try {
            $this->validate($request, [
                'idksps' => 'required',
                'jawaban' => 'required',
                'tgl_jawaban' => 'required',
                'dijawab_oleh' => 'required',
            ]);

            $id = $request->idksps;
            $findFaq = Faq::where('id', $id)->first();

            if ($findFaq->jawaban == $request->jawaban) {
                return response()->json(['status' => true, 'msg' => 'Data diterima'], 200);
            }

            $data = [
                'jawaban' => $request->jawaban,
                'tgl_jawaban' => $request->tgl_jawaban,
                'dijawab_oleh' => $request->dijawab_oleh
            ];

            $faq = Faq::where('id', $id)->first();
            $faq->update($data);

            $userEmail = $faq->email;
            Mail::to($userEmail)->send(new AnswerFAQMail($faq));

            return response()->json(['status' => true, 'msg' => 'Data diterima'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
}
