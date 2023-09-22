<script>
    $(document).ready(function() {
        CKEDITOR.replace('visum_umum', {
            toolbar: 'Full'
        });
        CKEDITOR.replace('spd', {
            toolbar: 'Full'
        });
        CKEDITOR.replace('body', {
            toolbar: 'Full'
        });
        CKEDITOR.allowedContent = true;
        CKEDITOR.extraAllowedContent = 'td(*)';

        $("body").on("click", ".rowDelete", function() {
            $(this).parents("#row").remove();
        });

        $('#kepada_id').on('change', function() {
            let kepada = $(this).val();

            $('.kepada-uu').removeAttr('name');
            if (kepada === 'unit') {
                $('.unit-kerja').removeClass('d-none');

                $('.unit-kerja-id').attr('name', 'to_unit_kerja_id');
            } else {
                $('.unit-kerja').addClass('d-none');
            }
            if (kepada === 'personal') {
                $('.personal').removeClass('d-none');

                $('.personal-id').attr('name', 'to_user_id');
            } else {
                $('.personal').addClass('d-none');
            }
        });

        $('#category_id').on('change', function() {
            let category = $(this).val();
            let category_split = category.split('-');
            let category_name = category_split[1].toLowerCase();

            $('#body').removeAttr('name');
            if (category_name === 'surat tugas') {
                $('.d-cat-tugas').removeClass('d-none');
            } else {
                $('.d-cat-tugas').addClass('d-none');
            }

            if (category_name === 'surat keterangan') {
                $('.d-cat-keterangan').removeClass('d-none');
                CKEDITOR.replace('s-keterangan', {
                    toolbar: 'Full'
                });
                $('.s-keterangan').attr('name', 'body');
            } else {
                $('.d-cat-keterangan').addClass('d-none');
            }

            if (category_name === 'surat pernyataan') {
                $('.d-cat-pernyataan').removeClass('d-none');
                CKEDITOR.replace('s-pernyataan', {
                    toolbar: 'Full'
                });
                $('.s-pernyataan').attr('name', 'body');
            } else {
                $('.d-cat-pernyataan').addClass('d-none');
            }

            if (category_name === 'surat undangan') {
                $('.d-cat-undangan').removeClass('d-none');
                CKEDITOR.replace('s-undangan', {
                    toolbar: 'Full'
                });
                $('.s-undangan').attr('name', 'body');
            } else {
                $('.d-cat-undangan').addClass('d-none');
            }

            if (category_name === 'surat pengumuman') {
                $('.d-cat-pengumuman').removeClass('d-none');
                CKEDITOR.replace('s-pengumuman', {
                    toolbar: 'Full'
                });
                $('.s-pengumuman').attr('name', 'body');
            } else {
                $('.d-cat-pengumuman').addClass('d-none');
            }

            if (category_name === 'surat edaran') {
                $('.d-cat-edaran').removeClass('d-none');
                CKEDITOR.replace('s-edaran', {
                    toolbar: 'Full'
                });
                $('.s-edaran').attr('name', 'body');
            } else {
                $('.d-cat-edaran').addClass('d-none');
            }

            if (category_name === 'surat umum') {
                $('.d-cat-umum').removeClass('d-none');
                CKEDITOR.replace('s-umum', {
                    toolbar: 'Full'
                });
                $('.s-umum').attr('name', 'body');
            } else {
                $('.d-cat-umum').addClass('d-none');
            }


        });
    });
</script>
