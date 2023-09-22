<script>
    $(document).ready(function() {
        $('#disposisi-masuk').DataTable({
            order: [
                [0, 'asc']
            ],
            processing: true,
            serverSide: true,
            searchable: true,
            lengthMenu: [
                [5, 10, 15, 20, 25],
                [5, 10, 15, 20, 25]
            ],
            ajax: "{{ route('disposisi.table') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false,
                    orderable: false,
                    render: function(data) {
                        return '<div class="text-primary text-center">' + data +
                            '</div>';
                    },
                },
                {
                    data: 'sifat_surat',
                    name: 'sifat_surat'
                },
                {
                    data: 'intruksi',
                    name: 'intruksi'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
    });

    function showView(id) {
        $('#modalHeadingView').html("Detail Disposisi");
        $('#modal-content-view').show();
        $.ajax({
            url: '{{ route('disposisi.view') }}',
            type: 'GET',
            data: {
                id: id,
            },
            success: function(data) {
                $('#modal-content-view').html(data);
                $('#viewDisposisi').modal('show');
                return true;
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    }
</script>
