<script>
    $(function() {
        $('#get-pelaksana').select2({
            placeholder: 'Pilih Pelaksana Tugas',
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
                    data.unshift({
                        id: '',
                        text: ''
                    });
                    return {
                        results: data
                    };
                },
                cache: true
            },
            minimumResultsForSearch: 0,
        }).on('change', function(e) {
            let data = e.params.data;
            let name = data.name;
            $('#get-pelaksana').val(name).trigger('change');
        });
    });

    function addTujuan() {
        var originalInputs = document.querySelectorAll('.tujuan input');
        var duplicateContainer = document.getElementById('tujuanDuplikat');

        var newInputContainer = document.createElement('div');
        newInputContainer.className = 'row';

        for (var i = 0; i < originalInputs.length; i++) {
            var originalInput = originalInputs[i];

            var newCol = document.createElement('div');
            newCol.className = 'col-md-3 form-group mb-3';

            var newLabel = document.createElement('label');
            newLabel.textContent = originalInput.previousElementSibling.textContent;
            newLabel.className = 'mb-2';

            var newInput = document.createElement('input');
            newInput.id = originalInput.id + "_duplicate" + i;
            newInput.name = originalInput.name;
            newInput.placeholder = originalInput.placeholder;
            newInput.className = originalInput.className;
            newInput.type = originalInput.type;

            newCol.appendChild(newLabel);
            newCol.appendChild(newInput);

            newInputContainer.appendChild(newCol);
        }

        var deleteButton = document.createElement('button');
        deleteButton.className = 'btn btn-sm btn-danger mx-3 mt-2 mb-2';
        deleteButton.textContent = 'Hapus Tujuan';
        deleteButton.onclick = function() {
            duplicateContainer.removeChild(newInputContainer);
        };

        newInputContainer.appendChild(deleteButton);

        duplicateContainer.appendChild(newInputContainer);
    }

    function initializeSelect2(input) {
        $(input).select2({
            placeholder: 'Pilih Pengikut',
            allowClear: true,
            width: "100%",
            minimumResultsForSearch: 0,
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
                    data.unshift({
                        id: '',
                        text: ''
                    });
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
    }

    function createSelectContainer() {
        var container = document.createElement('div');
        container.className = 'col-md-5 form-group mb-3 pengikut';

        var label = document.createElement('label');
        label.className = 'mb-2';
        label.textContent = 'Nama';

        var selectInput = document.createElement('select');
        selectInput.className = 's-tugas get-pengikut input form-control';
        selectInput.setAttribute('name', 'pengikut[]'); // Change to 'pengikut[]'

        container.appendChild(label);
        container.appendChild(selectInput);

        initializeSelect2(selectInput);

        return container;
    }

    function createInputContainer() {
        var container = document.createElement('div');
        container.className = 'col-md-5 form-group mb-3 pengikut';

        var keteranganLabel = document.createElement('label');
        keteranganLabel.className = 'mb-2';
        keteranganLabel.textContent = 'Keterangan Pengikut';

        var keteranganInput = document.createElement('input');
        keteranganInput.className = 's-tugas input form-control';
        keteranganInput.setAttribute('name', 'keterangan_pengikut[]'); // Change to 'keterangan_pengikut[]'
        keteranganInput.setAttribute('placeholder', 'Input Keterangan Pengikut..');
        keteranganInput.setAttribute('type', 'text');

        container.appendChild(keteranganLabel);
        container.appendChild(keteranganInput);

        return container;
    }

    function addPengikut() {
        var duplicateContainer = document.getElementById('duplicateInputsContainer');
        var newInputContainer = document.createElement('div');
        newInputContainer.className = 'row';

        var selectContainer = createSelectContainer();
        var inputContainer = createInputContainer();

        newInputContainer.appendChild(selectContainer);
        newInputContainer.appendChild(inputContainer);

        var deleteButton = document.createElement('button');
        deleteButton.className = 'btn btn-sm btn-danger mt-4 mb-2';
        deleteButton.textContent = 'Hapus Pengikut';
        deleteButton.onclick = function() {
            duplicateContainer.removeChild(newInputContainer);
        };

        newInputContainer.appendChild(deleteButton);
        duplicateContainer.appendChild(newInputContainer);
    }


    initializeSelect2('.get-pengikut');
</script>
