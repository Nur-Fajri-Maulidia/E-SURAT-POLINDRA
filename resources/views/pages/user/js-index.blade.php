<script>
    $(function() {
        let otable = $('#dTable').DataTable({
            orderCellsTop: true,
            searching: true,
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: '{{ route('users.data') }}',
                data: function(d) {
                    d.role_select = $('#role_select').val();
                    d.unit_kerja_select = $('#unit_kerja_select').val();
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'username',
                    name: 'username'
                },
                {
                    data: 'nip',
                    name: 'nip'
                },
                {
                    data: 'unit_kerja',
                    name: 'unit_kerja'
                },
                {
                    data: 'jabatan',
                    name: 'jabatan'
                },
                {
                    data: 'pangkat',
                    name: 'pangkat'
                },
                {
                    data: 'role',
                    name: 'role'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });
        $(document).ready(function() {
            $('#dTable_filter').remove();
        });

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
                    var url = "{{ route('users.destroy', ':id') }}";
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

        // get roles
        let getRoles = function(id) {
            let data;
            $.ajax({
                url: '{{ route('roles.get-json') }}',
                type: 'JSON',
                method: 'GET',
                async: false,
                success: function(response) {
                    data = response;
                }
            })

            return data;
        }


        // get roles
        let getUnitKerja = function(id) {
            let data;
            $.ajax({
                url: '{{ route('unit-kerjas.get-json') }}',
                type: 'JSON',
                method: 'GET',
                async: false,
                success: function(response) {
                    data = response;
                }
            })

            return data;
        }

        // looping role di filter
        let data_roles = getRoles();
        $('#role_select').empty();
        $('#role_select').append(
            `<option value="">Semua</option>`
        );
        data_roles.forEach(role => {
            $('#role_select').append(
                `<option value="${role.name}">${role.name}</option>`);
        });

        // looping unit_kerja di filter
        let data_unit_kerja = getUnitKerja();
        $('#unit_kerja_select').empty();
        $('#unit_kerja_select').append(
            `<option value="">Semua</option>`
        );
        data_unit_kerja.forEach(unit_kerja => {
            $('#unit_kerja_select').append(
                `<option value="${unit_kerja.id}">${unit_kerja.name}</option>`);
        });

        // filter
        $('.btnFilter').on('click', function() {
            otable.draw();
        });

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
