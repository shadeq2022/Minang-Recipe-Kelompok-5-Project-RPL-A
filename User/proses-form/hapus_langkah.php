<?php
include('../../dbConnection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['resep_id']) && isset($_POST['langkah_id'])){
        $resepId = $_POST['resep_id'];
        $langkahId = $_POST['langkah_id'];

        $delete_query = "DELETE FROM langkah WHERE resep_id = $resepId AND id_langkah = $langkahId";
        if ($conn->query($delete_query) === TRUE) {
            echo "Langkah berhasil dihapus!";
        } else {
            echo "Error: " . $delete_query . "<br>" . $conn->error;
        }
    }
}
?>
