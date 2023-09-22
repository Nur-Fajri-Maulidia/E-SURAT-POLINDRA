<div class="d-cat-pernyataan col-md-12">
    <div class='form-group mb-3'>
        <label for='body' class='mb-2'>Isi Surat Pernyataan</label>
        <textarea id='s-pernyataan' cols='30' rows='3'
            class='ckeditor s-pernyataan form-control @error('body') is-invalid @enderror'>{{ old('body') }}
         <tbody>
            <tr>
                <div style="text-align: center"><strong>SURAT PERNYATAAN</strong></div>
                <div style="text-align: center">Nomor : ............</div>
                <td >Yang bertanda tangan dibawah ini, </td>
                <table cellspacing="3" class="border-none" style="width:100%">
                    <tbody>
                      <tr>
                        <td>nama</td>
                        <td>: ................................................</td>
                      </tr>
                      <tr>
                        <td>NIP</td>
                        <td>: ................................................</td>
                      </tr>
                      <tr>
                        <td>pangkat/golongan</td>
                        <td>: ................................................</td>
                      </tr>
                      <tr>
                        <td>jabatan</td>
                        <td>: ................................................</td>
                      </tr>
                      <tr>
                        <td>alamat</td>
                        <td>: ................................................</td>
                      </tr>
                </table>
                <td >Isi Pernyataan ..... </td> <br>
                <td >Surat pernyataan ini dibuat untuk dipergunakan sebagaimana mestinya.</td>
            </tr>
         </tbody>
    </textarea>
    </div>
</div>