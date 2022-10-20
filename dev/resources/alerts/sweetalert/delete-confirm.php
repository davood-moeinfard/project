<script>
    $(document).ready(function () {
        $('#form').click(function (e) {
            e.preventDefault();
            const Toast = Swal.mixin({
                customClass: {
                    popup:'w-25',
                    confirmButton: 'btn btn-success mx-2',
                    cancelButton: 'btn btn-danger mx-2'
                },
                buttonsStyling:false,
            })
            Toast.fire({
                title: 'آیا مطمئن هستید؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'خیر',
                confirmButtonText: 'بله ، حذف نمائید؟',
                reverseButtons: true
            }).then((result) => {
                if (result.value==true) {
                    $(this).submit();
                }
            });
        });
    });
</script>

