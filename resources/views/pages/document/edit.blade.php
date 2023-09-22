@extends('layouts.app')
@section('title')
    Edit Surat Nomor {{ $item->no_surat }}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Edit Surat Nomor {{ $item->no_surat }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="row">
                <div class="col-md-12 mb-4 stretch-card transparent">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('documents.update', ['uuid' => $item->uuid]) }}" method="post"
                                class="d-inline" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <h5><u><b>Form Surat</b></u></h5>
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                    @include('pages.document.form-edit.surat')
                                    @if ($item->category->name == 'Surat Tugas')
                                        @include('pages.document.form-edit.surat.tugas')
                                    @elseif ($item->category->name == 'Surat Keterangan')
                                        @include('pages.document.form-edit.surat.keterangan')
                                    @elseif ($item->category->name == 'Surat Pernyataan')
                                        @include('pages.document.form-edit.surat.pernyataan')
                                    @elseif ($item->category->name == 'Surat Undangan')
                                        @include('pages.document.form-edit.surat.undangan')
                                    @elseif ($item->category->name == 'Surat Pengumuman')
                                        @include('pages.document.form-edit.surat.pengumuman')
                                    @elseif ($item->category->name == 'Surat Edaran')
                                        @include('pages.document.form-edit.surat.edaran')
                                    @elseif ($item->category->name == 'Surat Umum')
                                        @include('pages.document.form-edit.surat.umum')
                                    @endif
                                    <div class="col-12 mt-3">
                                        <div class="form-group d-flex justify-content-between">
                                            <a href="{{ route('users.index') }}" class="btn btn-warning">Kembali</a>
                                            <button class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
    @include('pages.document.js.surat')
    @include('pages.document.js.get-user')
    @include('pages.document.js.tugas')
@endpush
<x-Admin.Sweetalert />
