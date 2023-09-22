<div class="d-cat-undangan col-md-12 d-none">
    <div class='form-group mb-3'>
        <label for='body' class='mb-2'>Isi Surat Undangan</label>
        <textarea id='s-undangan' cols='30' rows='3'
            class='ckeditor s-undangan form-control @error('body') is-invalid @enderror'>{{ old('body') }}
         <tbody>
            <table cellspacing="3" class="border-none" style="width:100%">
                <tbody>
                  <tr>
                    <td>Nomor : .....</td>
                    <td>Tgl, Bln, Thn<td>
                  </tr>
                </tbody>
            </table>
                <td >Perihal : .....</td> <br>
                <td >Kepada : 1. ... dst </td> <br>
                <table cellspacing="3" class="border-none" style="width:100%">
                    <tbody>
                    <td>Kalimat Pembuka ..............., Pada :</td>
                      <tr>
                        <td>hari, tanggal</td>
                        <td>: .................................................<td>
                      </tr>
                      <tr>
                        <td>pukul</td>
                        <td>: ................................................</td>
                      </tr>
                      <tr>
                        <td>tempat</td>
                        <td>: ................................................</td>
                      </tr>
                      <tr>
                        <td>acara</td>
                        <td>: ................................................</td>
                      </tr>
                    </tbody>
                </table>
                <td >Kalimat penutup ............ </td> <br>
                <td >Atas perhatian dan kehadirannya Kami ucapkan terima kasih.</td>
         </tbody>
    </textarea>
    </div>
</div>
