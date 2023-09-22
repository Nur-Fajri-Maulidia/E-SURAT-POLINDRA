@extends('layouts.app')
@section('title')
    {{ $title }}
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/js/pdfjs-dist/web/pdf_viewer.css') }}">
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="card-title">{{ $title }}</span>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-5 col-lg-5 mb-2">
                            <b>No. Surat</b>
                            <br>
                            <span>{{ $item->no_surat }}</span>
                        </div>
                        <div class="col-md-7 col-lg-7 mb-2">
                            <b>Deskripsi</b>
                            <br>
                            <span>{{ $item->deskripsi }}</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-5 col-lg-5 mb-2">
                            <b>Waktu Submit</b>
                            <br>
                            <span>{{ $item->created_at->translatedFormat('H:i:s d-m-Y') }}</span>
                        </div>
                        <div class="col-md-7 col-lg-7 mb-2">
                            <b>Keterangan</b>
                            <br>
                            <span>{{ $item->keterangan }}</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12 col-sm-12 col-lg-12">
                            <div class="row">
                                @foreach ($item->attachments as $key => $lampiran)
                                    <div class="col-md-3 col-lg-3 mb-2">
                                        <b>Lampiran {{ $key + 1 }}</b>
                                        <br>
                                        <a href="{{ route('document-attachments.download', [
                                            'id' => encrypt($lampiran->id),
                                        ]) }}" title="Download Lampiran {{ $key + 1 }}"
                                            class="btn btn-success btn-sm">Download</a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @if ($item->category->name === 'surat tugas' || $item->category->name === 'Surat Tugas')
                        <div class="row mb-3">
                            @if ($item->tte_spd_created)
                                <div class="col-md-5 col-sm-5 mb-2">
                                    <b>Download File SPD</b>
                                    <br>
                                    @if ($item->tte_spd_created)
                                        <a href="{{ route('documents.tte.spd.download', [
                                            'uuid' => $item->uuid,
                                        ]) }}" title="Download Surat Perjalanan Dinas {{ $item->no_surat }}"
                                            class="btn btn-success btn-sm">Download</a>
                                    @else
                                        <a href="javascript:void(0)"
                                            class="btn btn-secondary disable text-white btn-sm">Tidak
                                            Tersedia</a>
                                    @endif
                                </div>
                            @endif
                            @if ($item->tte_visum_umum_created_user_id)
                                <div class="col-md-5 col-sm-5 mb-2">
                                    <b>Download File Visum Umum</b>
                                    <br>
                                    @if ($item->tte_visum_umum_created)
                                        <a class="btn btn-success btn-sm"
                                            href="{{ route('documents.tte.visum-umum.download', ['uuid' => $item->uuid]) }}" title="Download Visum Umum {{ $item->no_surat }}">Download</a>
                                    @else
                                        <a href="javascript:void(0)"
                                            class="btn btn-secondary disable text-white btn-sm">Tidak
                                            Tersedia</a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @endif
                    <hr>
                    @if ($item->tte_created_user_id)
                        <div class="row mb-3 mt-3">
                            <div class="col-md-5 col-lg-5 mb-2">
                                <b>Pembuat TTE</b>
                                <br>
                                <span>{{ $item->tte_created_user->name ?? '-' }}</span>
                            </div>
                            <div class="col-md-7 col-lg-7 mb-2">
                                <b>Tanggal TTE</b>
                                <br>
                                <span>{{ $item->tte_created->translatedFormat('H:i:s d-m-Y') ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12 col-lg-12 mb-2">
                                <b>Download Surat Tugas {{ $item->no_surat }}</b>
                                <br>
                                <a href="{{ route('documents.tte-download', [
                                    'uuid' => $item->uuid,
                                ]) }}" title="Download Surat Tugas {{ $item->no_surat }}"
                                    class="btn btn-success btn-sm">Download</a>
                            </div>
                        </div>
                    @endif
                    @if ($item->tte_created == null)
                        <form
                            action="{{ route('documents.tte.create', [
                                'uuid' => $item->uuid,
                            ]) }}"
                            method="post">
                            @csrf
                            <div class='form-group mb-3'>
                                <label for='pembuat_tte' class='mb-2'>Pembuat TTE</label>
                                <input type='text' class='form-control @error('pembuat_tte') is-invalid @enderror'
                                    value='{{ auth()->user()->name }}' readonly>
                                @error('pembuat_tte')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class='form-group mb-3'>
                                <label for='tanggal_dibuar' class='mb-2'>Tanggal Dibuat</label>
                                <input type='text' class='form-control @error('tanggal_dibuar') is-invalid @enderror'
                                    value='{{ Carbon\Carbon::now()->translatedFormat('H:i:s d-m-Y') }}' readonly>
                                @error('tanggal_dibuar')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group mb-3'>
                                <label for='tte_pin' class='mb-2'>PIN TTE</label>
                                <input type='password' name='tte_pin'
                                    class='form-control @error('tte_pin') is-invalid @enderror'
                                    value='{{ old('tte_pin') }}'>
                                @error('tte_pin')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group float-right">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    @endif
                </div>
                <div id="pdfContainer"></div>
                <div class="card-footer">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <button onclick="window.history.back()"
                                class="btn btn-md text-white btn-warning mb-3">Kembali</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
@endpush
<x-Admin.Sweetalert />
