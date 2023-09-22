<!DOCTYPE html>
<html lang="en">
<head>
    <style>
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
    <div class="footer">
        <table id="table-qr" class="mt-5 table-footer" style="width:100%">
            <tr>
                <td style="width:10% !important">
                    <br>
                    @if ($item->tte_visum_umum_created)
                        <div class="ttd-qrcode">
                            <img src="{{ $item->qrcodeVisumUmum() }}" alt="" class="img-fluid gambar-tte">
                        </div>
                    @endif
                </td>
                <td style="width:90%">
                    <hr style="width:550px; margin: 0; border-width: 1px; border-color: #000;">
                    <p>Dokumen ini telah di tanda tangani secara elektronik.</p>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
