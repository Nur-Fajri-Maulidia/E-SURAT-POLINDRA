<div class="modal fade" id="viewDisposisi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title" id="">
                    <strong id="modalHeadingView"> </strong>
                </span>
                <button class="btn btn-close btn-outline-secondary" type="button" data-dismiss="modal"
                    aria-label="Close">Close</button>
            </div>
            <div class="modal-body">
                {{-- <a href="{{ route('documents.tte.visum-umum.download', [
                                'uuid' => $item->uuid
                            ]) }}"
                                class="btn btn-success btn-sm">Download</a> --}}
                                <button class="btn btn-success btn-sm" onclick="download(' . $item->id . ')">Download</button>
                <div id="modal-content-view">
                </div>
            </div>
        </div>
    </div>
</div>
