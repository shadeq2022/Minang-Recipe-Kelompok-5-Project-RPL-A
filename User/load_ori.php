<?php
session_start();

include('../dbConnection.php');
function ribuan($nilai)
{
    return number_format($nilai, 0, ',', '.');
}

$limit = $_GET['limit'];
$page = $_GET['page'];

$start = ($page - 1) * $limit;

if (isset($_SESSION['usLogemail'])) {
    $usEmail = $_SESSION['usLogemail'];
    $userQuery = "SELECT us_id, us_name FROM user WHERE us_email = '$usEmail'";
    $userResult = $conn->query($userQuery);

    if ($userResult && $userResult->num_rows > 0) {
        $userRow = $userResult->fetch_assoc();
        $us_id = $userRow['us_id'];

        $sql = "SELECT resep.*, 
               user.*
        FROM orderan 
        INNER JOIN resep ON orderan.resep_id = resep.resep_id 
        INNER JOIN user ON orderan.us_id = user.us_id 
        WHERE resep.tipe = 'ori' AND orderan.us_id = $us_id
        LIMIT $start, $limit";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo showCard($row);
            }
        } else {
            echo '<div style="display: flex; justify-content: center; align-items: center; height: 200px; margin-left: 390px; flex-direction: column; text-align: center;">';
            echo '<a href="https://storyset.com/data">';
            echo '<img src="../preview/upload/No data-amico.svg" alt="No Data Found" class="your-class" id="your-id" style="width: 200px; height: 200px;">';
            echo '</a>';
            echo '<div style="margin-top: 10px;">Belum ada resep yang diorder, ayo order sekarang!</div>';
            echo '</div>';
        }
    } else {
        echo "User tidak ditemukan.";
    }
} else {
    echo "Sesi usemail tidak tersedia.";
}

function showCard($data)
{
    $output = '<div class="col">';
    $output .= '<div class="card h-100">';
    $output .= '<div class="img-wrapper"><img src="' . $data['thumbnail'] . '" class="d-block w-100" alt=""></div>';
    $output .= '<div class="card-body">';
    $output .= '<h5 class="card-title">' . $data['title'] . '</h5>';
    $output .= '<span class="badge rounded-pill text-bg-secondary" style="margin-right: 6px;">' . $data['durasi'] . ' Menit</span>';
    $output .= '<span class="badge rounded-pill text-bg-secondary" style="margin-right: 6px;">' . $data['daerah_asal'] . '</span>';
    if ($data['tipe'] === 'ori') {
        $output .= '<span class="badge rounded-pill text-bg-warning text-white">ori</span>';
        $output .= '<p class="card-text"> Author: ' . $data['author'] . '</p>';
        $output .= '<a href="./tampilResepOri.php?id-resep=' . $data['resep_id'] . '" class="btn btn-primary d-grid gap-4 col-11 mx-auto"> Lihat </a>';
    } else {
        // Jika tipe bukan 'ori', tidak menampilkan kartu resep
        $output .= '<p class="card-text">Resep ini bukan tipe ori.</p>';
        $output = ''; // Kosongkan output agar tidak menampilkan kartu resep
    }
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';

    return $output;
}

$conn->close(); // Tutup koneksi di bagian akhir
?>
