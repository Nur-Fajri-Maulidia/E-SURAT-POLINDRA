<div class="d-cat-keterangan col-md-12">
    <div class='form-group mb-3'>
        <label for='body' class='mb-2'>Isi Surat Keterangan</label>
        <textarea id='s-keteranga' cols='30' rows='3'
            class='ckeditor s-keterangan form-control @error('body') is-invalid @enderror'>{{ old('body') }}
    <tbody>
            <tr>
                <div style="text-align: center"><strong>SURAT KETERANGAN</strong></div>
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
                        <td>jabatan</td>
                        <td>: ................................................</td>
                      </tr>
                </table>
                <td >dengan ini menerangkan bahwa, </td>
                <table cellspacing="3" class="border-none" style="width:100%">
                    <tbody>
                      <tr>
                        <td>nama</td>
                        <td>: ................................................</td>
                      </tr>
                      <tr>
                        <td>NPM</td>
                        <td>: ................................................</td>
                      </tr>
                      <tr>
                        <td>tempat/tanggal lahir</td>
                        <td>: ................................................</td>
                      </tr>
                      <tr>
                        <td>nama orang tua</td>
                        <td>: ................................................</td>
                      </tr>
                      <tr>
                        <td>pekerjaan</td>
                        <td>: ................................................</td>
                      </tr>
                      <tr>
                        <td>alamat</td>
                        <td>: ................................................</td>
                      </tr>
                </table>
                <td >Isi Keterangan ..... </td> <br>
                <td >Demikian atas bantuan yang terkait kami ucapakan terima kasih.</td>
            </tr>
    </tbody>
    </textarea>
    </div>
</div>
