<?php
include('./dbConnection.php');
function ribuan($nilai)
{
    return number_format($nilai, 0, ',', '.');
}

// Ambil kategori dan halaman dari POST
$category = $_POST['category'];
$page = isset($_POST['page']) && !empty($_POST['page']) ? $_POST['page'] : 1;
$limit = 6; // Jumlah resep per halaman
$offset = ($page - 1) * $limit;

// Query untuk mengambil data resep berdasarkan kategori dan paginasi dengan JOIN ke tabel user
if ($category === 'all') {
    $sql = "SELECT r.*, u.us_name FROM resep r LEFT JOIN user u ON r.us_id = u.us_id LIMIT $limit OFFSET $offset";
} else {
    $sql = "SELECT r.*, u.us_name FROM resep r LEFT JOIN user u ON r.us_id = u.us_id WHERE r.tipe = '$category' LIMIT $limit OFFSET $offset";
}

$result = $conn->query($sql);

// Tampilkan data dalam format HTML (kartu resep)
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo generateRecipeCardAll($row); // Memanggil fungsi untuk membuat kartu resep
    }
} else {
    echo '<div style="display: flex; justify-content: center; align-items: center; height: 200px; margin-left: 330px; flex-direction: column; text-align: center;">';
    echo '<a href="https://storyset.com/data">';
    echo '<img src="./preview/upload/No data-amico.svg" alt="No Data Found" class="your-class" id="your-id" style="width: 200px; height: 200px;">';
    echo '</a>';
    echo '<div style="margin-top: 10px;">Tidak ada data ditemukan.</div>';
    echo '</div>';
}

// Fungsi untuk membuat kartu resep dengan informasi pengguna (us_name)
// Fungsi untuk membuat kartu resep dengan informasi pengguna (us_name atau author)
function generateRecipeCardAll($data) {
    $output = '<div class="col">';
    $output .= '<div class="card h-100">';
    $output .= '<div class="img-wrapper"><img src="' . str_replace('..', '.', $data['thumbnail']) . '" class="d-block w-100" alt=""></div>';
    $output .= '<div class="card-body">';
    $output .= '<h5 class="card-title">' . $data['title'] . '</h5>';
    $output .= '<span class="badge rounded-pill text-bg-secondary" style="margin-right: 6px;">' . $data['durasi'] . ' Menit</span>';
    $output .= '<span class="badge rounded-pill text-bg-secondary" style="margin-right: 6px;">' . $data['daerah_asal'] . '</span>';
    if ($data['tipe'] === 'ori') {
        $output .= '<span class="badge rounded-pill text-bg-warning text-white">ori</span>';
        $output .= '<p class="card-text"> Author: ' . $data['author'] . '</p>'; // Menampilkan 'author' untuk tipe 'ori'
    } else {
        $output .= '<p class="card-text"> Author: ' . $data['us_name'] . '</p>'; // Menampilkan 'us_name' untuk tipe lainnya
    }
    $output .= '<div class="card-footer">';
    $output .= '<div class="row">';

    if ($data['tipe'] === 'umum') {
        // Jika tipe resep adalah 'umum', tambahkan logika khusus untuk tipe umum
        $output .= '<a href="./tampilResepUmum.php?id-resep=' . $data['resep_id'] . '" class="btn btn-primary d-grid gap-4 col-11 mx-auto"> Lihat </a>';
    } elseif ($data['tipe'] === 'ori') {
        // Jika tipe resep adalah 'ori', tambahkan logika khusus untuk tipe ori
        $output .= '<h5 class="card-title col-9" style="margin-top: auto;">Rp. ' . ribuan($data['harga']) . '</h5>';
        $output .= '<a href="beliResep.php?id-resep=' . $data['resep_id'] . '" class="btn btn-primary d-grid gap-4 col-3 mx-auto">Beli</a>';
    } else {
        // Handle jika ada tipe lainnya (opsional)
        $output .= '<p>Tipe resep tidak valid</p>';
    }

    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';

    return $output;
}


$conn->close();
?>
