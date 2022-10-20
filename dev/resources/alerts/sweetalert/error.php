<?php
if ($this->flash('swal_error')!=null){
    print "<script>
            $(document).ready(function () {
                Swal.fire({
                    icon: 'error',
                    title: 'ناموفق',
                    text: '{$this->flash('swal_error')}',
                    showConfirmButton: false,
                    timer: 5000
                });
            });
        </script>";
}
?>