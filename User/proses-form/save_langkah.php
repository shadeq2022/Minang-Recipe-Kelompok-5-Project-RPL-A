<?php
include('../../dbConnection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $langkah_nama = $_POST['langkah_nama'];
    $langkah_id = $_POST['langkah_id'];
    $gambar_path = $_POST['gambar_path'];
    $resep_id = $_REQUEST['id-resep']; // Ganti dengan cara yang sesuai untuk mendapatkan ID resep

    for ($i = 0; $i < count($langkah_nama); $i++) {
        $nama = $langkah_nama[$i];
        $id = $langkah_id[$i];
        $gambar = $gambar_path[$i];

        if (empty($id)) {
            // Jika ID kosong, lakukan INSERT
            $insert_langkah_query = "INSERT INTO langkah (resep_id, nama, gambar) VALUES ($resep_id, '$nama', '$gambar')";
            mysqli_query($conn, $insert_langkah_query);
        } else {
            // Jika ID tidak kosong, lakukan UPDATE
            $update_langkah_query = "UPDATE langkah SET nama = '$nama', gambar = '$gambar' WHERE id_langkah = $id";
            mysqli_query($conn, $update_langkah_query);
        }
    }
    echo "Langkah-langkah berhasil disimpan!";
}

?>
