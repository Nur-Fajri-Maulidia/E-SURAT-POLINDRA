<?php

namespace App\Http\Controllers;

use App\Models\DocumentDisposisiUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocumentDisposisiUnitController extends Controller
{
    public function store()
{
    request()->validate([
        'user_id' => ['required'],
        'document_disposisi_id' => ['required']
    ]);

    DB::beginTransaction();

    try {
        $user_id = request('user_id');
        $document_disposisi_id = request('document_disposisi_id');

        $existingRecord = DocumentDisposisiUnit::where('user_id', $user_id)
            ->where('document_disposisi_id', $document_disposisi_id)
            ->first();

        if ($existingRecord) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => 'Unit dengan kombinasi'. request(user_id) .'dan document_disposisi_id yang sama sudah ada.']);
        }

        DocumentDisposisiUnit::create([
            'user_id' => $user_id,
            'document_disposisi_id' => $document_disposisi_id
        ]);

        DB::commit();

        return response()->json(['status' => 'success', 'message' => 'Unit berhasil disimpan.']);
    } catch (\Throwable $th) {
        //throw $th;
        DB::rollBack();
        return response()->json(['status' => 'error', 'message' => 'Gagal user sudah ada']);
    }
}


    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            DocumentDisposisiUnit::find($id)->delete();
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Penerima berhasil dihapus.']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
}
