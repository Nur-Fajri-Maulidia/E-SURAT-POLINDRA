@extends('layouts.app')
@section('title')
    Disposisi Surat {{ $letter->no_surat }}
@endsection
@section('content')
    <div class="row mb-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        {{ $title }}
                    </h4>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-md-3 col-lg-3 mb-2">
                            <b>Hal</b>
                            <br>
                            <span>{{ $letter->hal }}</span>
                        </div>
                        <div class="col-md-3 col-lg-3 mb-2">
                            <b>Asal</b>
                            <br>
                            <span>{{ $letter->from->name }}</span>
                        </div>
                        <div class="col-md-3 col-lg-3 mb-2">
                            <b>Kepada</b>
                            <br>
                            @php
                                $kepada = $letter->unit_kerja->name ?? ($letter->user_id ? $letter->user_id->name : null);
                            @endphp
                            <span>{{ $kepada }}</span>
                        </div>
                        <div class="col-md-3 col-lg-3 mb-2">
                            <b>Tanggal</b>
                            <br>
                            <span>{{ $letter->created_at->translatedFormat('d-m-Y') }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6 mb-2">
                            <b>Deskripsi</b>
                            <br>
                            <span>{{ $letter->deskripsi }}</span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-2">
                            <b>Keterangan</b>
                            <br>
                            <span>{{ $letter->keterangan }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Disposisi</h4>
                    <form action="{{ route('documents.disposisi.update', $letter->uuid) }}" method="post">
                        @csrf
                        <div class='form-group mb-3'>
                            <label for='sifat_surat' class='mb-2'>Sifat Surat</label>
                            <select name="sifat_surat" id="sifat_surat" class="form-control">
                                <option value="" selected>Pilih Sifat</option>
                                <option
                                    @if ($letter->disposisi) @selected($letter->disposisi->sifat_surat === 'Penting') @else @selected(old('sifat_surat') === 'Penting') @endif
                                    value="Penting">Penting</option>
                                <option
                                    @if ($letter->disposisi) @selected($letter->disposisi->sifat_surat === 'Rahasia') @else @selected(old('sifat_surat') === 'Rahasia') @endif
                                    value="Rahasia">Rahasia</option>
                                <option
                                    @if ($letter->disposisi) @selected($letter->disposisi->sifat_surat === 'Biasa') @else @selected(old('sifat_surat') === 'Biasa') @endif
                                    value="Biasa">Biasa</option>
                            </select>
                            @error('sifat_surat')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group mb-3'>
                            <label for='intruksi' class='mb-2'>Intruksi</label>
                            <select name="intruksi" id="intruksi" class="form-control">
                                <option value="" selected>Pilih Intruksi</option>
                                @foreach ($intruksi as $intr)
                                    <option
                                        @if ($letter->disposisi) @selected($intr === $letter->disposisi->intruksi) @else @selected($intr === request('intruksi')) @endif
                                        value="{{ $intr }}">{{ $intr }}</option>
                                @endforeach
                            </select>
                            @error('intruksi')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary float-right">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <h4 class="card-title">Penerima</h4>
                        @if ($letter->disposisi)
                            <a href="javascript:void(0)" class="btn btnAdd btn-primary btn-sm">Tambah</a>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <table class="table dtTable table-hover" id="dTable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Penerima</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($letter->disposisi)
                                    @foreach ($letter->disposisi->penerima as $penerima)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $penerima->user->name }}</td>
                                            <td>
                                                <a href="javascript:void(0)" class="btn btnEdit py-2 btn-sm btn-info"
                                                    data-userid="{{ $penerima->user_id }}"
                                                    data-id="{{ $penerima->id }}">Edit</a>
                                                <form action="javascript:void(0)" method="post" class="d-inline"
                                                    id="formDelete">
                                                    @csrf
                                                    <button
                                                        data-route="{{ route('documents.disposisi.user.destroy', $penerima->id) }}"
                                                        class="btn btnDelete
                                                        btn-sm btn-danger py-2">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="javascript:void(0)" method="post" id="myForm">
                    <div class="modal-body">
                        @csrf
                        @if ($letter->disposisi)
                            <input type="hidden" name="document_disposisi_id" value="{{ $letter->disposisi->id }}">
                        @endif
                        <div class="form-group">
                            <label for="user_id">User</span></label>
                            <select name="user_id" id="user_id" class="form-control">

                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
<x-Admin.Sweetalert />
<x-Admin.Datatable>
    @slot('script')
        <script>
            $(function() {
                let otable = $('#dTable').DataTable();

                // btn create
                $('.btnAdd').on('click', function() {
                    let data_users = getUsers();
                    // looping unit kerja
                    $('#myModal #user_id').empty();
                    $('#myModal #user_id').append(
                        `<option value="">Pilih User</option>`
                    );

                    data_users.forEach(user => {
                        $('#myModal #user_id').append(
                            `<option value="${user.id}">${user.name}</option>`);
                    });
                    $('#myModal .modal-title').text('Tambah Data');
                    $('#myModal').modal('show');
                })

                // btn submit
                $('#myModal #myForm').on('submit', function(e) {
                    e.preventDefault();
                    let form = $('#myModal #myForm');
                    $.ajax({
                        url: '{{ route('documents.disposisi.user.store') }}',
                        type: 'POST',
                        dataType: 'JSON',
                        data: form.serialize(),
                        success: function(response) {
                            swal(response);
                            setInterval(() => {
                                location.reload();
                            }, 1000);
                            $('#myModal').modal('hide');
                        },
                        error: function(response) {
                            let errors = response.responseJSON?.errors
                            $(form).find('.text-danger.text-small').remove()
                            if (errors) {
                                for (const [key, value] of Object.entries(errors)) {
                                    $(`[name='${key}']`).parent().append(
                                        `<sp class="text-danger text-small">${value}</sp>`)
                                    $(`[name='${key}']`).addClass('is-invalid')
                                }
                            }
                        }
                    })
                })

                // edit
                $('body').on('click', '.btnEdit', function() {
                    let id = $(this).data('id');
                    let userid = $(this).data('userid');

                    $('#myForm #id').val(id);

                    // looping unit kerja
                    let data_user = getUsers();
                    $('#myModal #user_id').empty();
                    $('#myModal #user_id').append(
                        `<option value="">Pilih User</option>`
                    );
                    data_user.forEach(user => {
                        let isSelected = user.id == userid ? 'selected' : '';
                        $('#myModal #user_id').append(
                            `<option ${isSelected} value="${user.id}">${user.name}</option>`
                        );
                    });
                    $('#myModal .modal-title').text('Edit Data');
                    $('#myModal').modal('show');
                })

                // hapus
                $('body').on('click', '.btnDelete', function(e) {
                    e.preventDefault();
                    let id = $(this).data('id');
                    let route = $(this).data('route');
                    Swal.fire({
                        title: 'Apakah Yakin?',
                        text: `Data yang dihapus tidak bisa dikembalikan!`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yakin'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: route,
                                type: 'DELETE',
                                dataType: 'JSON',
                                success: function(response) {
                                    swal(response);
                                    setInterval(() => {
                                        location.reload();
                                    }, 1000);
                                    $('#myModal').modal('hide');

                                },
                                error: function(response) {
                                    swal(response);
                                }
                            })
                        }
                    })
                })

                // get users
                let getUsers = function() {
                    let data;
                    $.ajax({
                        url: '{{ route('users.get') }}',
                        type: 'JSON',
                        method: 'GET',
                        async: false,
                        success: function(response) {
                            data = response;
                        }
                    })

                    return data;
                }

                $('#myModal').on('hidden.bs.modal', function() {
                    let form = $('#myModal #myForm');
                    form.trigger('reset');
                })

                function swal(response) {
                    Swal.fire({
                        position: 'center',
                        icon: response.status,
                        title: response.message,
                        showConfirmButton: true,
                        timer: 1500
                    })
                }
            })
        </script>
    @endslot
</x-Admin.Datatable>





{{-- @extends('layouts.app')
@section('content')
    <div class="row mb-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Detail Surat</h4>
                    <ul class="list-unstyled">
                        <li class="col-md-4 col-lg-4 mb-2">
                            <b>NO. Surat</b>
                            <br>
                            <span>{{ $document->no_surat }}</span>
                        </li>
                        <li class="list-item mb-2">
                            <b>Kode Hal</b>
                            <br>
                            <span>{{ $document->kode_hal }}</span>
                        </li>


                        <li class="list-item mb-2">
                            <b>Deskripsi</b>
                            <br>
                            <span>{{ $document->deskripsi }}</span>
                        </li>
                        <li class="list-item mb-2">
                            <b>Keterangan</b>
                            <br>
                            <span>{{ $document->keterangan }}</span>
                        </li>

                        <li class="list-item mb-2">
                            <b>Tanggal Submit</b>
                            <br>
                            <span>{{ $document->created_at->translatedFormat('d-m-Y') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Disposisi</h4>
                    <form action="{{ route('documents.disposisi.update', $document->uuid) }}" method="post">
                        @csrf
                        <div class='form-group mb-3'>
                            <label for='sifat_surat' class='mb-2'>Sifat Surat</label>
                            <select name="sifat_surat" id="sifat_surat" class="form-control">
                                <option value="" selected>Pilih Sifat</option>
                                <option
                                    @if ($document->disposisi) @selected($document->disposisi->sifat_surat === 'Penting') @else @selected(old('sifat_surat') === 'Penting') @endif
                                    value="Penting">Penting</option>
                                <option
                                    @if ($document->disposisi) @selected($document->disposisi->sifat_surat === 'Rahasia') @else @selected(old('sifat_surat') === 'Rahasia') @endif
                                    value="Rahasia">Rahasia</option>
                                <option
                                    @if ($document->disposisi) @selected($document->disposisi->sifat_surat === 'Biasa') @else @selected(old('sifat_surat') === 'Biasa') @endif
                                    value="Biasa">Biasa</option>
                            </select>
                            @error('sifat_surat')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group mb-3'>
                            <label for='intruksi' class='mb-2'>Intruksi</label>
                            <select name="intruksi" id="intruksi" class="form-control">
                                <option value="" selected>Pilih Intruksi</option>
                                @foreach ($intruksi as $intr)
                                    <option
                                        @if ($document->disposisi) @selected($intr === $document->disposisi->intruksi) @else @selected($intr === request('intruksi')) @endif
                                        value="{{ $intr }}">{{ $intr }}</option>
                                @endforeach
                            </select>
                            @error('intruksi')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary float-right">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <h4 class="card-title">Penerima</h4>
                        @if ($document->disposisi)
                            <a href="javascript:void(0)" class="btn btnAdd btn-primary btn-sm">Tambah</a>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <table class="table dtTable table-hover" id="dTable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Penerima</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($document->disposisi)
                                    @foreach ($document->disposisi->units as $unit)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $unit->unit->name }}</td>
                                            <td>
                                                <a href="javascript:void(0)" class="btn btnEdit py-2 btn-sm btn-info"
                                                    data-userid="{{ $unit->unit_kerja_id }}"
                                                    data-id="{{ $unit->id }}">Edit</a>
                                                <form action="javascript:void(0)" method="post" class="d-inline"
                                                    id="formDelete">
                                                    @csrf
                                                    <button
                                                        data-route="{{ route('documents.disposisi.unit.destroy', $unit->id) }}"
                                                        class="btn btnDelete
                                                        btn-sm btn-danger py-2">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="javascript:void(0)" method="post" id="myForm">
                    <div class="modal-body">
                        @csrf
                        <input type="number" id="id" name="id" hidden>
                        @if ($document->disposisi)
                            <input type="text" name="document_disposisi_id" value="{{ $document->disposisi->id }}"
                                hidden>
                        @endif
                        <div class="form-group">
                            <label for="unit_kerja_id">Unit Kerja</span></label>
                            <select name="unit_kerja_id" id="unit_kerja_id" class="form-control">

                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
<x-Admin.Sweetalert />
<x-Admin.Datatable>
    @slot('script')
        <script>
            $(function() {
                let otable = $('#dTable').DataTable();

                // btn create
                $('.btnAdd').on('click', function() {
                    let data_unit_kerja = getUnitKerjas();
                    // looping unit kerja
                    $('#myModal #unit_kerja_id').empty();
                    $('#myModal #unit_kerja_id').append(
                        `<option value="">Pilih Personal</option>`
                    );

                    data_unit_kerja.forEach(unit_kerja => {
                        $('#myModal #unit_kerja_id').append(
                            `<option value="${unit_kerja.id}">${unit_kerja.name}</option>`);
                    });
                    $('#myModal .modal-title').text('Tambah Data');
                    $('#myModal').modal('show');
                })

                // btn submit
                $('#myModal #myForm').on('submit', function(e) {
                    e.preventDefault();
                    let form = $('#myModal #myForm');
                    $.ajax({
                        url: '{{ route('documents.disposisi.unit.store') }}',
                        type: 'POST',
                        dataType: 'JSON',
                        data: form.serialize(),
                        success: function(response) {
                            swal(response);
                            setInterval(() => {
                                location.reload();
                            }, 1000);
                            $('#myModal').modal('hide');
                        },
                        error: function(response) {
                            let errors = response.responseJSON?.errors
                            $(form).find('.text-danger.text-small').remove()
                            if (errors) {
                                for (const [key, value] of Object.entries(errors)) {
                                    $(`[name='${key}']`).parent().append(
                                        `<sp class="text-danger text-small">${value}</sp>`)
                                    $(`[name='${key}']`).addClass('is-invalid')
                                }
                            }
                        }
                    })
                })

                // edit
                $('body').on('click', '.btnEdit', function() {
                    let id = $(this).data('id');
                    let userid = $(this).data('userid');

                    $('#myForm #id').val(id);

                    // looping unit kerja
                    let data_user = getUnitKerjas();
                    $('#myModal #unit_kerja_id').empty();
                    $('#myModal #unit_kerja_id').append(
                        `<option value="">Pilih User</option>`
                    );
                    data_user.forEach(user => {
                        let isSelected = user.id == userid ? 'selected' : '';
                        $('#myModal #unit_kerja_id').append(
                            `<option ${isSelected} value="${user.id}">${user.name}</option>`
                        );
                    });
                    $('#myModal .modal-title').text('Edit Data');
                    $('#myModal').modal('show');
                })

                // hapus
                $('body').on('click', '.btnDelete', function(e) {
                    e.preventDefault();
                    let id = $(this).data('id');
                    let route = $(this).data('route');
                    Swal.fire({
                        title: 'Apakah Yakin?',
                        text: `Data yang dihapus tidak bisa dikembalikan!`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yakin'
                    }).then((result) => {
                        if (result.isConfirmed) {

                            $.ajax({
                                url: route,
                                type: 'DELETE',
                                dataType: 'JSON',
                                success: function(response) {
                                    swal(response);
                                    setInterval(() => {
                                        location.reload();
                                    }, 1000);
                                    $('#myModal').modal('hide');

                                },
                                error: function(response) {
                                    swal(response);
                                }
                            })
                        }
                    })
                })

                // get users
                let getUnitKerjas = function() {
                    let data;
                    $.ajax({
                        url: '{{ route('users.get') }}',
                        type: 'JSON',
                        method: 'GET',
                        async: false,
                        success: function(response) {
                            data = response;
                        }
                    })

                    return data;
                }

                $('#myModal').on('hidden.bs.modal', function() {
                    let form = $('#myModal #myForm');
                    form.trigger('reset');
                })

                function swal(response) {
                    Swal.fire({
                        position: 'center',
                        icon: response.status,
                        title: response.message,
                        showConfirmButton: true,
                        timer: 1500
                    })
                }
            })
        </script>
    @endslot
</x-Admin.Datatable> --}}
