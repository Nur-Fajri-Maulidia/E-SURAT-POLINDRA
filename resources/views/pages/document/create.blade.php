@extends('layouts.app')
@section('title')
    Kirim Surat
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Kirim Surat</h3>
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
                            <form action="{{ route('documents.store') }}" method="post" class="d-inline"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <h4><u><b>Form Surat</b></u></h4>
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
                                    @include('pages.document.form.surat')
                                    @include('pages.document.form.surat.tugas')
                                    @include('pages.document.form.surat.keterangan')
                                    @include('pages.document.form.surat.pernyataan')
                                    @include('pages.document.form.surat.undangan')
                                    @include('pages.document.form.surat.pengumuman')
                                    @include('pages.document.form.surat.edaran')
                                    @include('pages.document.form.surat.umum')
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
