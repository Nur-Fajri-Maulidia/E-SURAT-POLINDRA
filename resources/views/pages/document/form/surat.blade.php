<div class="col-md-6">
    <div class='form-group mb-3'>
        <label class='mb-2' for='kepada_id'>Pilih Tujuan surat<sup class="text-danger">*</sup></label>
        <select id="kepada_id" class="form-control">
            <option value="" selected disabled>Pilih Tujuan</option>
            <option value="unit">Unit Kerja</option>
            <option value="personal">Personal</option>
        </select>
        @error('kepada_id')
            <div class='invalid-feedback d-inline'>
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class='form-group mb-3 unit-kerja d-none'>
        <label class='mb-2' for='to_unit_kerja_id'>Unit Kerja<sup class="text-danger">*</sup></label>
        <select id="to_unit_kerja_id" class="form-control kepada-uu unit-kerja-id">
            <option value="" selected disabled>Pilih Unit Kerja</option>
            @foreach ($unit_kerjas as $unit_kerja)
                <option value="{{ $unit_kerja->id }}">{{ $unit_kerja->name }}</option>
            @endforeach
        </select>
        @error('to_unit_kerja_id')
            <div class='invalid-feedback d-inline'>
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class='form-group mb-3 personal d-none'>
        <label class='mb-2' for='get-user'>Personal<sup class="text-danger">*</sup></label>
        <select name="to_user_id" id="get-user" class="form-control kepada-uu personal-id"></select>
        @error('get-user')
            <div class='invalid-feedback d-inline'>
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class='form-group mb-3'>
        <label class='mb-2' for='category_id'>Kategori Surat<sup class="text-danger">*</sup></label>
        <select name="category_id" id="category_id" class="form-control">
        </select>
        @error('category_id')
            <div class='invalid-feedback d-inline'>
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class='form-group mb-3'>
        <label class='mb-2' for='to_tembusan_user_id'>Tembusan</label>
        <select name="to_tembusan_user_id" id="get-tembusan" class="form-control"></select>
        @error('get-tembusan')
            <div class='invalid-feedback d-inline'>
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class='form-group mb-3'>
        <label for='hal' class='mb-2'>Hal<sup class="text-danger">*</sup></label>
        <textarea placeholder="Hal" name='hal' id='hal' cols='30' rows='5'
            class='form-control @error('hal') is-invalid @enderror'>{{ old('hal') }}</textarea>
        @error('hal')
            <div class='invalid-feedback'>
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
<div class="col-md-6">
    <div class='form-group mb-3'>
        <label for='keterangan' class='mb-2'>Keterangan<sup class="text-danger">*</sup></label>
        <textarea placeholder="Keterangan" name='keterangan' id='keterangan' cols='30' rows='5'
            class='form-control @error('keterangan') is-invalid @enderror'>{{ old('keterangan') }}</textarea>
        @error('keterangan')
            <div class='invalid-feedback'>
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class='form-group mb-2'>
        <label for='deskripsi' class='mb-2'>Isi/Ringkasan<sup class="text-danger">*</sup></label>
        <textarea placeholder="Ringkasan" name='deskripsi' id='deskripsi' cols='30' rows='8'
            class='form-control @error('deskripsi') is-invalid @enderror'>{{ old('deskripsi') }}</textarea>
        @error('deskripsi')
            <div class='invalid-feedback'>
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class='form-group mb-3'>
        <label for='lampiran' class='mb-2'>Lampiran</label>
        <input type='file' name='lampiran[]' class='form-control @error('lampiran') is-invalid @enderror' multiple>
        @error('lampiran.*')
            <div class='invalid-feedback d-inline'>
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
<hr>
