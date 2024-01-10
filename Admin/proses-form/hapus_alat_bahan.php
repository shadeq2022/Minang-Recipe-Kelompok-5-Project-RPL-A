<?php
// Lakukan koneksi ke database di sini
include('../../dbConnection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Periksa jika item dan ID resep dikirim dari AJAX
    if(isset($_POST['item']) && isset($_POST['resep_id'])){
        $item = $_POST['item'];
        $resepId = $_POST['resep_id'];

        // Lakukan query DELETE untuk menghapus item dari tabel alat_bahan
        $sql = "DELETE FROM alat_bahan WHERE resep_id = $resepId AND item = '$item'";
        
        if ($conn->query($sql) === TRUE) {
            echo "Item berhasil dihapus!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>