<?php

namespace App\Http\Controllers;

use App\Model\ListKategori;
use App\Model\ProgramFokus;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProgramFokusController extends Controller
{
    public function index()
    {
        $program_fokus = ProgramFokus::first();
        return view('contents.program-fokus.index', [
            'title' => 'Program Fokus KSPSTK',
            'program_fokus' => $program_fokus,
        ]);
    }

    public function data(Request $request)
    {
        $list = ProgramFokus::with('list_kategori.list_kanal')->get();

        return DataTables::of($list)
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request)
    {
        $text = htmlspecialchars_decode($request->body);
        $this->validate($request, [
            'title' => 'required',
            'publish_date' => 'required',
            'link' => 'required',
            // 'body' => 'required',
        ], [
            'title.required' => '<strong style="color: red;">Judul wajib diisi.</strong>',
            'publish_date.required' => '<strong style="color: red;">Tanggal Publish wajib dipilih.</strong>',
            'link.required' => '<strong style="color: red;">Link wajib diisi.</strong>',
            // 'body.required' => '<strong style="color: red;">Konten wajib diisi.</strong>',
        ]);
        try {
            ProgramFokus::create([
                'title'             => $request->title,
                'slug'              => Str::slug($request->title),
                'publish_date'      => $request->publish_date,
                'link'              => $request->link,
                // 'body'              => $text,
                'tag'              => $request->tag,

            ]);
            return response()->json(['status' => true, 'msg' => 'Data unduhan berhasil disimpan'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request)
    {
        $text = htmlspecialchars_decode($request->body);
        $this->validate($request, [
            'title' => 'required',
            'publish_date' => 'required',
            'link' => 'required',
            // 'body' => 'required',
        ], [
            'title.required' => '<strong style="color: red;">Judul wajib diisi.</strong>',
            'publish_date.required' => '<strong style="color: red;">Tanggal Publish wajib dipilih.</strong>',
            'link.required' => '<strong style="color: red;">Link wajib diisi.</strong>',
            // 'body.required' => '<strong style="color: red;">Konten wajib diisi.</strong>',
        ]);

        try {
            $programFokus = ProgramFokus::findOrFail($request->id);

            $programFokus->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'publish_date' => $request->publish_date,
                'link' => $request->link,
                // 'body' => $text,
                'tag' => $request->tag,
            ]);

            return response()->json(['status' => true, 'msg' => 'Data unduhan berhasil diperbarui'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }


    public function switchStatus(Request $request)
    {
        try {
            $program_fokus = ProgramFokus::find($request->id);

            $program_fokus->status = $request->value;

            if ($program_fokus->isDirty()) {
                $program_fokus->save();
            }

            if ($program_fokus->wasChanged()) {
                return response()->json(['status' => true], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            $program_fokus = ProgramFokus::find($request->id);

            $program_fokus->delete();

            if ($program_fokus->trashed()) {
                return response()->json(['status' => true], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()], 400);
        }
    }
}
