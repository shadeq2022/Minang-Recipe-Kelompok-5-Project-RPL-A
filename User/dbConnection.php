<?php
$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "minang_recipe";

//koneksi
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

//cek koneksi
if($conn->connect_error) {
    die("Koneksi Gagal");
}
//   else {
//    echo"Koneksi Berhasil";  
//  }
?>