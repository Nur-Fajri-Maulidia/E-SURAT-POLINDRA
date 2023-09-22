<div class="d-cat-pengumuman col-md-12">
    <div class='form-group mb-3'>
        <label for='body' class='mb-2'>Isi Pengumuman</label>
        <textarea id='s-pengumuman' cols='30' rows='3'
            class='ckeditor s-pengumuman form-control @error('body') is-invalid @enderror'>{{ old('body') }}
         <tbody>
            <tr>
                <div style="text-align: center"><strong>PENGUMUMAN</strong></div>
                <div style="text-align: center">Nomor : ............</div>
                <td > Isi Pengumuman.................................. </td>
            </tr>
         </tbody>
    </textarea>
    </div>
</div>