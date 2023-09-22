<script>
    $(function() {
        let otable = $('#dTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            searchable: true,
            lengthMenu: [
                [15, 30, 50, 100, 150, 300],
                [15, 30, 50, 100, 150, 300]
            ],
            ajax: {
                url: '{{ route('jabatans.data') }}',
                data: function(d) {
                    d.nama = $('#nama').val();
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'jabatan',
                    name: 'jabatan',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });


        // btn create
        $('.btnAdd').on('click', function() {
            let data_j = getUnitKerjas();
            // looping unit kerja
            $('#myModal #nama').empty();
            
            $('#myModal .modal-title').text('Tambah Data');
            $('#myModal').modal('show');
        })

        // btn submit
        $('#myModal #myForm').on('submit', function(e) {
            e.preventDefault();
            let form = $('#myModal #myForm');
            $.ajax({
                url: '{{ route('jabatans.store') }}',
                type: 'POST',
                dataType: 'JSON',
                data: form.serialize(),
                success: function(response) {
                    swal(response);
                    otable.ajax.reload();
                    $('#myModal').modal('hide');
                },
                error: function(response) {
                    let errors = response.responseJSON?.errors
                    $(form).find('.text-danger.text-small').remove()
                    if (errors) {
                        for (const [key, value] of Object.entries(errors)) {
                            $(`[name='${key}']`).parent().append(
                                `<sp class="text-danger text-small">${value}</sp>`)
                            $(`[name='${key}']`).addClass('is-invalid')
                        }
                    }
                }
            })
        })

        // edit
        $('body').on('click', '.btnEdit', function() {
            let id = $(this).data('id');
            let detail = getDetail(id);
            console.log(detail.nama);
            $('#myForm #id').val(detail.id);
            $('#myForm #nama').val(detail.nama);
            // looping unit kerja
            
            $('#myModal .modal-title').text('Edit Data');
            $('#myModal').modal('show');
        })

        // hapus
        $('body').on('click', '.btnDelete', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            Swal.fire({
                title: 'Apakah Yakin?',
                text: `Data yang dihapus tidak bisa dikembalikan!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yakin'
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = "{{ route('jabatans.destroy', ':id') }}";
                    url = url.replace(':id', id);
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        dataType: 'JSON',
                        success: function(response) {
                            swal(response);
                            otable.ajax.reload();
                            $('#myModal').modal('hide');

                        },
                        error: function(response) {
                            swal(response);
                        }
                    })
                }
            })
        })

        // get unit_kerjas
        let getUnitKerjas = function(id) {
            let data;
            $.ajax({
                url: '{{ route('jabatans.get-byunitkerja') }}',
                type: 'JSON',
                method: 'GET',
                async: false,
                success: function(response) {
                    data = response;
                }
            })

            return data;
        }

        // looping unit kerja di filter
        let data_jabatan = getUnitKerjas();
        $('#nama').empty();
        $('#nama').append(
            `<option value="">Semua</option>`
        );
        data_jabatan.forEach(jabatan => {
            $('#nama').append(
                `<option value="${jabatan.nama}">${jabatan.nama}</option>`);
        });

        // filter
        $('.btnFilter').on('click', function() {
            otable.draw();
        });

        // get detail
        let getDetail = function(id) {
            let data;
            var urlDetail = "{{ route('jabatans.show', ':id') }}";
            urlDetail = urlDetail.replace(':id', id);
            $.ajax({
                url: urlDetail,
                type: 'JSON',
                method: 'GET',
                async: false,
                success: function(response) {
                    data = response;
                }
            })

            return data;
        }

        $('#myModal').on('hidden.bs.modal', function() {
            let form = $('#myModal #myForm');
            $('.text-danger').addClass('d-none');
            $('.is-invalid').removeClass('is-invalid');
            form.trigger('reset');
        })

        function swal(response) {
            Swal.fire({
                position: 'center',
                icon: response.status,
                title: response.message,
                showConfirmButton: true,
                timer: 1500
            })
        }
    })
</script>