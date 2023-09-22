<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\{Document, Pangkat, Tugas, Tujuan, PengikutTugas};
use App\Models\DocumentAttachment;
use App\Models\DocumentDetails;
use App\Models\Notification;
use App\Models\UnitKerja;
use App\Models\{Jabatan, User};
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DocumentController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:Surat Umum Create')->only(['store', 'create']);
        $this->middleware('can:Surat Masuk TTE')->only(['tte_create']);
    }

    public function getUser(Request $request)
    {
        $search = $request->q;
        $loggedInUserId = Auth::user()->id;
        $query = User::where('name', 'LIKE', '%' . $search . '%')
            ->where('id', '!=', $loggedInUserId)
            ->orderBy('id', 'asc')
            ->get();
        $response = [];
        foreach ($query as $data) {
            $response[] = [
                'id' => $data->id,
                'text' => $data->name,
            ];
        }
        return response()->json($response);
    }

    public function getCategory(Request $request)
    {
        $search = $request->q;
        if (Auth::user()->id == '1') {
            $query = Category::where('name', 'LIKE', '%' . $search . '%')
                ->orderBy('id', 'asc')
                ->get();
        } else {
            $query = Category::where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%')
                    ->whereIn('name', ['Surat Undangan', 'Surat Umum']);
            })
                ->orderBy('id', 'asc')
                ->get();
        }
        $response = [];
        foreach ($query as $data) {
            $response[] = [
                'id' => $data->id . '-' . $data->name,
                'text' => $data->name,
            ];
        }
        return response()->json($response);
    }

    public function create()
    {
        $auth = Auth::user()->unit_kerja_id;
        $jabatanList = Jabatan::all();
        $ketuaList = User::whereNotNull('jabatan_id')->get();
        if ($auth >= 1 && $auth <= count($jabatanList)) {
            $jabatan = $jabatanList[$auth - 1]->nama;
            $ketua = $ketuaList->where('jabatan_id', $auth)->first();
            if ($ketua) {
                $ketuaJabatan = $ketua;
            } else {
                $ketuaJabatan = 'Ketua Tidak Ditemukan';
            }
        } else {
            $jabatan = 'Jabatan Tidak Ditemukan';
            $ketuaJabatan = 'Ketua Tidak Ditemukan';
        }

        $unit_kerjas = UnitKerja::orderBy('name', 'ASC')->get();
        if (Auth::user()->jabatan_id == null) {
            $categories = Category::orderBy('name', 'ASC')->get();
        } else {
            $categories = Category::where('name', 'Surat Undangan')
                ->orWhere('name', 'Surat Umum')
                ->orderBy('name', 'ASC')->get();
        }

        $users = User::orderBy('name', 'ASC')->get();
        return view('pages.document.create', [
            'title' => 'Buat Surat Khusus',
            'unit_kerjas' => $unit_kerjas,
            'categories' => $categories,
            'users' => $users,
            'item' => '',
            'jabatan' => $jabatan,
            'ketua' => $ketuaJabatan,
        ]);
    }

    public function store(Request $request)
    {
        $requestData = $request->validate([
            'category_id' => ['required'],
            'to_unit_kerja_id' => ['required_if:to_user_id,', 'nullable'],
            'to_user_id' => ['required_if:to_unit_kerja_id,', 'nullable'],
            'to_tembusan_user_id' => ['required'],
            'hal' => ['required'],
            'deskripsi' => ['required'],
            'keterangan' => ['required'],
            'lampiran.*' => 'required|mimes:jpg,jpeg,png,pdf,docx|max:20000',
            'lampiran.*.required' => 'Please upload an image',
            'lampiran.*.mimes' => 'Only jpeg, png and pdf, docx images are allowed',
            'lampiran.*.max' => 'Sorry! Maximum allowed size for an image is 20MB',
        ]);

        $category = explode('-', $request->category_id);

        DB::beginTransaction();
        try {
            $nomor_surat = Document::getNewCode($category[0]);

            // $data = $request->only(['to_unit_kerja_id', 'to_tembusan_unit_kerja_id', 'to_tembusan_user_id', 'hal', 'deskripsi', 'keterangan', 'body', 'category_id']);

            $data = [
                'from_user_id' => Auth::user()->id,
                'uuid' => Uuid::uuid4(),
                'no_surat' => $nomor_surat,
                'category_id' => $category[0],
                'to_tembusan_user_id' => $request->to_tembusan_user_id,
                'hal' => $request->hal,
                'deskripsi' => $request->deskripsi,
                'keterangan' => $request->keterangan,
            ];

            if ($request->has('to_unit_kerja_id')) {
                $data['to_unit_kerja_id'] = $request->to_unit_kerja_id;
            } elseif ($request->has('to_user_id')) {
                $data['to_user_id'] = $request->to_user_id;
            }

            if (strtolower($category[1]) === 'surat tugas') {
                $data['visum_umum'] = $request->visum_umum;
                $data['spd'] = $request->spd;
            } elseif ($category[1] !== 'Surat Tugas' && $category[1] !== 'surat tugas') {
                $data['body'] = $request->body;
            }

            $document = Document::create($data);
            if (strtolower($category[1]) === 'surat tugas') {
                $tugas = Tugas::create([
                    'document_id' => $document->id,
                    'user_id' => $request->user_id,
                    'pembuka' => $request->pembuka,
                    'isi' => $request->isi,
                    'penutup' => $request->penutup,
                    'from' => $request->from,
                    'from_time' => $request->from_time,
                    'to' => $request->to,
                    'to_time' => $request->to_time,
                    'tempat' => $request->tempat,
                    'pembukaan' => $request->pembukaan1,
                    'penutupan' => $request->pembukaan2,
                    'biaya' => $request->biaya,
                    'alat' => $request->alat,
                    'catatan' => $request->catatan,
                ]);
                $fromDetails = $request->input('from_detail');
                $fromTimeDetails = $request->input('from_time_detail');
                $toDetails = $request->input('to_detail');
                $toTimeDetails = $request->input('to_time_detail');
                $pengikutDetails = $request->input('pengikut');
                $keteranganPengikutDetails = $request->input('keterangan_pengikut');

                for ($i = 0; $i < count($fromDetails); $i++) {
                    $tujuan = Tujuan::create([
                        'tugas_id' => $tugas->id,
                        'from' => $fromDetails[$i],
                        'from_time' => $fromTimeDetails[$i],
                        'to' => $toDetails[$i],
                        'to_time' => $toTimeDetails[$i],
                    ]);

                    $pengikut = PengikutTugas::create([
                        'tugas_id' => $tugas->id,
                        'user_id' => $pengikutDetails[$i],
                        'keterangan' => $keteranganPengikutDetails[$i],
                    ]);
                }
            }

            $lampiran = $request->file('lampiran');

            if ($lampiran) {
                // insert lampiran
                foreach ($lampiran as $lamp) {
                    $document->attachments()->create([
                        'file' => $lamp->store('document', 'public')
                    ]);
                }
            }

            $notification = [
                'surat_id' => $document->id,
                'from_user' => Auth::user()->id,
                'judul' => Auth::user()->name . ' mengirimkan Surat Nomor: ' . $document->no_surat,
                'jenis' => $document->category->name,
            ];

            if ($request->has('to_unit_kerja_id')) {
                $notification['to_unit_kerja'] = $request->to_unit_kerja_id;
            } elseif ($request->has('to_user_id')) {
                $notification['to_user'] = $request->to_user_id;
            }
            // send notifikasi
            Notification::create($notification);

            DB::commit();
            return redirect()->route('dashboard')->with('success', 'Document Created successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('documents.create')->with('error', 'System Error: ' . $th->getMessage())->withInput();
        }
    }

    public function show($uuid)
    {
        $item = Document::where('uuid', $uuid)->firstOrFail();
        return view('pages.document.show', [
            'title' => 'Detail Surat ' . $item->no_surat,
            'item' => $item
        ]);
    }

    public function show_inbox($uuid)
    {
        $item = Document::where('uuid', $uuid)->firstOrFail();
        return view('pages.document.show-inbox', [
            'title' => 'Detail Surat',
            'item' => $item
        ]);
    }

    public function edit($uuid)
    {
        $item = Document::where('uuid', $uuid)->firstOrFail();
        $unit_kerjas = UnitKerja::orderBy('name', 'ASC')->get();
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('pages.document.edit', [
            'title' => 'Buat Surat Khusus',
            'unit_kerjas' => $unit_kerjas,
            'categories' => $categories,
            'item' => $item
        ]);
    }

    public function update(Request $request, $uuid)
    {
        $requestData = $request->validate([
            'to_unit_kerja_id' => ['required_if:to_user_id,', 'nullable'],
            'to_user_id' => ['required_if:to_unit_kerja_id,', 'nullable'],
            'to_tembusan_user_id' => ['required'],
            'hal' => ['required'],
            'deskripsi' => ['required'],
            'keterangan' => ['required'],
            'lampiran.*' => 'required|mimes:jpg,jpeg,png,pdf,docx|max:20000',
            'lampiran.*.required' => 'Please upload an image',
            'lampiran.*.mimes' => 'Only jpeg, png and pdf, docx images are allowed',
            'lampiran.*.max' => 'Sorry! Maximum allowed size for an image is 20MB',
        ]);

        $document = Document::where('uuid', $uuid)->firstOrFail();
        DB::beginTransaction();
        try {
            $data = [
                'to_tembusan_user_id' => $requestData['to_tembusan_user_id'],
                'hal' => $request->hal,
                'deskripsi' => $request->deskripsi,
                'keterangan' => $requestData['keterangan'],
            ];

            if ($request->has('to_unit_kerja_id')) {
                $data['to_unit_kerja_id'] = $requestData['to_unit_kerja_id'];
            } elseif ($request->has('to_user_id')) {
                $data['to_user_id'] = $requestData['to_user_id'];
            }
            $document->update($data);

            if (strtolower($document->category->name) === 'surat tugas') {
                $tugas = $document->tugas[0];
                $tugas->update([
                    'user_id' => $request->user_id,
                    'pembuka' => $request->pembuka,
                    'isi' => $request->isi,
                    'penutup' => $request->penutup,
                    'from' => $request->from,
                    'from_time' => $request->from_time,
                    'to' => $request->to,
                    'to_time' => $request->to_time,
                    'tempat' => $request->tempat,
                    'pembukaan' => $request->pembukaan1,
                    'penutupan' => $request->pembukaan2,
                    'biaya' => $request->biaya,
                    'alat' => $request->alat,
                    'catatan' => $request->catatan,
                ]);

                // $tujuanDetails = $request->input('tujuan_detail');
                // $pengikutDetails = $request->input('pengikut_detail');
                $fromDetails = $request->input('from_detail');
                $fromTimeDetails = $request->input('from_time_detail');
                $toDetails = $request->input('to_detail');
                $toTimeDetails = $request->input('to_time_detail');
                $pengikutDetails = $request->input('pengikut');
                $keteranganPengikutDetails = $request->input('keterangan_pengikut');
            } else {
                $data['body'] = $request->body;
            }
            // send notifikasi
            $notif = [
                'judul' => auth()->user()->name . ' memperbarui Surat Nomor: ' . $document->no_surat,
                'jenis' => $document->category->name,
                'from' => auth()->user()->name,
            ];
            if ($document->to_unit_kerja_id) {
                $notif['to_unit_kerja'] = $document->to_unit_kerja_id;
            } elseif ($document->to_user_id) {
                $notif['to_user'] = $document->to_user_id;
            }
            if ($document->id) {
                $notif['surat_id'] = $document['id'];
            }

            Notification::create($notif);

            DB::commit();
            return redirect()->route('outbox.index')->with('success', 'Document Updated successfully.');
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return redirect()->route('documents.create')->with('error', 'System Error!');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $document = Document::findOrFail($id);
            foreach ($document->attachments as $lampiran) {
                Storage::disk('public')->delete($lampiran->file);
                DocumentAttachment::destroy($lampiran->id);
            }
            foreach ($document->tugas[0]->tujuan as $tujuan) {
                Tujuan::destroy($tujuan->id);
            }
            $document->delete();
            // hapus attachments
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Surat Berhasil Dihapus']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => 'Error']);
        }
    }

    public function tte($uuid)
    {
        $item = Document::where('uuid', $uuid)->firstOrFail();
        $users = User::whereNotIn('id', [auth()->id()])->get();
        return view('pages.document.tte', [
            'title' => 'TTE Surat ' . $item->no_surat,
            'users' => $users,
            'item' => $item,
        ]);
    }

    public function tte_create(Request $request, $uuid)
    {
        $request->validate([
            'tte_pin' => ['required']
        ]);

        $item = Document::where('uuid', $uuid)->firstOrFail();

        // cek pin TTE
        if (!Hash::check($request->tte_pin, Auth::user()->tte_pin)) {
            return redirect()->back()->with('error', 'PIN TTE Invalid.');
        }

        if ($item->category->code == 'ST' || $item->category->name == 'Surat Tugas') {
            $item->update([
                'tte_visum_umum_created_user_id' => Auth::user()->id,
                'tte_visum_umum_created' => now(),
                'tte_spd_created_user_id' => Auth::user()->id,
                'tte_spd_created' => now(),
            ]);
        }

        $url_qrcode = route('cek-letter', [
            'uuid' => $uuid
        ]);
        $image = QrCode::format('png')
            ->size(200)->errorCorrection('H')
            ->generate($url_qrcode);
        $output_directory = 'qr-code/document/';
        $public_directory = public_path($output_directory);

        if (!file_exists($public_directory)) {
            mkdir($public_directory, 0777, true);
        }

        $qr_name = 'QR-' . str_replace('/', '_', $item->no_surat);
        $output_file = $public_directory . '/' . $qr_name . '.png';
        file_put_contents($output_file, $image);

        $item->update([
            'tte_created_user_id' => Auth::user()->id,
            'tte_created' => Carbon::now(),
            'qrcode' => $output_directory . $qr_name . '.png'
        ]);

        return redirect()->route('documents.tte.index', [
            'uuid' => $uuid
        ])->with('success', 'TTE created successfully');
    }

    public function tte_download($uuid)
    {
        $item = Document::where('uuid', $uuid)->firstOrFail();
        if ($item->category->name == 'Surat Tugas') {
            $viewContent = view('pages.tte.document.tugas', [
                'item' => $item
            ])->render();
        } else {
            $viewContent = view('pages.tte.document.download', [
                'item' => $item
            ])->render();
        }

        $pdf = app()->make('dompdf.wrapper');
        $pdf->loadHTML($viewContent);

        $pdfFileName = 'Surat_' . $item->no_surat . '.pdf';

        return $pdf->download($pdfFileName);
    }
}
