<script>
    $(function() {
        $('#category_id').select2({
            placeholder: 'Pilih Kategori Surat',
            allowClear: true,
            width: "100%",
            ajax: {
                url: '{{ route('getCategory') }}',
                dataType: 'json',
                delay: 220,
                data: function(params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            minimumResultsForSearch: 0,
        }).on('change', function(e) {
            let data = e.params.data.name;
            $('#category_id').val(data).trigger('change');
        });

        $('#get-user').select2({
            placeholder: 'Pilih User',
            allowClear: true,
            width: "100%",
            ajax: {
                url: '{{ route('getUser') }}',
                dataType: 'json',
                delay: 220,
                data: function(params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            minimumResultsForSearch: 0,
        }).on('change', function(e) {
            let data = e.params.data.name;
            $('#get-user').val(data).trigger('change');
        });

        $('#get-tembusan').select2({
            placeholder: 'Pilih Tembusan Surat',
            allowClear: true,
            width: "100%",
            ajax: {
                url: '{{ route('getUser') }}',
                dataType: 'json',
                delay: 220,
                data: function(params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            minimumResultsForSearch: 0,
        }).on('change', function(e) {
            let data = e.params.data;
            let id = data.id;
            $('#get-tembusan').val(id).trigger('change');
        });
    });
</script>
