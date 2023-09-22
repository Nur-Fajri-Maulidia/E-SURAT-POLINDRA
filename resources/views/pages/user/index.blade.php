@extends('layouts.app')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <style>
        #dTable_wrapper {
            position: relative;
        }

        #filterForm {
            position: absolute;
            top: 0;
            right: 0;
            padding: 10px;
            z-index: 1000;
        }
    </style>
    {{-- <div class="row mb-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">Filter</h4>
                    <div id="dTable_wrapper">
                        <form id="filterForm" action="javascript:void(0)" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="role_select">Pilih Role</label>
                                        <select name="role_select" id="role_select" class="form-control">

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="unit_kerja_select">Pilih Unit Kerja</label>
                                        <select name="unit_kerja_select" id="unit_kerja_select" class="form-control">

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md align-self-center">
                                    <button class="btn btn-secondary text-white py-3 px-4  btnFilter"><i
                                            class="fas fa-filter"></i>
                                        Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <span class="card-title mb-3">Data User</span>
                    @can('User Create')
                        <a href="{{ route('users.create') }}" class="float-right text-white btn btn-md py-2 btn-primary btn-outline-success btnAdd">Tambah
                            User</a>
                    @endcan
                    <hr>
                    <div class="table-responsive">
                        <div id="dTable_wrapper">
                            <div class="row">
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-8 float-right">
                                    <form class="pull-right mb-5" id="filterForm" action="javascript:void(0)"
                                        method="post">
                                        @csrf
                                        <div class="row float-right pull-right">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="role_select">Pilih Role</label>
                                                    <select name="role_select" id="role_select" class="form-control">

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="unit_kerja_select">Pilih Unit Kerja</label>
                                                    <select name="unit_kerja_select" id="unit_kerja_select"
                                                        class="form-control">

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2 align-self-center align-right float-right pull-right">
                                                <button class="btn btn-secondary text-white py-3 px-4  btnFilter"><i
                                                        class="fas fa-filter"></i>
                                                    Filter</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <br><br>
                            <table class="table dtTable table-hover" id="dTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>NIP</th>
                                        <th>Unit Kerja</th>
                                        <th>Jabatan</th>
                                        <th>Pangkat</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<x-Admin.Sweetalert />
<x-Admin.Datatable>
    @slot('script')
        @include('pages.user.js-index')
    @endslot
</x-Admin.Datatable>
