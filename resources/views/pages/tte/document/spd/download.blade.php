<html>

<head>
    <title>Download SPD</title>
    <style>
        .rangkasurat {
            font-family: 'Times New Roman', Times, serif;
            padding-left: 50px;
            padding-right: 30px;
            background: white;
        }

        .tbl-kop {
            border-bottom: 3px solid #000;
            padding: 2px;
        }

        .tengah {
            text-align: center;
        }

        .jd1 {
            font-size: 18px;
        }

        .jd2 {
            font-size: 16px;
            font-weight: bold;
        }

        .td-gambar {
            width: 25%;
            text-align: left;
        }

        .jd3 {
            font-size: 14px;
        }

        .text-left {
            align-content: flex-start;
            align-items: flex-start;
        }

        .gambar {
            height: 140px;
            margin-left: -10px;
        }

        /* .tte-nama-gelar{
                        margin-top: 70px;
                    } */
        .gambar-tte {
            border-radius: 0 !important;
            height: 80px !important;
            width: 80px !important;
            margin: 5px 0;
        }

        .body {
            margin-top: 20px;
        }

        table.tb-format {
            font-size: 12px;
            font-family: Arial, Helvetica, sans-serif
        }

        table.tb-format {
            border-collapse: collapse !important;
            width: 100% !important;
        }

        table.tb-format td,
        table.tb-format td {
            border: 1px solid black;
            padding: 8px;
        }

        table.tb-format ul.abc {
            list-style-type: lower-alpha;
            text-align: left;
            padding-left: 10px;
        }

        table.tb-format .text-right {
            float: right;
            margin-right: 100px;
        }
    </style>
</head>

<body>
    <div class="rangkasurat">
        <table width="100%" class="tbl-kop">
            <tr>
                <td class="td-gambar">
                    <div class="text-left">
                        <img src="{{ asset('assets/images/polindra.png') }}" class="gambar" />
                    </div>
                </td>
                <td class="tengah">
                    <div class="jd1">KEMENTRIAN PENDIDIKAN, KEBUDAYAAN, <br> RISET DAN TEKNOLOGI</div>
                    <div class="jd2">POLITEKNIK NEGERI INDRAMAYU</div>
                    <div class="jd3">Jalan Raya Lohbener Lama Nomor 8 Lohbener - Indramayu 45353</div>
                    <div class="jd3">Telepon/Faximile: (0234) 5746</div>
                    <div class="jd3">Laman: https://www.polindra.ac.id e-mail: info@polindra.ac.id</div>
                </td>
            </tr>
        </table>
        <div class="body mt-4">
            <h4 style="text-align: center;font-family:Arial, Helvetica, sans-serif">SURAT PERJALANAN DINAS <br>
                (SPD)</h4>
            <table border="1" cellpadding="0" class="tb-format" style="width:100%">
                <tbody>
                    <tr>
                        <td style="text-align: center">1</td>
                        <td>Pejabat Pembuat Komitmen</td>
                        <td colspan="2">
                            <b>
                                {{ $item->tte_spd_created_user->name ?? '' }}/{{ $item->tte_spd_created_user->nip ?? '' }}
                            </b>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center">2</td>
                        <td>Nama/NIP Pegawai yang melaksanakan perjalanan dinas</td>
                        <td colspan="2">
                            <strong>{{ $item->tugas[0]->user->name }}/{{ $item->tugas[0]->user->nip }}</strong>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center">3</td>
                        <td>
                            <p>a. Pangkat dan Golongan<br />
                                b. Jabatan dan Instansi<br />
                                c. Tingkat biaya perjalanan dinas</p>
                        </td>
                        {{-- <td colspan="2">
                            <p>a. {{ $item->tugas[0]->user->pangkat->name ?? '-' }}<br />
                            b. {{ optional($item->tugas[0]->user->jabatan)->nama ?? '-' }}<br />
                            c. Rp {{ $item->tugas[0]->biaya ?? '-' }}</p>
                        </td> --}}
                        <td colspan="2">
                            <p>a. {{ $item->tugas[0]->user->pangkat->name ?? '-' }}<br />
                                b. {{ $item->tugas[0]->user->jabatan->nama ?? '-' }}<br />
                                c. Rp {{ $item->tugas[0]->biaya ?? '-' }}</p>
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
                        <td>{{ $item->tugas[0]->alat }}</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align: center">6</td>
                        <td>
                            <p>a. Tempat Berangkat<br>
                                b. Kota Tujuan/Provinsi</p>
                        </td>
                        <td>
                            <p>a. {{ $item->tugas[0]->from }}<br>
                                b. {{ $item->tugas[0]->to }}</p>
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align: center">7</td>
                        <td>
                            <p>a. Lama perjalanan dinas<br>
                                b. Tanggal Berangkat<br>
                                c. Tanggal harus kembali</p>
                        </td>
                        <td>
                            @php
                                $fromDate = \Carbon\Carbon::parse($item->tugas[0]->from_time);
                                $toDate = \Carbon\Carbon::parse($item->tugas[0]->to_time);
                                $selisih = $toDate->diffInDays($fromDate);
                            @endphp
                            <p>a. {{ $selisih }} hari<br>
                                b. {{ $fromDate->format('l, d F Y') }}<br>
                                c. {{ $toDate->format('l, d F Y') }}</p>
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
                        <td>
                            @php
                                $namaPengikut = [];
                                $keterangan = [];
                                $n = [];
                                foreach ($item->tugas as $tugas) {
                                    foreach ($tugas->pengikutTugas as $pengikut) {
                                        $userName = $pengikut->user;
                                        $namaPengikut[] = $userName;
                                        $keterangan[] = $pengikut->keterangan;
                                    }
                                }
                            @endphp
                            @foreach ($namaPengikut as $pengikut)
                                {{ $pengikut->name ?? '' }}/{{ $pengikut->nip ?? '' }}<br>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($namaPengikut as $p)
                                {{ $p->pangkat->name ?? '' }}<br>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($keterangan as $ket)
                                {{ $ket ?? '' }}<br>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center">9</td>
                        <td>
                            <p>a. Instansi<br />
                                b. Akun</p>
                        </td>
                        <td>
                            <p>a. {{ $instansi->nama }}<br />
                                b. {{ $instansi->akun }}</p>
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align: center">10</td>
                        <td>
                            Keterangan lain-lain
                        </td>
                        <td>
                            <p>No. Surat Tugas<br>
                                Tanggal</p>
                        </td>
                        <td>
                            <p>{{ $item->no_surat }}<br>
                                {{ $item->created_at }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">Dikeluarkan di
                            Indramayu<br>
                            Tanggal
                            {{ $item->tte_spd_created }}<br>
                            <br>
                            <strong>Pejabat Pembuat Komitmen</strong><br><br>
                            <img style="width:70px; height:70px" src="{{ $item->qrcode() }}" alt="QR-TTE">
                            <br>
                            <p><b>{{ $item->tte_spd_created_user->name ?? '-' }}</b> <br>
                                NIP {{ $item->tte_spd_created_user->nip ?? '-' }}</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
