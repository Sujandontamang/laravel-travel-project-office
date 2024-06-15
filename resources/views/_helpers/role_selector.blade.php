<script>
    $(document).ready(function () {
        window._token = $('meta[name="csrf-token"]').attr('content')

        $('.select-all').click(function () {
            let $select2 = $(this).parent().siblings('.select2')
            $select2.find('option').prop('selected', 'selected')
            $select2.trigger('change')
        })
        $('.deselect-all').click(function () {
            let $select2 = $(this).parent().siblings('.select2')
            $select2.find('option').prop('selected', '')
            $select2.trigger('change')
        })
        $('.select2').select2({
            allowClear: true,
            placeholder: 'Select Permissions'
        });
    })

</script>
