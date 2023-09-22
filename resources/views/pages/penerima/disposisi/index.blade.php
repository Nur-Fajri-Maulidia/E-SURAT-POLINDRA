@extends('layouts.app')
@section('title')
    Disposisi
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">Disposisi Masuk</h4>
                    <div class="table-responsive">
                        <table class="table dtTable table-hover" id="disposisi-masuk">
                            <thead>
                                <tr>
                                    <td class="text-center">No</td>
                                    <td>Sifat Surat</td>
                                    <td>Intruksi</td>
                                    <td class="text-center">Action</td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    @include('pages.penerima.disposisi.view')
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @include('pages.penerima.disposisi.dataTable')
@endpush
