<?php

namespace App\Http\Controllers;

use App\Models\{Document, Instansi, Jabatan};
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Spatie\Browsershot\Browsershot;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use DomPDF\Options;
use Illuminate\Support\Facades\View;
use DomPDF\DomPDF;

class TTEController extends Controller
{
    public function tte_visum_umum($uuid)
    {
        $item = Document::where('uuid', $uuid)->firstOrFail();
        return view('pages.tte.document.visum-umum.index', [
            'title' => 'TTE Visum Umum',
            'item' => $item
        ]);
    }

    public function tte_visum_umum_create($uuid)
    {
        request()->validate([
            'tte_pin' => ['required']
        ]);

        $item = Document::where('uuid', $uuid)->firstOrFail();

        // cek pin TTE
        if (!Hash::check(request()->tte_pin, auth()->user()->tte_pin)) {
            return redirect()->back()->with('error', 'PIN TTE Invalid.');
        }

        $url_qrcode = route('cek-visum-umum', [
            'uuid' => $uuid
        ]);
        $image = QrCode::format('png')
            // ->merge('img/t.jpg', 0.1, true)
            ->size(200)->errorCorrection('H')
            ->generate($url_qrcode);
        $output_file = 'qr-code/visum-umum/' . $uuid . '.png';
        Storage::disk('public')->put($output_file, $image);

        $item->update([
            'tte_visum_umum_created_user_id' => auth()->id(),
            'tte_visum_umum_created' => Carbon::now(),
            'visum_umum_qrcode' => $output_file
        ]);

        return redirect()->back()->with('success', 'TTE Visum Umum created successfully');
    }

    public function tte_visum_umum_download($uuid)
    {
        $document = Document::where('uuid', $uuid)->firstOrFail();
        $documents = Document::where('no_surat', $document->no_surat)->get();

        $viewContent = view('pages.tte.document.visum-umum.download', [
            'items' => $documents,
        ])->render();

        $pdf = app()->make('dompdf.wrapper');
        $pdf->loadHTML($viewContent);
        $pdfFileName = 'Visum_Umum_' . $document->no_surat . '.pdf';
        return $pdf->download($pdfFileName);
    }


    function intToRoman($num)
    {
        $romans = array(
            'M'  => 1000,
            'CM' => 900,
            'D'  => 500,
            'CD' => 400,
            'C'  => 100,
            'XC' => 90,
            'L'  => 50,
            'XL' => 40,
            'X'  => 10,
            'IX' => 9,
            'V'  => 5,
            'IV' => 4,
            'I'  => 1
        );
        $result = '';
        foreach ($romans as $roman => $value) {
            $matches = intval($num / $value);
            $result .= str_repeat($roman, $matches);
            $num = $num % $value;
        }
        return $result;
    }

    public function getPdf(Request $req, $uuid)
    {
        if ($req->ajax()) {
            $item = Document::where('uuid', $uuid)->firstOrFail();
            $path = 'storage/' . $item->visum_umum_qrcode;
            // $view = view('pages.tte.document.visum-umum.vs');
            $data = [
                'item' => $item,
                'path' => $path,
                // 'view' => $view,
            ];

            return view('pages.tte.document.visum-umum.vs', $data);
        }
    }

    public function tte_visum_umum_download_before_tte($uuid)
    {
        $item = Document::where('uuid', $uuid)->firstOrFail();
        // $qrcode = QrCode::size(400)->generate($item->uuid);\
        $pdf = Pdf::loadView('pages.tte.document.visum-umum.download-before-tte', [
            'item' => $item
        ]);
        return $pdf->download('Surat_Pra_TTE_' . $item->no_surat . '.pdf');
    }

    public function tte_spd($uuid)
    {
        $item = Document::where('uuid', $uuid)->firstOrFail();
        return view('pages.tte.document.spd.index', [
            'title' => 'TTE SPD',
            'item' => $item
        ]);
    }

    public function tte_spd_create($uuid)
    {
        request()->validate([
            'tte_pin' => ['required']
        ]);

        $item = Document::where('uuid', $uuid)->firstOrFail();

        // cek pin TTE
        if (!Hash::check(request()->tte_pin, auth()->user()->tte_pin)) {
            return redirect()->back()->with('error', 'PIN TTE Invalid.');
        }

        $url_qrcode = route('cek-spd', [
            'uuid' => $uuid
        ]);
        $image = QrCode::format('png')
            // ->merge('img/t.jpg', 0.1, true)
            ->size(200)->errorCorrection('H')
            ->generate($url_qrcode);
        $output_file = 'qr-code/spd/' . $uuid . '.png';
        Storage::disk('public')->put($output_file, $image);

        $item->update([
            'tte_spd_created_user_id' => auth()->id(),
            'tte_spd_created' => Carbon::now(),
            'spd_qrcode' => $output_file
        ]);

        return redirect()->back()->with('success', 'TTE SPD created successfully');
    }

    public function tte_spd_download($uuid)
    {
        $item = Document::where('uuid', $uuid)->firstOrFail();

        $instansi = Instansi::firstOrFail();
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

        $viewContent = view('pages.tte.document.spd.download', [
            'item' => $item,
            'jabatan' => $jabatan,
            'instansi' => $instansi
        ])->render();
        $pdf = app()->make('dompdf.wrapper');
        $pdf->loadHTML($viewContent);

        $pdfFileName = 'SPD_' . $item->no_surat . '.pdf';

        return $pdf->download($pdfFileName);
    }

    public function tte_spd_download_before_tte($uuid)
    {
        $item = Document::where('uuid', $uuid)->firstOrFail();
        // $qrcode = QrCode::size(400)->generate($item->uuid);\
        $pdf = Pdf::loadView('pages.tte.document.spd.download-before-tte', [
            'item' => $item
        ]);
        return $pdf->download('SPD_' . $item->no_surat . '.pdf');
    }
}
