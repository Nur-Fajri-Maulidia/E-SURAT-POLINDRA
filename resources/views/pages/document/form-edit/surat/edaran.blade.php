<div class="d-cat-edaran col-md-12">
    <div class='form-group mb-3'>
        <label for='body' class='mb-2'>Isi Edaran</label>
        <textarea id='s-edaran' cols='30' rows='3'
            class='ckeditor s-edaran form-control @error('body') is-invalid @enderror'>{{ old('body') }}
            <tbody>
                <tr>
                <div style="text-align: center"><strong>SURAT EDARAN</strong></div>
                <div style="text-align: center"><strong>NOMOR...TAHUN 20..</strong></div> <br>
                <div style="text-align: center">TENTANG</div>
                <div style="text-align: center">.....................</div>
                    <tr>
                        <td>Yth.</td> <br>
                        <td>1.<td> <br>
                        <td>2.<td> <br>
                        <td>3.<td> <br>
                    </tr> <br>
                        <td >Dasar Hukum ............... </td> <br><br>
                        <td >Isi Surat .................</td> <br> <br>
                        <td >Demikian agar diketahui dan dilaksanakan dengan sebaik baiknya</td>

                    </tr>
            <tbody>
        </textarea>
    </div>
</div>
