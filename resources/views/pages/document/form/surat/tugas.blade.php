<div class="d-cat-tugas col-md-12 mt-5 mb-3 d-none">
    <h4><u><b>Form Surat Tugas</b></u></h4>
    <div class="row">
        <div class="d-cat-tugas col-md-12">
            <div class="row">
                <div class="col-md-4 form-group mb-3">
                    <label for="body" class="mb-2">Pembuka<sup class="text-danger">*</sup></label>
                    <textarea name="pembuka" placeholder="Input Kalimat Pembuka Surat.." rows="10"
                        class="s-tugas form-control @error('body') is-invalid @enderror" type="text"></textarea>
                </div>
                <div class="col-md-4 form-group mb-3">
                    <label for="body" class="mb-2">Isi<sup class="text-danger">*</sup></label>
                    <textarea name="isi" placeholder="Input Isi Surat Tugas.." rows="10"
                        class="s-tugas form-control @error('body') is-invalid @enderror" type="text"></textarea>
                </div>
                <div class="col-md-4 form-group mb-3">
                    <label for="body" class="mb-2">Penutup<sup class="text-danger">*</sup></label>
                    <textarea name="penutup" placeholder="Input Kalimat Penutup Surat.." rows="10"
                        class="s-tugas form-control @error('body') is-invalid @enderror" type="text"></textarea>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6 form-group mb-3 mt-2">
                    <h4><b><u>Form Surat Perjalanan Dinas (SPD)</u></b></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 form-group mb-3">
                    <label for="body" class="mb-2">Kota Asal<sup class="text-danger">*</sup></label>
                    <input name="from" placeholder="Input Kota Asal.."
                        class="s-tugas form-control @error('body') is-invalid @enderror" type="text">
                </div>
                <div class="col-md-3 form-group mb-3">
                    <label for="body" class="mb-2">Waktu Keberangkatan<sup class="text-danger">*</sup></label>
                    <input name="from_time" placeholder="Input Waktu Keberangkatan.."
                        class="s-tugas form-control @error('body') is-invalid @enderror" type="datetime-local">
                </div>
                <div class="col-md-3 form-group mb-3">
                    <label for="body" class="mb-2">Kota Tujuan<sup class="text-danger">*</sup></label>
                    <input name="to" placeholder="Input Kota Tujuan.."
                        class="s-tugas form-control @error('body') is-invalid @enderror" type="text">
                </div>
                <div class="col-md-3 form-group mb-3">
                    <label for="body" class="mb-2">Estimasi Waktu Sampai<sup class="text-danger">*</sup></label>
                    <input name="to_time" placeholder="Input Estimasi Waktu Sampai.."
                        class="s-tugas form-control @error('body') is-invalid @enderror" type="datetime-local">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 form-group mb-3">
                    <label for="body" class="mb-2">Tempat<sup class="text-danger">*</sup></label>
                    <input name="tempat" placeholder="Input Detail Tempat.."
                        class="s-tugas form-control @error('body') is-invalid @enderror" type="text">
                </div>
                <div class="col-md-3 form-group mb-3">
                    <label for="body" class="mb-2">Awal Waktu Pembukaan</label>
                    <input name="pembukaan1" placeholder="Input Waktu Awal Pembukaan Surat.."
                        class="s-tugas form-control @error('body') is-invalid @enderror" type="datetime-local">
                </div>
                <div class="col-md-3 form-group mb-3">
                    <label for="body" class="mb-2">Akhir Waktu Pembukaan</label>
                    <input name="pembukaan2" placeholder="Input Waktu Akhir Pembukaan Surat.."
                        class="s-tugas form-control @error('body') is-invalid @enderror" type="time">
                </div>
                <div class="col-md-3 form-group mb-3">
                    <label for="body" class="mb-2">Biaya Perjalanan Dinas</label>
                    <input name="biaya" placeholder="Input Biaya Perjalanan Dinas.."
                        class="s-tugas form-control @error('body') is-invalid @enderror" type="text">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group mb-3">
                    <label for="get-pelaksana" class="mb-2">Pelaksana Tugas<sup class="text-danger">*</sup></label>
                    <select name="user_id" id="get-pelaksana" class="form-control">
                    </select>
                    @error('get-pelaksana')
                        <div class='invalid-feedback d-inline'>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-6 form-group mb-3">
                    <label for="body" class="mb-2">Angkutan</label>
                    <input name="alat" placeholder="Input Angkutan yang digunakan.."
                        class="s-tugas form-control @error('body') is-invalid @enderror" type="text">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group mb-3 mt-2">
                    <span>Pengikut</span>
                    <button type="button" class="btn btn-sm btn-success" onclick="addPengikut()">Tambah
                        Pengikut</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 form-group pengikut mb-3">
                    <label for="pengikut" class="mb-2">Nama</label>
                    <select name="pengikut[]" id="pengikut"
                        class="s-tugas get-pengikut input form-control"></select>
                    @error('pengikut')
                        <div class='invalid-feedback d-inline'>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-5 form-group keterangan mb-3">
                    <label for="keterangan" class="mb-2">Keterangan Pengikut</label>
                    <input name="keterangan_pengikut[]" id="keterangan" name="keterangan_pengikut[]"
                        placeholder="Input Keterangan Pengikut.." class="s-tugas input form-control" type="text">
                </div>
            </div>
            <div id="duplicateInputsContainer"></div>
            <div>
                <hr>
                <div class="row">
                    <div class="col-md-6 form-group mb-3 mt-2">
                        <h4><b><u>Form Visum Umum</u></b></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group mb-3">
                        <span>Waktu dan Tujuan</span>
                        <button type="button" class="btn btn-sm btn-success" onclick="addTujuan()">Tambah
                            Tujuan</button>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 form-group tujuan mb-3">
                        <label for="berangkat" class="mb-2">Berangkat Dari</label>
                        <input id="berangkat" name="from_detail[]" placeholder="Input Keberangkatan.."
                            class="s-tugas form-control" type="text">
                    </div>
                    <div class="col-md-3 form-group tujuan mb-3">
                        <label for="waktu-berangkat" class="mb-2">Waktu Keberangkatan</label>
                        <input id="waktu-berangkat" name="from_time_detail[]"
                            placeholder="Input Waktu Keberangkatan.." class="s-tugas form-control"
                            type="datetime-local">
                    </div>
                    <div class="col-md-3 form-group tujuan mb-3">
                        <label for="tujuan" class="mb-2">Tujuan</label>
                        <input id="tujuan" name="to_detail[]" placeholder="Input Tujuan.."
                            class="s-tugas form-control" type="text">
                    </div>
                    <div class="col-md-3 form-group tujuan mb-3">
                        <label for="waktu-sampai" class="mb-2">Waktu Sampai</label>
                        <input id="waktu-sampai" name="to_time_detail[]" placeholder="Input Waktu Sampai.."
                            class="s-tugas form-control" type="datetime-local">
                    </div>
                </div>
                <div id="tujuanDuplikat">
                </div>
                <div class="row mb-3">
                    <div class="col-md-12 form-group mb-3">
                        <label for="body" class="mb-2">Catatan Lainnya</label>
                        <textarea name="catatan" placeholder="Input Catatan Lainnya.." rows="10"
                            class="s-tugas form-control @error('body') is-invalid @enderror" type="text"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <div class="d-cat-tugas col-md-12 d-none">
    <div class="form-group mb-3">
        <label for="body" class="mb-2">Isi Surat Tugas</label>
        <textarea id="body" cols="30" rows="3" class="s-tugas form-control @error('body') is-invalid @enderror">{{ old('body') }}
    <tbody>
        <tr>
            <td >Kalimat Pembuka ............................................ </td>
            <table cellspacing="3" class="border-none" style="width:100%">
                <tbody>
                  <tr>
                    <td>nama</td>
                    <td>: ...................................................</td>
                  </tr>
                  <tr>
                    <td>NIP</td>
                    <td>: ...................................................</td>
                  </tr>
                  <tr>
                    <td>pangkat/golongan</td>
                    <td>: ...................................................</td>
                  </tr>
                  <tr>
                    <td>jabatan</td>
                    <td>: ...................................................</td>
                  </tr>
            </table>
            <td >Untuk ................................................ , dengan ketentuan sebagai berikut :</td>
            <table cellspacing="3" class="border-none" style="width:100%">
                <tbody>
                  <tr>
                    <td>hari, tanggal</td>
                    <td>: ...................................................</td>
                  </tr>
                  <tr>
                    <td>tempat</td>
                    <td>: ...................................................</td>
                  </tr>
                  <tr>
                    <td>pembukaan</td>
                    <td>: ...................................................</td>
                  </tr>
            </table>
            <td >Surat tugas ini dibuat untuk dilaksanakan dengan penuh tanggung jawab dan menyampaikan hasil dan membuat laporan.</td> <br>
    </tbody>
    </textarea>
    </div>
</div>
<div class="col-12 d-cat-tugas d-none">
    <div class='form-group mb-3'>
        <label for='spd' class='mb-2'>SPD</label>
        <textarea name='spd' id='spd' cols='30' rows='3'
            class='form-control @error('spd') is-invalid @enderror'>
    <table border="1" cellpadding="0" class="tb-format" style="width:100%">
        <tbody>
            <tr>
                <td style="text-align: center">1</td>
                <td>Jabatan</td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td style="text-align: center">2</td>
                <td>Nama/NIP Pegawai yang melaksanakan perjalanan dinas</td>
                <td colspan="2"><strong>Madirah, S.H./198601102021211001</strong></td>
            </tr>
            <tr>
                <td style="text-align: center">3</td>
                <td>
                <p>a. Pangkat dan Golongan<br />
                b.&nbsp;Jabatan dan Instansi<br />
                c.&nbsp;Tingkat biaya perjalanan dinas</p>
                </td>
                <td colspan="2">
                <p>a. IX<br />
                b.&nbsp;Analisis SDM Aparatur Ahli Pertama<br />
                c.&nbsp;</p>
                </td>
            </tr>
            <tr>
                <td style="text-align: center">4</td>
                <td>Maksud perjalanan dinas</td>
                <td colspan="2">untuk menghadiri undangan Revisi Peta Jabatan PTN</td>
            </tr>
            <tr>
                <td style="text-align: center">5</td>
                <td>Alat angkutan yang dipergunakan</td>
                <td>.........</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: center">6</td>
                <td>
                <p>a. Tempat Berangkat<br />
                b.&nbsp;Kota Tujuan/Provinsi</p>
                </td>
                <td>
                <p>a. Indramayu, Jawa Barat<br />
                b.&nbsp;Bogor, Jawa Barat</p>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: center">7</td>
                <td>
                <p>a. Lama perjalanan dinas<br />
                b.&nbsp;Tanggal Berangkat<br />
                c.&nbsp;Tanggal harus kembali</p>
                </td>
                <td>
                <p>a. 3 (tiga) hari<br />
                b.&nbsp;Kamis, 25 Mei 2023<br />
                c.&nbsp;Sabtu, 27 Mei 2023</p>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: center">8</td>
                <td>Nama Pengikut/NIP.</td>
                <td style="text-align:center">Golongan/Ruang</td>
                <td style="text-align:center">Keterangan</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: center">9</td>
                <td>
                <p>a. Instansi<br />
                b.&nbsp;Akun</p>
                </td>
                <td>
                <p>a. Politeknik Negeri Indramayu<br />
                b.&nbsp;524111</p>
                </td>
                <td>&nbsp;</td>
            </tr>
        </tbody>
    </table>
    </textarea>
        @error('spd')
            <div class='invalid-feedback'>
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<div class="col-12 d-cat-tugas d-none">
    <div class='form-group mb-3'>
        <label for='visum_umum' class='mb-2'>Visum Umum</label>
        <textarea name='visum_umum' id='visum_umum' cols='30' rows='3'
            class='form-control @error('visum_umum') is-invalid @enderror'>
        <table cellpadding="0" class="tb-format" style="width: 100%">
        <tbody>
        <tr id="i">
            <td style="width: 50%; border: 1px solid black; padding: 8px;">&nbsp;</td>
            <td class="td-format" style=" border: 1px solid black; padding: 8px;">
                <table cellspacing="0" class="border-none" style="width:100%">
                    <tbody>
                    <tr>
                        <td>I.</td>
                        <td>Berangkat Dari</td>
                        <td>: Indramayu (tempat kedudukan)</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Pada Tanggal</td>
                        <td>: {{ now()->translatedFormat('d F Y') }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Ke</td>
                        <td>: Cirebon</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Jabatan</td>
                        <td>: <b>{{ $jabatan }}</b></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>&nbsp;</td>
                        <td>
                        <br>
                        <strong><i> ditandatangai secara elektronik</i></strong>
                        <br>
                        <p>


                        </p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr id="ii">
            <td class="td-format" style=" border: 1px solid black; padding: 8px;">
                <table cellspacing="0" class="border-none" style="width:100%">
                    <tbody>
                    <tr>
                        <td>II.</td>
                        <td>Tiba di</td>
                        <td>
                        : Hotel Ibis Styles Bogor Pajajaran - Bogor Jawa Barat
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Pada Tanggal</td>
                        <td>: {{ now()->translatedFormat('d F Y') }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Kepala</td>
                        <td>:</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>&nbsp;</td>
                        <td>
                            <br>
                            <br>
                            <br>
                        <p>
                            <br />
                            NIP
                        </p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td style="width: 50%; border: 1px solid black; padding: 8px;">
                <table cellspacing="0" class="border-none" style="width:100%">
                    <tbody>
                    <tr>
                        <td></td>
                        <td>Berangkat Dari</td>
                        <td>
                        : Hotel Ibis Styles Bogor Pajajaran - Bogor Jawa Barat
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Pada Tanggal</td>
                        <td>: {{ now()->translatedFormat('d F Y') }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Ke</td>
                        <td>:</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Kepala</td>
                        <td>:</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>&nbsp;</td>
                        <td>
                            <br>
                            <br>
                            <br>
                        <p>
                            <br />
                            NIP
                        </p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr id="iii">
            <td class="td-format" style=" border: 1px solid black; padding: 8px;">
                <table cellspacing="0" class="border-none" style="width:100%">
                    <tbody>
                    <tr>
                        <td>III.</td>
                        <td>Tiba di</td>
                        <td>:</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Pada Tanggal</td>
                        <td>: {{ now()->translatedFormat('d F Y') }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Kepala</td>
                        <td>:</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>&nbsp;</td>
                        <td>
                            <br>
                            <br>
                            <br>
                        <p>
                            <br />
                            NIP
                        </p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td style="width: 50%; border: 1px solid black; padding: 8px;">
                <table cellspacing="0" class="border-none" style="width:100%">
                    <tbody>
                    <tr>
                        <td></td>
                        <td>Ke</td>
                        <td>:</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Kepala</td>
                        <td>:</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>&nbsp;</td>
                        <td>
                            <br>
                            <br>
                            <br>
                        <p>
                            <br />
                            NIP
                        </p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr id="iv">
            <td class="td-format" style=" border: 1px solid black; padding: 8px;">
                <table cellspacing="0" class="border-none" style="width:100%">
                <tbody>
                  <tr>
                    <td>IV.</td>
                    <td>Tiba di</td>
                    <td>:</td>
                  </tr>
                  <tr>
                    <td></td>
                    <td>Pada Tanggal</td>
                    <td>: {{ now()->translatedFormat('d F Y') }}</td>
                </tr>
                  <tr>
                    <td></td>
                    <td>Kepala</td>
                    <td>:</td>
                  </tr>
                  <tr>
                    <td></td>
                    <td>&nbsp;</td>
                    <td>
                    <br>
                    <br>
                    <br>
                      <p>
                        <br />
                        NIP
                      </p>
                    </td>
                  </tr>
                </tbody>
                </table>
            </td>
            <td style="width: 50%; border: 1px solid black; padding: 8px;">
                <table cellspacing="0" class="border-none" style="width:100%">
                    <tbody>
                    <tr>
                        <td></td>
                        <td>Berangkat Dari</td>
                        <td>:</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Pada Tanggal</td>
                        <td>: {{ now()->translatedFormat('d F Y') }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Ke</td>
                        <td>:</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Kepala</td>
                        <td>:</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>&nbsp;</td>
                        <td>
                            <br>
                            <br>
                            <br>
                        <p>
                            <br />
                            NIP
                        </p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr id="v">
            <td class="td-format" style=" border: 1px solid black; padding: 8px;">
                <table cellspacing="0" class="border-none" style="width:100%">
                    <tbody>
                        <tr>
                            <td>V.</td>
                            <td>Tiba di</td>
                            <td>: Indramayu</td>
                        </tr>
                        <tr>
                        <td></td>
                        <td>Pada Tanggal</td>
                        <td>: {{ now()->translatedFormat('d F Y') }}</td>
                        </tr>
                        <tr>
                            <td style="width: 9%;">&nbsp;</td>
                            <td style="width: 31%;"></td>                                                 <td style="width: 60%;"><br><b>{{ $jabatan }}</b></td>
                        </tr>
                        <tr>
                            <td style="width: 9%;">&nbsp;</td>
                            <td style="width: 31%;"></td>
                            <td style="width: 60%;">
                            <br>
                            <strong><i>ditandatangai secara elektronik</i></strong>
                            <br>
                            <p>


                            </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td class="td-format" style=" border: 1px solid black; padding: 8px;">
                <table cellspacing="0" class="border-none" style="width:100%">
                    <tbody>
                    <tr>
                        <td colspan="2">
                        Telah diperiksa dengan keterangan bahwa perjalanan tersebut
                        perintahnya dan semata-mata untuk kepentingan jabatan dalam
                        waktu yang sesingkat-singkatnya
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td style="width: 40%;">&nbsp;</td>
                        <td style="width: 60%;"><b>{{ $jabatan }}</b></td>
                    </tr>
                    <tr>
                        <td style="width: 40%;">&nbsp;</td>
                        <td style="width: 60%;">
                            <br>
                            <strong><i>ditandatangai secara elektronik</i></strong>
                            <br>
                            <p>


                            </p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
    </textarea>
        @error('visum_umum')
            <div class='invalid-feedback'>
                {{ $message }}
            </div>
        @enderror
    </div>
</div> --}}
