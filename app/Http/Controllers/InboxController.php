<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Category;
use App\Models\Letter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class InboxController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:Surat Masuk Index')->only(['index']);
    }

    public function index()
    {
        $category = Category::with('document')->get();
        $tahun_sekarang = Carbon::now()->format('Y');
        return view('pages.inbox.index', [
            'title' => 'Data Surat Masuk',
            'tahun_sekarang' => $tahun_sekarang,
            'categories' => $category
        ]);
    }

    public function data(Request $request)
    {
        if (request()->ajax()) {
            $jenis = request('jenis');
            $tahun = request('tahun');
            if ($jenis == null) {
                if ($tahun) {
                    $data = Document::whereYear('created_at', $tahun)->with('disposisi.units')
                        ->whereHas('unit_kerja', function ($q) {
                            $q->where('id', Auth::user()->unit_kerja_id);
                        })
                        ->orWhereHas('user_id', function ($q) {
                            $q->where('id', Auth::user()->id);
                        })
                        ->orWhereHas('disposisi.units', function ($q) {
                            $q->where('user_id', Auth::user()->id);
                        })->orderBy('created_at', 'desc')->get();
                } else {
                    $data = Document::with('getDisposisi.units')->whereHas('unit_kerja', function ($q) {
                        $q->where('id', Auth::user()->unit_kerja_id);
                    })
                        ->orWhereHas('user_id', function ($q) {
                            $q->where('id', Auth::user()->id);
                        })->orWhereHas('disposisi.units', function ($q) {
                            $q->where('user_id', Auth::user()->id);
                        })->orderBy('created_at', 'desc')->get();
                }
            } elseif ($jenis == !null) {
                if ($tahun) {
                    $data = Document::whereYear('created_at', $tahun)->whereHas('unit_kerja', function ($q) {
                        $q->where('id', Auth::user()->unit_kerja_id);
                    })->with('disposisi.units')->where('category_id', $jenis)
                        ->orWhere(function ($query) use ($jenis) {
                            $query->whereHas('user_id', function ($q) {
                                $q->where('id', Auth::user()->id);
                            })->where('category_id', $jenis);
                        })->orWhereHas('disposisi.units', function ($q) {
                            $q->where('user_id', Auth::user()->id);
                        })->orderBy('created_at', 'desc')->get();
                } else {
                    $data = Document::with('getDisposisi.units')->whereHas('unit_kerja', function ($q) {
                        $q->where('id', Auth::user()->unit_kerja_id);
                    })->where('category_id', $jenis)
                        ->orWhere(function ($query) use ($jenis) {
                            $query->whereHas('user_id', function ($q) {
                                $q->where('id', Auth::user()->id);
                            })->where('category_id', $jenis);
                        })->orderBy('created_at', 'desc')->get();
                }
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    $link_disposisi = route('documents.disposisi.index', [
                        'uuid' => $model->uuid
                    ]);
                    $link_detail = route('documents.inbox.show', [
                        'uuid' => $model->uuid
                    ]);
                    $link_create_tte = route('documents.tte.index', [
                        'uuid' => $model->uuid ?? 0
                    ]);
                    if (cek_user_permission('Document Disposisi')) {
                        $btn = $model->disposisi ? 'btn-info' : 'btn-secondary';
                        $document_disposisi = "<a href='$link_disposisi' class='btn btn-sm py-2 text-white $btn mx-1' ><i class='fas fa fa-eye'></i> Disposisi</a>";
                    } else {
                        $document_disposisi = "";
                    }
                    if (cek_user_permission('Surat Masuk TTE')) {
                        $btn = $model->tte_created_user_id ? 'btn-success' : 'btn-secondary';
                        $tte = "<a href='$link_create_tte' class='btn btn-sm py-2 text-white $btn mx-1' ><i class='fas fa fa-eye'></i> TTE</a>";
                    } else {
                        $tte = "";
                    }

                    if (cek_user_permission('Surat Masuk Show')) {
                        $detail = "<a href='$link_detail' class='btn btn-sm py-2 btn-warning mx-1' data-id='$model->id' data-name='$model->name'><i class='fas fa fa-edit'></i> View</a>";
                    } else {
                        $detail = "";
                    }
                    return $document_disposisi . $tte  . $detail;
                })
                ->addColumn('tujuan', function ($model) {
                    return $model->unit_kerja->name ?? ($model->user_id ? $model->user_id->name : null);
                })
                ->rawColumns(['action', 'tujuan'])
                ->make(true);
        }
    }
}
