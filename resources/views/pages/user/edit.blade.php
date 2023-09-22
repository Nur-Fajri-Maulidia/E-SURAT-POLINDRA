@extends('layouts.app')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('users.update', $user->id) }}" method="post" class="d-inline"
                    enctype="multipart/form-data">
                    <div class="card-body row">
                        <div class="col-12">
                            <h4 class="card-title mb-5">Edit User</h4>
                        </div>
                        @csrf
                        @method('patch')
                        <div class="col-md-6">
                            <div class='form-group mb-3'>
                                <label for='name' class='mb-2'>Name</label>
                                <input type='text' name='name'
                                    class='form-control @error('name') is-invalid @enderror'
                                    value='{{ $user->name ?? old('name') }}'>
                                @error('name')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group mb-3'>
                                <label for='username' class='mb-2'>Username</label>
                                <input type='text' name='username'
                                    class='form-control @error('username') is-invalid @enderror'
                                    value='{{ $user->username ?? old('username') }}'>
                                @error('username')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group mb-3'>
                                <label for='email' class='mb-2'>Email</label>
                                <input type='text' name='email'
                                    class='form-control @error('email') is-invalid @enderror'
                                    value='{{ $user->email ?? old('email') }}'>
                                @error('email')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group mb-3'>
                                <label for='password' class='mb-2'>Password (<span class="text-danger small">Kosongkan
                                        jika tidak
                                        ingin merubah password</span> )</label>
                                <input type='password' name='password'
                                    class='form-control @error('password') is-invalid @enderror'
                                    value='{{ old('password') }}'>
                                @error('password')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group mb-3'>
                                <label for='tte_pin' class='mb-2'>PIN TTE (<span class="text-danger small">Kosongkan
                                        jika tidak
                                        ingin merubah PIN TTE</span> )</label>
                                <input type='password' name='tte_pin'
                                    class='form-control @error('tte_pin') is-invalid @enderror'
                                    value='{{ old('tte_pin') }}'>
                                @error('tte_pin')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group mb-3'>
                                <label for='nip' class='mb-2'>NIP</label>
                                <input type='text' name='nip' class='form-control @error('nip') is-invalid @enderror'
                                    value='{{ $user->nip ?? old('nip') }}'>
                                @error('nip')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group mb-3'>
                                <label class='mb-2' for='jenis_kelamin'>Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                    <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                    <option @selected($user->jenis_kelamin == 'laki-laki') value="laki-laki">Laki-laki</option>
                                    <option @selected($user->jenis_kelamin == 'perempuan')value="perempuan">Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class='invalid-feedback d-inline'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group mb-3'>
                                <div class="row">
                                    <div class="col-12">
                                        <label for='foto' class='mb-2'>Foto</label>
                                    </div>
                                    <div class="col-md-2">

                                        <img src="{{ $user->avatar() }}" class="img-fluid" alt=""
                                            style="max-height:80px">
                                    </div>
                                    <div class="col-md align-self-center">
                                        <input type='file' name='foto'
                                            class='form-control @error('foto') is-invalid @enderror'
                                            value='{{ old('foto') }}'>
                                        @error('foto')
                                            <div class='invalid-feedback'>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class='form-group mb-3'>
                                <label class='mb-2' for='pns'>PNS</label>
                                <select name="pns" id="pns" class="form-control">
                                    <option value="" selected disabled>Pilih</option>
                                    <option @selected($user->pns == 1) value="1">Ya</option>
                                    <option @selected($user->pns == 0)value="0">Tidak</option>
                                </select>
                                @error('pns')
                                    <div class='invalid-feedback d-inline'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group mb-3'>
                                <label class='mb-2' for='status'>Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="" selected disabled>Pilih Status</option>
                                    <option @selected($user->status == 1) value="1">Aktif</option>
                                    <option @selected($user->status == 0)value="0">Tidak Aktif</option>
                                </select>
                                @error('status')
                                    <div class='invalid-feedback d-inline'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group mb-3'>
                                <label for='alamat' class='mb-2'>Alamat</label>
                                <textarea name='alamat' id='alamat' cols='30' rows='8'
                                    class='form-control @error('alamat') is-invalid @enderror'>{{ $user->alamat ?? old('alamat') }}</textarea>
                                @error('alamat')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group mb-3'>
                                <label class='mb-2' for='unit_kerja_id'>Unit Kerja</label>
                                <select name="unit_kerja_id" id="unit_kerja_id" class="form-control">
                                    <option value="" selected disabled>Pilih Unit Kerja</option>
                                    @foreach ($unit_kerjas as $unit_kerja)
                                        <option @selected($unit_kerja->id == $user->unit_kerja_id) value="{{ $unit_kerja->id }}">
                                            {{ $unit_kerja->name }}</option>
                                    @endforeach
                                </select>
                                @error('unit_kerja_id')
                                    <div class='invalid-feedback d-inline'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group mb-3'>
                                <label for='role' class='mb-2'>Role</label>
                                <select name="role" id="role" class="form-control">

                                </select>
                                @error('role')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group mb-3'>
                                <label class='mb-2' for='jabatan_id'>Jabatan</label>
                                <select name="jabatan_id" id="jabatan_id" class="form-control">
                                    <option value="" selected disabled>Pilih Jabatan</option>
                                </select>
                                @error('jabatan_id')
                                    <div class='invalid-feedback d-inline'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group mb-3'>
                                <label class='mb-2' for='pangkat_id'>Pangkat</label>
                                <select name="pangkat_id" id="pangkat_id" class="form-control">
                                    <option value="" selected disabled>Pilih Pangkat</option>
                                </select>
                                @error('pangkat_id')
                                    <div class='invalid-feedback d-inline'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
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
@endsection
<x-Admin.Sweetalert />
@push('scripts')
    @include('pages.user.js-edit')
@endpush
