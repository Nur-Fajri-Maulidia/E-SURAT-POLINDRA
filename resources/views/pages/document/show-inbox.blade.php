@extends('layouts.app')
@section('title')
    Lihat Detail Surat Masuk
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="card-title"><b>{{ $title }}</b></span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <b>No. Surat</b>
                            <br>
                            <span>{{ $item->no_surat }}</span>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Hal</b>
                            <br>
                            <span>{{ $item->hal }}</span>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Deskripsi</b>
                            <br>
                            <span>{{ $item->deskripsi }}</span>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Keterangan</b>
                            <br>
                            <span>{{ $item->keterangan }}</span>
                        </div>
                        <div class="col-md-12 mb-4">
                            <b>Tanggal Submit</b>
                            <br>
                            <span>{{ $item->created_at->translatedFormat('H:i:s d-m-Y') }}</span>
                        </div>
                        @if ($item->category->name === 'surat tugas' || $item->category->name === 'Surat Tugas')
                            @if ($item->tte_spd_created)
                                <div class="col-md-6 col-lg-6 mb-2">
                                    <b>Download File TTE SPD</b>
                                    <br>
                                    @if ($item->tte_spd_created)
                                        <a href="{{ route('documents.tte.spd.download', [
                                            'uuid' => $item->uuid,
                                        ]) }}"
                                            class="btn btn-success btn-sm">Download</a>
                                    @else
                                        <a href="javascript:void(0)"
                                            class="btn btn-secondary disable text-white btn-sm">Tidak
                                            Tersedia</a>
                                    @endif
                                </div>
                            @endif
                            @if ($item->tte_visum_umum_created_user_id)
                                <div class="col-md-6 col-lg-6 mb-2">
                                    <b>Download File TTE Visum Umum</b>
                                    <br>
                                    @if ($item->tte_visum_umum_created)
                                        <a class="btn btn-success btn-sm"
                                            href="{{ route('documents.tte.visum-umum.download', ['uuid' => $item->uuid]) }}">Download</a>
                                    @else
                                        <a href="javascript:void(0)"
                                            class="btn btn-secondary disable text-white btn-sm">Tidak
                                            Tersedia</a>
                                    @endif
                                </div>
                            @endif
                        @endif
                        @foreach ($item->attachments as $key => $lampiran)
                            <div class="col-md-2 mb-4">
                                <b>Lampiran {{ $key + 1 }}</b>
                                <br>
                                <a href="{{ route('document-attachments.download', [
                                    'id' => encrypt($lampiran->id),
                                ]) }}"
                                    class="btn btn-success btn-sm">Download</a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer">
                    <button onclick="window.history.back()" class="btn btn-md text-white btn-warning mb-3">Kembali</button>
                </div>
            </div>
        </div>
    </div>
@endsection
<x-Admin.Sweetalert />
