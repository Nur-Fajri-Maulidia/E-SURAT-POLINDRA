<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class JabatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Jabatan Index')->only(['index', 'data']);
        $this->middleware('can:Jabatan Delete')->only(['destroy']);
    }

    public function index()
    {
        return view('pages.jabatan.index', [
            'title' => 'Data Jabatan'
        ]);
    }

    public function data(Request $request)
    {
        if (request()->ajax()) {
            $data = Jabatan::query();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    if (cek_user_permission('Jabatan Update')) {
                        $edit =  "<button class='btn btn-sm py-2 btn-info btnEdit mx-1' data-id='$model->id' data-name='$model->name'><i class='fas fa fa-edit'></i> Edit</button>";
                    } else {
                        $edit = "";
                    }

                    if (cek_user_permission('Jabatan Delete')) {
                        $hapus = "<button class='btn btn-sm py-2 btn-danger btnDelete mx-1' data-id='$model->id' data-name='$model->name'><i class='fas fa fa-trash'></i> Hapus</button>";
                    } else {
                        $hapus = "";
                    }

                    return $edit . $hapus;
                })->addColumn('jabatan', function ($model) {
                    $jabatan = $model->nama;
                    return $jabatan ?? '-';
                })
                ->filter(function ($data) use ($request) {
                    if ($request->nama) {
                        $data->where('nama', $request->nama);
                    }
                })
                ->rawColumns(['action', 'jabatan'])
                ->make(true);
        }
    }

    public function store()
    {
        request()->validate([
            'nama' => ['required'],
        ]);

        DB::beginTransaction();
        try {
            Jabatan::updateOrCreate([
                'id'  => request('id')
            ], [
                'nama' => request('nama'),
            ]);

            if (request('id')) {
                $message = 'Jabatan updated successfully.';
            } else {
                $message = 'Jabatan created successfully.';
            }
            DB::commit();
            return response()->json(['status' => 'success', 'message' => $message]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => 'System Error!']);
        }
    }

    public function show($id)
    {
        if (request()->ajax()) {
            $jabatan = Jabatan::where('id', $id)->first();
            return response()->json($jabatan);
        }
    }

    public function get_by_unitkerja()
    {
        if (request()->ajax()) {
            $jabatan = Jabatan::get();
            return response()->json($jabatan);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            Jabatan::find($id)->delete();
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Jabatan deleted successfully.']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => 'System Error!']);
        }
    }
}
