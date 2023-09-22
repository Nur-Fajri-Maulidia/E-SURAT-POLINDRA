<script>
    $(function() {

        let getRolesNotUnitKerja = function() {
            let data;
            $.ajax({
                url: '{{ route('roles.get-byunitkerja') }}',
                type: 'JSON',
                method: 'GET',
                async: false,
                success: function(response) {
                    data = response;
                }
            })

            return data;
        }

        // get jabatans by unit_kerja id
        let getJabatanNotUnitkerja = function() {
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

        let data_jabatans = getJabatanNotUnitkerja();

        // looping jabatan
        $('#jabatan_id').empty();
        $('#jabatan_id').append(
            `<option value="">Pilih Jabatan</option>`
        );
        if (data_jabatans) {
            data_jabatans.forEach(jabatan => {
                $('#jabatan_id').append(
                    `<option value="${jabatan.id}">${jabatan.nama}</option>`);
            });
        }

        let getPangkat = function() {
            let data;
            $.ajax({
                url: '{{ route('pangkat.getByName') }}',
                type: 'JSON',
                method: 'GET',
                async: false,
                success: function(response) {
                    data = response;
                }
            })

            return data;
        }

        let data_pangkat = getPangkat();

        // looping pangkat
        $('#pangkat_id').empty();
        $('#pangkat_id').append(
            `<option value="">Pilih Pangkat</option>`
        );
        if (data_pangkat) {
            data_pangkat.forEach(pangkat => {
                $('#pangkat_id').append(
                    `<option value="${pangkat.id}">${pangkat.name}</option>`);
            });
        }

        // looping roles
        let data_roles = getRolesNotUnitKerja();

        $('#role').empty();
        $('#role').append(
            `<option value="">Pilih Role</option>`
        );
        let r_name = '{{ $user->getRoleNames()->first() }}';

        if (data_roles) {
            data_roles.forEach(role => {
                let isSelected = role.name == r_name ? 'selected' : '';
                $('#role').append(
                    `<option ${isSelected} value="${role.id}">${role.name}</option>`);
            });
        }

        // $('#unit_kerja_id').on('change', function() {
        //     let unit_kerja_id = $(this).val();

        //     // get role by unit kerja
        //     let role = getRole(unit_kerja_id);
        //     let role_name = role.role ? role.role.name : 'Tidak Mempunyai Role';
        //     let data_jabatan = getJabatan(unit_kerja_id);
        //     let data_pangkat = getJabatan(unit_kerja_id);

        //     // looping jabatan
        //     $('#jabatan_id').empty();
        //     $('#jabatan_id').append(
        //         `<option value="">Pilih Jabatan</option>`
        //     );
        //     if (data_jabatan) {
        //         data_jabatan.forEach(jabatan => {
        //             $('#jabatan_id').append(
        //                 `<option value="${jabatan.id}">${jabatan.nama}</option>`);
        //         });
        //     }

        //     $('#pangkat_id').empty();
        //     $('#pangkat_id').append(
        //         `<option value="">Pilih Pangkat</option>`
        //     );
        //     if (data_pangkat) {
        //         data_pangkat.forEach(pangkat => {
        //             $('#pangkat_id').append(
        //                 `<option value="${pangkat.id}">${pangkat.name}</option>`);
        //         });
        //     }

        //     $('#role').val(role_name);
        // })

        // get jabatans by unit_kerja id
        let getJabatan = function(unit_kerja_id) {
            let data;
            $.ajax({
                url: '{{ route('jabatans.get-byunitkerja') }}',
                type: 'JSON',
                method: 'GET',
                data: {
                    unit_kerja_id: unit_kerja_id
                },
                async: false,
                success: function(response) {
                    data = response;
                }
            })

            return data;
        }

        let getPangkats = function(unit_kerja_id) {
            let data;
            $.ajax({
                url: '{{ route('pangkat.getByName') }}',
                type: 'JSON',
                method: 'GET',
                data: {
                    unit_kerja_id: unit_kerja_id
                },
                async: false,
                success: function(response) {
                    data = response;
                }
            })

            return data;
        }

        // get role by unit_kerja id
        let getRole = function(unit_kerja_id) {
            let data;
            $.ajax({
                url: '{{ route('roles.get-byunitkerja') }}',
                type: 'JSON',
                method: 'GET',
                data: {
                    unit_kerja_id: unit_kerja_id
                },
                async: false,
                success: function(response) {
                    data = response;
                }
            })

            return data;
        }

        // ketika di load
        let unit_kerja_id = '{{ $user->unit_kerja_id }}';
        let jabatan_id = '{{ $user->jabatan_id }}';
        let pangkat_id = '{{ $user->pangkat_id }}';

        // get role by unit kerja
        let role = getRole(unit_kerja_id);
        // let role_name = role.role ? role.role.name : 'Tidak Mempunyai Role';
        let data_jabatan = getJabatan(unit_kerja_id);
        let data_pangkats = getPangkats(unit_kerja_id);

        // looping jabatan
        $('#jabatan_id').empty();
        $('#jabatan_id').append(
            `<option value="">Pilih Jabatan</option>`
        );
        if (data_jabatan) {
            data_jabatan.forEach(jabatan => {
                let isSelected = jabatan.id == jabatan_id ? 'Selected' : '';
                $('#jabatan_id').append(
                    `<option ${isSelected} value="${jabatan.id}">${jabatan.nama}</option>`);
            });
        }

        $('#pangkat_id').empty();
        $('#pangkat_id').append(
            `<option value="">Pilih Pangkat</option>`
        );
        if (data_pangkats) {
            data_pangkats.forEach(pangkat => {
                let isSelected = pangkat.id == pangkat_id ? 'Selected' : '';
                $('#pangkat_id').append(
                    `<option ${isSelected} value="${pangkat.id}">${pangkat.name}</option>`);
            });
        }

        $('#role').val(role_name);
    })
</script>