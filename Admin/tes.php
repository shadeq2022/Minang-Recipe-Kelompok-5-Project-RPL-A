<?php
include("../dbConnection.php");

$msg = ''; // Pesan status operasi

if (isset($_REQUEST['updateResepBtn'])) {
    // Ambil resep_id dari URL parameter
    $resep_id_to_update = $_POST['id-resep'];

    // Ambil data dari formulir
    $title = $_POST['title'];
    $author = $_POST['author'];
    $deskripsi = $_POST['deskripsi'];
    $durasi = $_POST['durasi'];
    $daerah_asal = $_POST['daerah_asal'];
    $harga = $_POST['harga'];
    $url_vidio = $_POST['url_vidio'];
    $alat_bahan = $_POST['alat_bahan'];
    $langkah_nama = $_POST['langkah_nama'];
    $thumbnail = $_FILES['thumbnail'];

    // ... Validasi dan manipulasi data

    // Update resep berdasarkan data yang diberikan
    $update_query = "UPDATE resep SET title = '$title', author = '$author', deskripsi = '$deskripsi', durasi = '$durasi', daerah_asal = '$daerah_asal', harga = '$harga', url_vidio = '$url_vidio', thumbnail = '$thumbnail_destination' WHERE resep_id = $resep_id_to_update";

    $update_result = mysqli_query($conn, $update_query);

    if ($update_result) {
        // Proses update alat bahan dan langkah membuat

        // Set pesan berhasil atau redirect ke halaman sukses
        $msg = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check"></i> <strong>Sukses!  </strong>Resep berhasil diperbarui!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    } else {
        // Handle kesalahan update
        $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa fa-ban"></i> <strong>Gagal!  </strong>Gagal memperbarui resep!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    }
}

// Dapatkan data resep untuk pre-fill formulir
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $resep_id_to_edit = $_GET['id']; // Mendapatkan resep_id dari parameter URL

    // Ambil detail resep dari database berdasarkan $resep_id_to_edit
    $fetch_query = "SELECT * FROM resep WHERE resep_id = $resep_id_to_edit";
    $result = mysqli_query($conn, $fetch_query);
    $recipe_data = mysqli_fetch_assoc($result);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/css/main.min.css">
  <link rel="stylesheet" href="../assets/css/font-awesmome/css/all.css">
  <link rel="stylesheet" href="../assets/css/home.css">
  <link rel="stylesheet" href="../preview/style-prev.css">
  <title>Minang Recipe</title>
</head>

<body>

<style>
  .navbar-brand img {
    margin-left: 12px;
    max-width: 260px;
  }
</style>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg sticky-top">
  <a class="navbar-brand me-auto" href="adminDashboard.php">
    <img src="../assets/img/logoadminnew.png">
  </a>
</nav>
  <!-- END -->

  <style>

  .custom-link a {
    text-decoration: none;
  }

  .custom-link a:hover {
    text-decoration: underline;
  }
  .nav-link{
    color: black;
  }

  .strong-pri{
      color: #AA6514; 
  }

  .geser {
    margin-left: 30px;
  }

  hr {
  border: none; /* Menghilangkan garis bawaan */
  border-bottom: 2px solid #AA6514; /* Mengatur garis bawah dengan ketebalan 2px dan warna hitam (#000) */
  margin: 10px 0; /* Memberi sedikit ruang di atas dan di bawah garis */
  }

</style>
<main class="d-flex flex-nowrap">
        <div class="container-fluid mt-4 px-5" id="container-wrapper"> 
            <div class="row mb-3">
                <div class="col-lg-12 mb-4 text-center">
                    <h2 class="font-weight-bold text-primary">Edit Resep</h2>
                </div>
                <div class="col-lg-12">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <?php
                        if ($recipe_data) {
                            // Prefill form fields with retrieved data
                            ?>
                            <div class="form-group">
                                <input type="text" class="form-control mb-3" name="title" id="title" required value="<?= htmlspecialchars($recipe_data['title'] ?? ''); ?>">
                                <input type="text" class="form-control mb-3" name="author" id="author" required value="<?= htmlspecialchars($recipe_data['author'] ?? ''); ?>">
                                <!-- Input untuk deskripsi -->
                                <textarea class="form-control mb-3" name="deskripsi" id="deskripsi" rows="3" required><?= htmlspecialchars($recipe_data['deskripsi'] ?? ''); ?></textarea>
                                <!-- Input untuk durasi -->
                                <input type="number" class="form-control mb-3" name="durasi" id="durasi" required value="<?= htmlspecialchars($recipe_data['durasi'] ?? ''); ?>">
                                <!-- Input untuk daerah asal -->
                                <input type="text" class="form-control mb-3" name="daerah_asal" id="daerah_asal" required value="<?= htmlspecialchars($recipe_data['daerah_asal'] ?? ''); ?>">
                                <!-- Input untuk harga -->
                                <input type="number" class="form-control mb-3" name="harga" id="harga" required value="<?= htmlspecialchars($recipe_data['harga'] ?? ''); ?>">
                                <!-- Input hidden untuk tipe -->
                                <input type="hidden" name="tipe" id="tipe" value="ori"> 
                                </div>
                            <?php
                        } else {
                            echo "No recipe found for this ID.";
                        }
                        ?>

                    <!-- Alat dan Bahan -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-info">
                        <h6 class="m-0 font-weight-bold text-white">Alat dan Bahan</h6>
                    </div>
                    <div class="form-group p-3">
                        <ul id="alat_bahan_list">
                            <?php
                            if ($recipe_data && isset($recipe_data['alat_bahan']) && !empty($recipe_data['alat_bahan'])) {
                                $alat_bahan = explode(',', $recipe_data['alat_bahan']);
                                foreach ($alat_bahan as $item) {
                                    echo '<li><input type="text" class="form-control mb-3" name="alat_bahan[]" placeholder="Masukkan alat atau bahan" required value="' . htmlspecialchars($item) . '"></li>';
                                }
                            } else {
                                echo '<li><input type="text" class="form-control mb-3" name="alat_bahan[]" placeholder="Masukkan alat atau bahan" required></li>';
                            }
                            ?>
                        </ul>
                        <button type="button" class="btn btn-primary geser" id="add_alat_bahan">Tambah</button>
                    </div>

                    <!-- Langkah Membuat -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-info">
                        <h6 class="m-0 font-weight-bold text-white">Langkah Membuat</h6>
                    </div>
                    <div class="form-group p-3">
                        <ol id="langkah_list">
                            <?php
                            if ($recipe_data && isset($recipe_data['langkah_nama']) && !empty($recipe_data['langkah_nama'])) {
                                $langkah_nama = explode(',', $recipe_data['langkah_nama']);
                                foreach ($langkah_nama as $item) {
                                    echo '<li><input type="text" class="form-control mb-3" name="langkah_nama[]" placeholder="Tuliskan step disini" required value="' . htmlspecialchars($item) . '"></li>';
                                }
                            } else {
                                echo '<li><input type="text" class="form-control mb-3" name="langkah_nama[]" placeholder="Tuliskan step disini" required></li>';
                            }
                            ?>
                        </ol>
                        <button type="button" class="btn btn-primary geser" id="add_langkah">Tambah Langkah</button>
                    </div><!-- URL Vidio -->
<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-info">
    <h6 class="m-0 font-weight-bold text-white">Url Vidio</h6>
</div>
<div class="form-group p-3">
    <!-- Prefilled input untuk URL video (jika ada data yang diambil dari database) -->
    <input type="text" class="form-control mb-3" name="url_vidio" id="url_vidio" placeholder="Tempelkan url vidio disini" required value="<?php echo isset($recipe_data['url_vidio']) ? htmlspecialchars($recipe_data['url_vidio']) : ''; ?>">
</div>

<div class="card-footer text-center">
    <button type="submit" class="btn btn-primary mt-4 mb-3" id="resepSubmitBtn" name="resepSubmitBtn">Simpan</button>
    <a href="kelolaResep.php" class="btn btn-outline-primary mt-4 mb-3 ">Kembali</a>
</div>

</form>
</div>
</div>
</div>
</main>

<!-- Footer -->
<footer class="text-center p-3 bg-body-tertiary">
    <div>Copyright 2023 || Kelompok 5 RPL</div>
</footer>

<!-- Scripts -->
<script src="../assets/js/jquery-3.7.1.min.js"></script>
<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/all.min.js"></script>
<script src="../assets/js/ajaxrequest.js?v=<?php echo time();?>"></script>
<script src="../assets/js/adminajaxrequest.js?v=<?php echo time();?>"></script>
<script src="../preview/script-prev.js"></script>
<script>
    $(document).ready(function () {
        // Fungsi tambah alat bahan
        $('#add_alat_bahan').click(function () {
            var ul = $('#alat_bahan_list');
            var li = $('<li><input type="text" class="form-control" name="alat_bahan[]" placeholder="Masukkan alat dan bahan"> <button type="button" class="btn btn-danger mt-3 remove-alat-bahan">Remove</button></li>');
            ul.append(li);
        });

        // Buton remove pada alat bahan
        $(document).on('click', '.remove-alat-bahan', function () {
            $(this).parent().remove();
        });
    });
</script>
</body>
</html>

<?
if (isset($_REQUEST['updateResepBtn'])) {
    // Retrieve the resep_id from the URL parameter
    $resep_id_to_update = $_GET['id']; // Assuming the resep_id is passed in the URL

    // Retrieve form data for updating the recipe
    $title = $_POST['title'];
    $author = $_POST['author'];
    // ... (retrieve other form fields)

    // Update query to update the recipe based on resep_id
    $update_query = "UPDATE resep SET title = '$title', author = '$author', 
                     deskripsi = '{$_POST['deskripsi']}', durasi = '{$_POST['durasi']}', 
                     daerah_asal = '{$_POST['daerah_asal']}', harga = '{$_POST['harga']}', 
                     url_vidio = '{$_POST['url_vidio']}' WHERE resep_id = $resep_id_to_update";

    // Execute the update query
    $update_result = mysqli_query($conn, $update_query);

    if ($update_result) {
        // Update success, handle other fields like alat bahan and langkah membuat

        // Process Alat dan Bahan updates
        $alat_bahan = $_POST['alat_bahan'];
        // Delete existing Alat Bahan data for the recipe
        $delete_alat_bahan_query = "DELETE FROM alat_bahan WHERE resep_id = $resep_id_to_update";
        mysqli_query($conn, $delete_alat_bahan_query);

        // Insert updated Alat Bahan data
        foreach ($alat_bahan as $item) {
            $insert_alat_bahan_query = "INSERT INTO alat_bahan (resep_id, item) VALUES ($resep_id_to_update, '$item')";
            mysqli_query($conn, $insert_alat_bahan_query);
        }

        // Process Langkah Membuat updates
        $langkah_nama = $_POST['langkah_nama'];
        $langkah_gambar = $_FILES['langkah_gambar'];

        // Delete existing Langkah Membuat data for the recipe
        $delete_langkah_query = "DELETE FROM langkah WHERE resep_id = $resep_id_to_update";
        mysqli_query($conn, $delete_langkah_query);

        // Insert updated Langkah Membuat data
        for ($i = 0; $i < count($langkah_nama); $i++) {
            $langkah_gambar_name = $langkah_gambar['name'][$i];
            $langkah_gambar_tmp = $langkah_gambar['tmp_name'][$i];
            $langkah_gambar_destination = '../preview/upload/' . $langkah_gambar_name;

            move_uploaded_file($langkah_gambar_tmp, $langkah_gambar_destination);

            $insert_langkah_query = "INSERT INTO langkah (resep_id, nama, gambar) VALUES ($resep_id_to_update, '{$langkah_nama[$i]}', '$langkah_gambar_destination')";
            mysqli_query($conn, $insert_langkah_query);
        }

        // Set success message or redirect to success page
        $msg = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check"></i> <strong>Sukses!  </strong>Resep berhasil diperbarui!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    } else {
        // Update failed, handle error
        $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa fa-ban"></i> <strong>Gagal!  </strong>Gagal memperbarui resep!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    }
}
