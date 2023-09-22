<?php

namespace App\Http\Controllers\Penerima;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\{DocumentDisposisi, Document};
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class DisposisiController extends Controller
{
    public function getDisposisi()
    {
        $data = [];
        return view('pages.penerima.disposisi.index', $data);
    }

    public function requestDisposisi(Request $request)
    {
        if ($request->ajax()) {
            $data = DocumentDisposisi::all();
            return DataTables::of($data)
            ->addIndexColumn()->addColumn('action', function ($data) {
                $btn = '<div class="text-center">
                <button title="Lihat Detail Data ' . $data->id . '" class="view-disposisi text-white btn btn-sm py-2 mx-1 btn-warning" data-id="' . $data->id . '" onClick="showView(' . $data->id . ')">
                View
                </button>
                <button title="Delete Data' . $data->id . '" class="delete-disposisi text-white btn btn-sm py-2 mx-1 btn-danger" data-id="' . $data->id . '">
                            Hapus
                            </button>
                        </div>';
                return $btn;
            })->rawColumns(['action'])->make(true);
        }
    }

    public function viewDisposisi(Request $request)
    {
        if ($request->ajax()) {
            return view('pages.penerima.disposisi.data', $this->getDisposisiData($request));
        }
    }

    private function getDisposisiData(Request $request)
    {
        try {
            $id = $request->id;
            $views = DocumentDisposisi::get();
            $detail = null;
            foreach ($views as $view) {
                $hash = $view->id;
                if ($hash == $id) {
                    $detail = $view;
                    break;
                }
            }
            if (!$detail) {
                return response()->json(['error' => 'Data Tidak ditemukan'], 404);
            }
            $item = Document::firstOrFail();
            $data = [
                'view' => $detail,
                'item' => $item,
            ];
            return $data;
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi Kesalahan'], 500);
        }
    }

    public function tteDownload($uuid)
    {
        $item = Document::where('uuid', $uuid)->firstOrFail();
        $pdf = FacadePdf::loadView('pages.penerima.disposisi.pdf', [
            'item' => $item
        ]);

        return $pdf->download($item->uuid . '.pdf');
    }
}
