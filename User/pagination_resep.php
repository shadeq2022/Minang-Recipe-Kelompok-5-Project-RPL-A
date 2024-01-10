<?php
session_start(); // Mulai session
$limit = $_GET['limit']; // Ambil limit dari parameter GET

// Pastikan session usLogemail tersedia dan bukan data yang dikendalikan pengguna
if (isset($_SESSION['usLogemail'])) {
    $usLogemail = $_SESSION['usLogemail'];

    // Koneksi ke database dan perhitungan jumlah halaman
    include('./dbConnection.php');

    // Gunakan parameterized query untuk menghindari SQL Injection
    $sqlTotal = "SELECT COUNT(*) as total FROM resep r 
                 INNER JOIN user u ON r.us_id = u.us_id 
                 WHERE r.tipe = 'umum' AND u.us_email = ?";
    $stmt = $conn->prepare($sqlTotal);
    $stmt->bind_param("s", $usLogemail);
    $stmt->execute();
    $resultTotal = $stmt->get_result();
    $rowTotal = $resultTotal->fetch_assoc();
    $totalRecords = $rowTotal['total'];
    $totalPages = ceil($totalRecords / $limit);

    // Tampilkan paginasi dalam format HTML
    echo '<nav aria-label="Page navigation example">';
    echo '<ul class="pagination">';
    for ($i = 1; $i <= $totalPages; $i++) {
        echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
    }
    echo '</ul>';
    echo '</nav>';

    $conn->close();
} else {
    // Jika session usLogemail tidak tersedia
    echo "Session usLogemail tidak ditemukan.";
}
?>
