<html>

<head>
    <title>KOP SURAT</title>
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
            {!! $item->body !!}
        </div>
    </div>
    <table class="mt-5 table-footer" style="width:100%">
        <tr>
            <td style="width:85% !important">
            </td>
            <td style="width:25%">
                @if ($item->tte_created_user_id)
                    <div class="ttd-tempat-jabatan">
                        <p>{{ Carbon\Carbon::now()->translatedFormat('d F Y') }} <br>
                            {{ $item->tte_created_user->jabatan->nama ?? '-' }}</p>
                    </div>
                    <div class="ttd-qrcode">
                        <img src="{{ $item->qrcode() }}" alt="" class="img-fluid gambar-tte">

                    </div>
                    <div class="tte-nama-gelar">
                        <p>{{ $item->tte_created_user->name ?? '-' }}</p>
                        <p>NIP {{ $item->tte_created_user->nip ?? '-' }}</p>
                    </div>
                @endif
            </td>
        </tr>
    </table>
</body>

</html>
