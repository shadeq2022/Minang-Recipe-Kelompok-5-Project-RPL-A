<?php
session_start();

// Koneksi ke database
include('../dbConnection.php');


$limit = $_GET['limit']; // Ambil limit dari parameter GET
$page = $_GET['page']; // Ambil halaman dari parameter GET

$start = ($page - 1) * $limit;


if (isset($_SESSION['usLogemail'])) {
    $usEmail = $_SESSION['usLogemail'];
    $userQuery = "SELECT us_id, us_name FROM user WHERE us_email = '$usEmail'";
    $userResult = $conn->query($userQuery);

    if ($userResult && $userResult->num_rows > 0) {
        $userRow = $userResult->fetch_assoc();
        $us_id = $userRow['us_id'];
        $us_name = $userRow['us_name'];

        // Ambil resep milik pengguna dengan us_id tertentu
        $sql = "SELECT * FROM resep WHERE tipe = 'umum' AND us_id = $us_id LIMIT $start, $limit";
        $result = $conn->query($sql);

        // Tampilkan data dalam format HTML (kartu resep)
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo showCard($row,  $us_name); // Memanggil fungsi 
            }
        } else {
            echo '<div style="display: flex; justify-content: center; align-items: center; height: 200px; margin-left: 390px; flex-direction: column; text-align: center;">';
            echo '<a href="https://storyset.com/data">';
            echo '<img src="../preview/upload/No data-amico.svg" alt="No Data Found" class="your-class" id="your-id" style="width: 200px; height: 200px;">';
            echo '</a>';
            echo '<div style="margin-top: 10px;">Belum ada resep, ayo upload resep mu!</div>';
            echo '</div>';
        }
    } else {
        echo "User tidak ditemukan.";
    }
} else {
    echo "Sesi usemail tidak tersedia.";
}

$conn->close();
function showCard($data, $us_name) {
    $output = '<div class="col">';
    $output .= '<div class="card h-100 position-relative">';
    $output .= '<div class="dropdown position-absolute" style="top: 0; right: 0;">';
    $output .= '<button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">';
    $output .= '<i class="fas fa-ellipsis-h"></i>';
    $output .= '</button>';
    $output .= '<ul class="dropdown-menu dropdown-menu-end">';
    $output .= '<li><a class="dropdown-item" href="./editResepUmum.php?id-resep=' . $data['resep_id'] . '">Edit</a></li>';
    $output .= '<li><form method="post" action="">'; // Form untuk mengirim permintaan hapus
    $output .= '<input type="hidden" name="id-resep" value="' . $data['resep_id'] . '">';
    $output .= '<button class="dropdown-item text-danger" type="submit" name="delete-ori">Hapus</button>'; // Tombol Hapus
    $output .= '</form></li>';
    $output .= '</ul>';
    $output .= '</div>';
    
    $output .= '<div class="img-wrapper"><img src="'. $data['thumbnail'] . '" class="d-block w-100" alt=""></div>';
    $output .= '<div class="card-body">';
    $output .= '<h5 class="card-title">' . $data['title'] . '</h5>';

    $output .= '<p class="card-text"> Author: ' . $us_name . '</p>';
    
    $output .= '<div class="card-footer">';
    $output .= '<div class="row">';
    $output .= '<a href="../tampilResepUmum.php?id-resep=' . $data['resep_id'] . '" class="btn btn-primary d-grid gap-4 col-11 mx-auto"> Lihat </a>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';

    return $output;
}


?>