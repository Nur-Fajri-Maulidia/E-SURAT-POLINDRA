<?php

namespace App\Http\Controllers;

use App\Models\Pangkat;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PangkatController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Pangkat Index')->only(['index', 'data']);
        $this->middleware('can:Pangkat Delete')->only(['destroy']);
    }

    public function index()
    {
        return view('pages.pangkat.index', [
            'title' => 'Data Pangkat'
        ]);
    }

    public function data()
    {
        if (request()->ajax()) {
            $data = Pangkat::query();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    if (cek_user_permission('Pangkat Update')) {
                        $edit =  "<button class='btn btn-sm py-2 btn-info btnEdit mx-1' data-id='$model->id' data-name='$model->name'><i class='fas fa fa-edit'></i> Edit</button>";
                    } else {
                        $edit = "";
                    }

                    if (cek_user_permission('Pangkat Delete')) {
                        $hapus = "<button class='btn btn-sm py-2 btn-danger btnDelete mx-1' data-id='$model->id' data-name='$model->name'><i class='fas fa fa-trash'></i> Hapus</button>";
                    } else {
                        $hapus = "";
                    }

                    return $edit . $hapus;
                })->addColumn('pangkat', function ($model) {
                    $pangkat = $model->name;
                    return $pangkat ?? '-';
                })
                ->filter(function ($instance) {
                    if (request('name')) {
                        $instance->where('name', request('name'));
                    }
                })
                ->rawColumns(['action', 'pangkat'])
                ->make(true);
        }
    }

    public function store()
    {
        request()->validate([
            'name' => ['required'],
        ]);

        DB::beginTransaction();
        try {
            Pangkat::updateOrCreate([
                'id'  => request('id')
            ], [
                'name' => request('name'),
            ]);

            if (request('id')) {
                $message = 'Pangkat Berhasil Diperbarui';
            } else {
                $message = 'Pangkat Berhasil Ditambahkan';
            }
            DB::commit();
            return response()->json(['status' => 'success', 'message' => $message]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => 'Terjadi Kesalahan!']);
        }
    }

    public function show($id)
    {
        if (request()->ajax()) {
            $pangkat = Pangkat::where('id', $id)->first();
            return response()->json($pangkat);
        }
    }

    public function getByName()
    {
        if (request()->ajax()) {
            $pangkat = Pangkat::get();
            return response()->json($pangkat);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            Pangkat::find($id)->delete();
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Pangkat Berhasil Dihapus']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => 'Terjadi Kesalahan!']);
        }
    }
}
