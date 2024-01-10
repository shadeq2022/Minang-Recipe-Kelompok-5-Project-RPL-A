<?php
// Koneksi ke database
include('./dbConnection.php');

// Ambil kategori yang dipilih dari POST
$category = $_POST['category'];

// Menentukan halaman yang diminta oleh pengguna
$page = isset($_POST['page']) && !empty($_POST['page']) ? $_POST['page'] : 1;
$limit = 6; // Jumlah resep per halaman
$offset = ($page - 1) * $limit;

// Query untuk menghitung jumlah total resep berdasarkan kategori
if ($category === 'all') {
    $sql = "SELECT COUNT(*) as total FROM resep";
} else {
    $sql = "SELECT COUNT(*) as total FROM resep WHERE tipe = '$category'";
}

$result = $conn->query($sql);
$row = $result->fetch_assoc();
$totalResults = $row['total'];
$totalPages = ceil($totalResults / $limit);

$response = array(
    'totalPages' => $totalPages
);

// Mengirimkan respons sebagai JSON
header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>

