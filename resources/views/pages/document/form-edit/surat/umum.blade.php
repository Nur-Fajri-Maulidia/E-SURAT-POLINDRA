<div class="d-cat-umum col-md-12">
    <div class='form-group mb-3'>
        <label for='body' class='mb-2'>Isi Surat Umum</label>
        <textarea id='s-umum' cols='30' rows='3'
            class='ckeditor s-umum form-control @error('body') is-invalid @enderror'>{{ old('body') }}
                </textarea>
    </div>
</div>