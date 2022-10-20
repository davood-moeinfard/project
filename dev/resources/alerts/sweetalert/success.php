<?php
if ($this->flash('swal_success')!=null){
    print "<script>
            $(document).ready(function () {
                Swal.fire({
                    icon: 'success',
                    title: 'موفق',
                    text: '{$this->flash('swal_success')}',
                    showConfirmButton: false,
                    timer: 5000
                });
            });
        </script>";
}
?>
