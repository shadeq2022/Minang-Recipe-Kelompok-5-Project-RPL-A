<?php 
session_start();
session_destroy();
echo '<script src="assets/js/sweetalert2.js"></script>';
       echo '<script type="text/javascript">
            window.onload = function() {
                Swal.fire({
                    title: "Berhasil Keluar",
                    icon: "success",
                    confirmButtonText: "OK"
                }).then(function() {
                    location.href="index.php"; 
                });
            }
        </script>';
?>