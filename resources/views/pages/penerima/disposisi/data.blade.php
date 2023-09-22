<div class="card">
    <div class="card-body">
        <div class="row">
            <table class="table dtTable table-hover">
                <thead>
                    <tr>
                        <td>Sifat Surat</td>
                        <td>Intruksi</td>
                        <td>Kode Hal</td>
                        <td>Hal</td>
                        <td>Deskripsi</td>
                        <td>Keterangan</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $view->sifat_surat }}</td>
                        <td>{{ $view->intruksi }}</td>
                        <td>{{ $view->getDocument->kode_hal }}</td>
                        <td>{{ $view->getDocument->hal }}</td>
                        <td>{{ $view->getDocument->deskripsi }}</td>
                        <td>{{ $view->getDocument->keterangan }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-md-12 col-sm-12 text-center">
                <a class="btn btn-success btn-sm" href="{{ route('disposisi.download', [
                                    'uuid' => $item->uuid,
                                ]) }}">Download</a>
            </div>
        </div>
    </div>
</div>
