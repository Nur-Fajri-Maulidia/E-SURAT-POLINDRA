<html>

<head>
    <title>Download Visum Umum</title>
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

        .gambar-tte {
            border-radius: 0 !important;
            height: 50px !important;
            width: 50px !important;
            margin: 5px 0;
        }

        .body {
            margin-top: 20px;
            font-size: 12px;
        }


        table.tb-format {
            border-collapse: collapse;
            width: 100%;
        }

        table.tb-format td.td-format {
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

        table.tb-format td table {
            border: none;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .footer p {
            color: #333;
            font-size: 10px;
        }
    </style>
</head>

<body>
    <main>
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
                {{-- <h4 style="text-align: center;font-family:Arial, Helvetica, sans-serif">SURAT VISUM UMUM</h4> --}}
                <table cellpadding="0" class="tb-format" style="width: 100%">
                    <tbody>
                        @foreach ($items as $item)
                            @php
                                $totalTujuan = count($item->tugas[0]->tujuan);
                                $index = 1;
                                function intToRoman($num)
                                {
                                    $romans = [
                                        'M' => 1000,
                                        'CM' => 900,
                                        'D' => 500,
                                        'CD' => 400,
                                        'C' => 100,
                                        'XC' => 90,
                                        'L' => 50,
                                        'XL' => 40,
                                        'X' => 10,
                                        'IX' => 9,
                                        'V' => 5,
                                        'IV' => 4,
                                        'I' => 1,
                                    ];
                                    $result = '';
                                    foreach ($romans as $roman => $value) {
                                        $matches = intval($num / $value);
                                        $result .= str_repeat($roman, $matches);
                                        $num = $num % $value;
                                    }
                                    return $result;
                                }
                            @endphp
                            <tr class="romawi-count">
                                <td style="width: 50%; border: 1px solid black; padding: 8px;">&nbsp;</td>
                                <td class="td-format" style=" border: 1px solid black; padding: 8px;">
                                    <table cellspacing="0" class="border-none" style="width:100%">
                                        <tbody>
                                            <tr>
                                                <td class="romawi">{{ intToRoman($index) }}.</td>
                                                <td>Berangkat Dari</td>
                                                <td>: {{ $item->tugas[0]->from }}</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>Pada Tanggal</td>
                                                <td>:
                                                    {{ \Carbon\Carbon::parse($item->tugas[0]->from_time)->translatedFormat('d F Y') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>Ke</td>
                                                <td>: {{ $item->tugas[0]->to }}</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>Jabatan</td>
                                                <td>: <b>Pejabat Pembuat Komitmen</b></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>&nbsp;</td>
                                                <td>
                                                    <br>&nbsp;
                                                    <img src="{{ $item->qrcode() }}" alt="QR-TTE"
                                                        class="img-fluid gambar-tte">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;&nbsp;<span>{{ $item->tte_created_user->name }}</span><br>
                                                    &nbsp;&nbsp;<span>{{ $item->tte_created_user->nip }}</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            @php
                                $index++;
                            @endphp
                            @foreach ($item->tugas[0]->tujuan as $v)
                            <tr class="romawi-count">
                                <td class="td-format" style=" border: 1px solid black; padding: 8px;">
                                    <table cellspacing="0" class="border-none" style="width:100%">
                                        <tbody>
                                            <tr>
                                                <td class="romawi">{{ intToRoman($index++) }}.</td>
                                                <td>Tiba di</td>
                                                <td>
                                                    : {{ $v->to }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>Pada Tanggal</td>
                                                <td>: {{ \Carbon\Carbon::parse($v->to_time)->translatedFormat('d F Y') }}</td>
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
                                                    <p>
                                                        <br>
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
                                                    : {{ $v->from }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>Pada Tanggal</td>
                                                <td>: {{ \Carbon\Carbon::parse($v->from_time)->translatedFormat('d F Y') }}</td>
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
                                                    <p>
                                                        <br>
                                                        NIP
                                                    </p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            @endforeach
                        @endforeach
                        <tr class="romawi-count">
                            <td class="td-format" style=" border: 1px solid black; padding: 8px;">
                                <table cellspacing="0" class="border-none" style="width:100%">
                                    <tbody>
                                        <tr>
                                            <td class="romawi">{{ intToRoman($index++) }}.</td>
                                            <td>Tiba di</td>
                                            <td>: {{ $item->tugas[0]->from }}</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>Pada Tanggal</td>
                                            <td>:
                                                {{ \Carbon\Carbon::parse($item->tugas[0]->to_time)->translatedFormat('d F Y') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 9%;">&nbsp;</td>
                                            <td style="width: 31%;"></td>
                                            <td style="width: 60%;"><br><b>Pejabat Pembuat Komitmen</b></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 9%;">&nbsp;</td>
                                            <td style="width: 31%;"></td>
                                            <td style="width: 60%;">
                                                <br>&nbsp;&nbsp;
                                                <img src="{{ $item->qrcode() }}" alt=""
                                                    class="img-fluid gambar-tte">
                                                <br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 9%;">&nbsp;</td>
                                            <td style="width: 31%;"></td>
                                            <td style="width: 60%;">&nbsp;&nbsp;<span>{{ $item->tte_created_user->name }}</span><br>
                                                &nbsp;&nbsp;<span>{{ $item->tte_created_user->nip }}</span>
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
                                                waktu yang sesingkat-singkatnya.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 40%;">&nbsp;</td>
                                            <td style="width: 60%;">&nbsp;&nbsp;<b>Pejabat Pembuat Komitmen</b></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 40%;">&nbsp;</td>
                                            <td style="width: 60%;">
                                                <br>&nbsp;&nbsp;
                                                <img src="{{ $item->qrcode() }}" alt=""
                                                    class="img-fluid gambar-tte">
                                                <br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 40%;">&nbsp;</td>
                                            <td style="width: 60%;">&nbsp;&nbsp;<span>{{ $item->tte_created_user->name }}</span><br>
                                                &nbsp;&nbsp;<span>{{ $item->tte_created_user->nip }}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr class="romawi-count">
                            <td class="td-format" style=" border: 1px solid black; padding: 8px;">
                                <table cellspacing="0" class="border-none" style="width:100%">
                                    <tbody>
                                        <tr>
                                            <td class="romawi">{{ intToRoman($index++) }}.</td>
                                            <td> CATATAN LAIN-LAIN</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td class="td-format" style=" border: 1px solid black; padding: 8px;">
                                <table cellspacing="0" class="border-none" style="width:100%">
                                    <tbody>
                                        <tr>
                                            <td colspan="2">
                                                {{ $item->tugas[0]->catatan ?? '' }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    {{-- <footer>
        <div class="footer">
            <table id="table-qr" class="mt-5 table-footer" style="width:100%">
                <tr>
                    <td style="width:10% !important">
                        <br>
                        @if ($item->tte_visum_umum_created)
                            <div class="ttd-qrcode">
                                <img src="{{ $item->qrcode() }}" alt="" class="img-fluid gambar-tte">
                            </div>
                        @endif
                    </td>
                    <td style="width:90%">
                        <hr style="width:100%; margin: 0; border-width: 1px; border-color: #000;">
                        <p>Dokumen ini telah di tanda tangani secara elektronik.</p>
                    </td>
                </tr>
            </table>
        </div>
    </footer> --}}
</body>

</html>
