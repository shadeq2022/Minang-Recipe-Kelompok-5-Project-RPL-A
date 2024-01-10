<?php

include "dbConnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari formulir
    $usname = $_POST['usname'];
    $usemail = $_POST['usemail'];
    $uspass = $_POST['uspass'];

    $sql = "INSERT INTO `user` (`us_name`, `us_email`, `us_pass`) VALUES ('$usname', '$usemail', '$uspass')";

    if ($conn->query($sql) === TRUE) {
       echo '<script src="assets/js/sweetalert2.js"></script>';
       echo '<script type="text/javascript">
            window.onload = function() {
                Swal.fire({
                    title: "Registrasi berhasil!",
                    icon: "success",
                    text: "Silahkan melakukan login!",
                    confirmButtonText: "OK"
                }).then(function() {
                    window.location = "'.$_SERVER['HTTP_REFERER'].'"; 
                });
            }
        </script>';
    exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Tutup koneksi
$conn->close();
?>
