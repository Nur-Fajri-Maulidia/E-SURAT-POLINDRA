<html>

<head>
    <title>SURAT TUGAS {!! $item->no_surat ?? '' !!}</title>
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
            <div style="text-align: center">
                {!! strtoupper($item->category->name) !!}
            </div>
            <div style="text-align: center">
                Nomor: {!! $item->no_surat !!}
            </div>
            <br>
            <br>
            <table>
                <tbody>
                    <tr>
                        <td>{{ $item->tugas[0]->pembuka }}</td>
                    </tr>
                    <tr>
                        <td>
                            <table cellspacing="3" class="border-none" style="width:100%">
                                <tbody>
                                    <tr>
                                        <td>nama</td>
                                        <td>: {{ $item->tugas[0]->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>NIP</td>
                                        <td>: {{ $item->tugas[0]->user->nip }}</td>
                                    </tr>
                                    <tr>
                                        <td>pangkat/golongan</td>
                                        <td>: {{ $item->tugas[0]->user->pangkat->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td>jabatan</td>
                                        <td>: {{ $item->tugas[0]->user->jabatan->nama ?? '-' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>{{ $item->tugas[0]->isi }}</td>
                    </tr>
                    <tr>
                        <td>
                            <table cellspacing="3" class="border-none" style="width:100%">
                                <tbody>
                                    <tr>
                                        <td>hari, tanggal</td>
                                        @php
                                            $fromDate = \Carbon\Carbon::parse($item->tugas[0]->from_time);
                                            $toDate = \Carbon\Carbon::parse($item->tugas[0]->to_time);
                                            $dateRange = $fromDate->translatedFormat('l') . ' s.d ' . $toDate->translatedFormat('l') . ', ' . $fromDate->translatedFormat('d') . ' s.d ' . $toDate->translatedFormat('d F Y');
                                        @endphp
                                        <td>: {{ $dateRange }}</td>
                                    </tr>
                                    <tr>
                                        <td>tempat</td>
                                        <td>: {{ $item->tugas[0]->tempat }}</td>
                                    </tr>
                                    @if ($item->tugas[0]->pembukaan && $item->tugas[0]->penutupan)
                                        <tr>
                                            <td>pembukaan</td>
                                            <td>:
                                                {{ \Carbon\Carbon::parse($item->tugas[0]->pembukaan)->translatedFormat('l, j F Y') }}
                                                pukul
                                                {{ \Carbon\Carbon::parse($item->tugas[0]->pembukaan)->translatedFormat('H:i') }}
                                                s.d.
                                                {{ \Carbon\Carbon::parse($item->tugas[0]->penutupan)->translatedFormat('H:i') }}
                                            </td>
                                        </tr>
                                    @endif

                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>{{ $item->tugas[0]->penutup }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <table class="mt-5 table-footer" style="width:100%">
        <tr>
            <td style="width:60% !important">
            </td>
            <td style="width:40%">
                @if ($item->tte_created_user_id)
                    <div class="ttd-tempat-jabatan">
                        <p>{{ Carbon\Carbon::now()->translatedFormat('d F Y') }} <br>
                            {{ $item->tte_created_user->jabatan->nama ?? '-' }}</p>
                    </div>
                    <div class="ttd-qrcode">
                        <img src="{{ $item->qrcode() }}" alt="QR-TTE" class="img-fluid gambar-tte">

                    </div>
                    <div class="tte-nama-gelar">
                        <p>{{ $item->tte_created_user->name ?? '-' }} <br>
                            NIP {{ $item->tte_created_user->nip ?? '-' }}</p>
                    </div>
                @endif
            </td>
        </tr>
    </table>
</body>

</html>
