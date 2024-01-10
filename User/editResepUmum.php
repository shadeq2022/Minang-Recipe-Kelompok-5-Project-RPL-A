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
  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg sticky-top">
    <a class="navbar-brand me-auto" href="../index.php">
      <img src="../assets/img/logo-user-profil.png"></a>
    <div class="container">

      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvass-title" id="offcanvasNavbarLabel"><img src="../assets/img/Minang Recipe.png"></h5>
          <button type="button" class="btn-close shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link mx-lg-3" href="../index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-3" href="../resep-utama.php">Resep</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-" href="../bantuan.php">Bantuan</a>
            </li>
          </ul>
        </div>
      </div>

      <div><a href="userProfil.php" class="btn btn-outline-primary mx-lg">Profil Saya</a>
        <a href="../logout.php" class="btn btn-primary mx-lg-2">Keluar</a>
      </div>';

      <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </nav>

  <!-- END -->

  <style>
    .custom-link a {
      text-decoration: none;
    }

    .custom-link a:hover {
      text-decoration: underline;
    }

    .nav-link {
      color: black;
    }

    .strong-pri {
      color: #AA6514;
    }

    .geser {
      margin-left: 30px;
    }

    hr {
      border: none;
      border-bottom: 2px solid #AA6514;
      margin: 10px 0;
    }
  </style>
<?php
if(!isset($_SESSION)){
    session_start();
    }
    include("../dbConnection.php");
    if (isset($_SESSION['is_login'])) {
        $usEmail = $_SESSION['usLogemail'];
    
        $sql = "SELECT * FROM user WHERE us_email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $usEmail);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows == 1) {
          $row = $result->fetch_assoc();
          $usId = $row["us_id"];
          $usName = $row["us_name"];
          $usOcc = $row["us_occ"];
          $thumbnail = $row["us_img"];
        }
    
      } else {
        echo "<script> location.href='../index.php'; </script>";
      }
    ?>
    
    <?php
    if (isset($_REQUEST['requpdate'])) {
        if (($_REQUEST['title'] == "") || ($_REQUEST['deskripsi'] == "") || ($_REQUEST['durasi'] == "") || ($_REQUEST['daerah_asal'] == "") || ($_REQUEST['alat_bahan'] == "") || ($_REQUEST['tipe'] == "")) {
            $msg = '<div class="alert alert-warning alert-dismissible fade show" role="alert"> <i class="fa fa-exclamation-triangle"></i> <strong>Warning!  </strong>Tidak boleh ada field yang kosong!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        } else {
            $rid = $_POST['resep_id'];
            $rtitle = $_POST['title'];
            $rauthor = $_POST['author'];
            $rdeskripsi = $_POST['deskripsi'];
            $rdurasi = $_POST['durasi'];
            $rdaerah_asal = $_POST['daerah_asal'];
            $rtipe = $_POST['tipe'];
            $rthumbnail = $_FILES['thumbnail'];

            $rthumbnail_name = $rthumbnail['name'];
            $rthumbnail_tmp = $rthumbnail['tmp_name'];
            $rthumbnail_destination = '../preview/upload/' . $rthumbnail_name;

            move_uploaded_file($rthumbnail_tmp, $rthumbnail_destination);

            if ($rthumbnail_name === '') {
                // Jika tidak ada gambar yang diunggah, gunakan nilai thumbnail yang sudah ada
                $update_query = "UPDATE resep SET title='$rtitle', deskripsi='$rdeskripsi', durasi='$rdurasi', daerah_asal='$rdaerah_asal', tipe='$rtipe' WHERE resep_id = $rid";
            } else {
                // Jika ada gambar yang diunggah, update dengan path gambar yang baru
                $update_query = "UPDATE resep SET title='$rtitle', deskripsi='$rdeskripsi', durasi='$rdurasi', daerah_asal='$rdaerah_asal', tipe='$rtipe', thumbnail='$rthumbnail_destination' WHERE resep_id = $rid";
            }


            // Execute the update query
            $update_result = mysqli_query($conn, $update_query);

            if ($update_result) {

                // Process Alat dan Bahan updates
                $alat_bahan = $_POST['alat_bahan'];
                // Delete existing Alat Bahan data for the recipe
                $delete_alat_bahan_query = "DELETE FROM alat_bahan WHERE resep_id = $rid";
                mysqli_query($conn, $delete_alat_bahan_query);

                // Insert updated Alat Bahan data
                foreach ($alat_bahan as $item) {
                    $insert_alat_bahan_query = "INSERT INTO alat_bahan (resep_id, item) VALUES ($rid, '$item')";
                    mysqli_query($conn, $insert_alat_bahan_query);
                }

                $langkah_nama = $_POST['langkah_namax'];
                $langkah_gambar = $_FILES['langkah_gambar'];

                if (is_array($langkah_nama) && is_array($langkah_gambar['name'])) {
                    $jumlah_langkah = count($langkah_nama); // Menghitung jumlah langkah

                    for ($i = 0; $i < $jumlah_langkah; $i++) {
                        // Periksa apakah ada file gambar yang diunggah
                        if (isset($langkah_gambar['name'][$i]) && isset($langkah_gambar['tmp_name'][$i])) {
                            $langkah_gambar_name = $langkah_gambar['name'][$i];
                            $langkah_gambar_tmp = $langkah_gambar['tmp_name'][$i];
                            $langkah_gambar_destination = '../preview/upload/' . $langkah_gambar_name;

                            // Pindahkan file gambar ke direktori tujuan
                            move_uploaded_file($langkah_gambar_tmp, $langkah_gambar_destination);

                            // Simpan data langkah-langkah ke dalam database
                            $insert_langkah_query = "INSERT INTO langkah (resep_id, nama, gambar) VALUES ($rid, '{$langkah_nama[$i]}', '$langkah_gambar_destination')";
                            mysqli_query($conn, $insert_langkah_query);
                            
                        } //tampil pesan jika input dan array diedit
                         $_SESSION['success_edit_msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert"> <i class="fa fa-check"></i> <strong>Sukses!  </strong>Resep "' . $rtitle . '" berhasil diperbarui! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                        header("Location: userPostingan.php");
                    }
                }
                else { //tampil pesan jika hanya input diedit
                    
                $_SESSION['success_edit_msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert"> <i class="fa fa-check"></i> <strong>Sukses!  </strong>Resep "' . $rtitle . '" berhasil diperbarui! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                header("Location: userPostingan.php");
                exit(); }
                   
            }
        }
    }
    ?>

   

    <main class="d-flex flex-nowrap">
        <div class="container-fluid mt-4 px-5" id="container-wrapper">
            <div class="row mb-3">

                <!-- card -->
                <div class="col-lg-12 mb-4 text-center">
                    <h2 class="font-weight-bold text-primary">EDIT RESEP</h2>
                </div>
                <div class="col-lg-12">
                    <?php if (isset($msg)) {
                        echo $msg;
                    } ?>
                    <div class="card mb-4">
                        <!-- Thumbnail dan Data -->
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-info">
                            <h6 class="m-0 font-weight-bold text-white">Tambahkan Thumbnail</h6>
                        </div>

                        <?php

                        if (isset($_GET['id-resep'])) {
                            // Mendapatkan id resep dari parameter URL
                            $id_resep = $_GET['id-resep'];
                            $sql = "SELECT * FROM resep WHERE resep_id = $id_resep";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                        }
                        ?>


                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="prev-thumbnail">
                                    <div class="grid-thumbnail">
                                        <div class="prev-element-thumbnail">
                                            <input type="file" name="thumbnail" id="file-0" accept="image/*">
                                            <label for="file-0" id="file-0-preview">
                                                <?php
                                                if (isset($row['thumbnail']) && !empty($row['thumbnail'])) {
                                                    echo '<img src="../preview/' . $row['thumbnail'] . '" alt="">';
                                                } else {
                                                    echo '<img src="../preview/preview.jpg" alt="">';
                                                }
                                                ?>
                                                <div><span>+</span></div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group p-3">
                                <input type="hidden" class="form-control mb-3" name="resep_id" id="resep_id" value="<?php if (isset($row['resep_id'])) {
                                    echo $row['resep_id'];
                                } ?>">

                                <strong class="strong-pri"><label for="title" class="form-label">Judul
                                        Resep:</label></strong>
                                <input type="text" class="form-control mb-3" name="title" id="title" value="<?php if (isset($row['title'])) {
                                    echo $row['title'];
                                } ?>" required>

                                <strong class="strong-pri"><label for="us_id" class="form-label">Profil Anda:</label></strong>
                                    <div class="d-flex align-items-center mb-3">
                                    <img src="<?php echo $thumbnail; ?>" alt="Profile Picture"
                                        style="width: 50px; height: 50px; border-radius: 50%; margin-right: 20px;">
                                    <span class="ml-2 bg-light p-2 rounded">
                                        <strong>
                                        <?php echo $usName; ?>
                                        </strong>
                                    </span>
                                    </div>
                                    <input type="hidden" class="form-control mb-3" name="us_id" id="us_id" value="<?php echo $usId; ?>" readonly>

                                <strong class="strong-pri"><label for="deskripsi" class="form-label">Deskripsi
                                        Resep:</label></strong>
                                <textarea class="form-control mb-3" name="deskripsi" id="deskripsi" rows="3" required><?php if (isset($row['deskripsi'])) {
                                    echo $row['deskripsi'];
                                } ?></textarea>

                                <strong class="strong-pri"><label for="durasi" class="form-label">Durasi Memasak (dalam
                                        menit):</label></strong>
                                <input type="number" class="form-control mb-3" name="durasi" id="durasi" value="<?php if (isset($row['durasi'])) {
                                    echo $row['durasi'];
                                } ?>" required>

                                <strong class="strong-pri"><label for="daerah_asal" class="form-label">Daerah Asal
                                        Masakan:</label></strong>
                                <input type="text" class="form-control mb-3" name="daerah_asal" id="daerah_asal" value="<?php if (isset($row['daerah_asal'])) {
                                    echo $row['daerah_asal'];
                                } ?>" required>

                                
                                <input type="hidden" name="tipe" id="tipe" value="umum">
                                <!-- Input hidden tipe = "ori" -->
                            </div>

                            <!-- Alat dan Bahan -->
                            <div
                                class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-info">
                                <h6 class="m-0 font-weight-bold text-white">Alat dan Bahan</h6>
                            </div>

                            <div class="form-group p-3">
                                <ul id="alat_bahan_list">
                                    <?php
                                    if (isset($_REQUEST['id-resep'])) {
                                        $sql = "SELECT resep.*, alat_bahan.item 
                FROM resep
                LEFT JOIN alat_bahan ON resep.resep_id = alat_bahan.resep_id
                WHERE resep.resep_id = $id_resep";

                                        $result = $conn->query($sql);

                                        if ($result) {
                                            while ($row = $result->fetch_assoc()) {
                                                ?>
                                                <li>
                                                    <div class="mb-3">
                                                        <input type="text" class="form-control" name="alat_bahan[]"
                                                            placeholder="Masukkan alat atau bahan"
                                                            value="<?php echo $row['item']; ?>" required>
                                                    </div>
                                                    <div>
                                                        <button type="button"
                                                            class="btn btn-danger remove-alat-bahan-edit">Hapus</button>
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </ul>
                                <button type="button" class="btn btn-primary geser" id="add_alat_bahan">Tambah</button>
                            </div>

                            <!-- Langkah Membuat -->

                            <div
                                class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-info">
                                <h6 class="m-0 font-weight-bold text-white">Langkah Membuat</h6>
                            </div>

                            <?php
                            // Ambil data resep yang akan di-edit dari database
                            if (isset($_REQUEST['id-resep'])) {
                                $resep_id = $_REQUEST['id-resep'];

                                // Query untuk mengambil data resep berdasarkan resep_id
                                $sql = "SELECT * FROM resep WHERE resep_id = $resep_id";
                                $result = mysqli_query($conn, $sql);

                                if ($result) {
                                    $resep_data = mysqli_fetch_assoc($result);
                                }

                                // Query untuk mengambil data langkah-langkah yang terkait dengan resep tersebut
                                $langkah_sql = "SELECT * FROM langkah WHERE resep_id = $resep_id ORDER BY id_langkah ASC";
                                $langkah_result = mysqli_query($conn, $langkah_sql);

                                $langkah_data = [];
                                if ($langkah_result) {
                                    while ($row = mysqli_fetch_assoc($langkah_result)) {
                                        $langkah_data[] = $row;
                                    }
                                }
                            }
                            ?>

                            <div class="form-group p-3">
                                <!-- Tampilkan langkah-langkah yang telah ada -->
                                <?php if (!empty($langkah_data)) { ?>
                                    <ol id="langkah_list">
                                        <?php foreach ($langkah_data as $langkah) { ?>
                                            <li>
                                                <input type="text" class="form-control" name="langkah_nama[]"
                                                    value="<?php echo $langkah['nama']; ?>" placeholder="Tuliskan step di sini"
                                                    required>
                                                <input type="hidden" name="langkah_id[]"
                                                    value="<?php echo $langkah['id_langkah']; ?>">
                                                <input type="hidden" name="gambar_path[]"
                                                    value="<?php echo $langkah['gambar']; ?>">
                                                <div class="prev">
                                                    <!-- Tampilkan preview gambar jika ada -->
                                                    <?php if (!empty($langkah['gambar'])) { ?>
                                                        <div class="grid">
                                                            <div class="prev-element">
                                                                <img src="<?php echo $langkah['gambar']; ?>" alt="Preview Image">
                                                            </div>
                                                        </div>
                                                    <?php } else { ?>
                                                        <img src="../preview/preview.jpg">Tidak ada gambar</span>
                                                    <?php } ?>
                                                </div>
                                                <button type="button" class="btn btn-danger mt-3 remove-langkah">Hapus</button>
                                                <hr>
                                            </li>
                                        <?php } 
                                }
                                        ?>

                                                    </ol>
                                    <button type="button" class="btn btn-primary geser" id="add_langkah">Tambah
                                        Langkah</button>
                            </div>                           

                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary mt-4 mb-3" id="requpdate"
                                    name="requpdate">Simpan</button>
                                <a href="userPostingan.php" class="btn btn-outline-primary mt-4 mb-3 ">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--Row-->


        </div>

        <!--Row-->


    </main>



    <!-- Start Footer & Including JS-->
    <!-- FOOTER -->
    <footer class="text-center p-3 bg-body-tertiary">
        <div>Copyright 2023 || Kelompok 5 RPL
        </div>
    </footer>

    <!-- END -->

    <!-- JQuery Link -->
    <script src="../assets/js/jquery-3.7.1.min.js"></script>


    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/all.min.js"></script>
    <script src="../assets/js/ajaxrequest.js?v=<?php echo time(); ?>"></script>
    <script src="../assets/js/adminajaxrequest.js?v=<?php echo time(); ?>"></script>
    <script src="../preview/script-prev-edit.js"></script>

    <script>
let nextId = <?php echo count($langkah_data); ?>; // Mendapatkan jumlah langkah yang sudah ada

document.getElementById('add_langkah').addEventListener('click', function() {
    nextId++; // Menambah ID untuk langkah yang baru ditambahkan

    // Buat elemen baru untuk langkah baru
    const newLangkah = document.createElement('li');
    newLangkah.innerHTML = `
        <input type="text" class="form-control" name="langkah_namax[]" value="" placeholder="Tuliskan step di sini" required>
        <input type="hidden" name="langkah_id[]" value="${nextId}">
        <input type="file" name="langkah_gambar[]" accept="image/*"> <!-- Input untuk gambar -->

        <!-- Preview gambar jika ada -->
        <div class="prev">
            <div class="grid">
                <div class="prev-element">
                    <img src="../preview/preview.jpg" alt="Preview Image" id="preview_${nextId}">
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-danger mt-3 remove-langkah">Hapus</button>
        <hr>
    `;

    // Tambahkan langkah baru ke dalam daftar
    document.getElementById('langkah_list').appendChild(newLangkah);

    // Fungsi untuk menampilkan preview gambar saat dipilih
    const fileInput = newLangkah.querySelector('input[type="file"]');
    const imgPreview = newLangkah.querySelector(`#preview_${nextId}`);

    fileInput.addEventListener('change', function() {
        const file = fileInput.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            imgPreview.src = e.target.result;
        };

        reader.readAsDataURL(file);
    });
});

</script>

    <!-- Fungsi Hapus Alat bahan -->
    <script>
        $(document).ready(function () {
            $('.remove-alat-bahan-edit').on('click', function () {
                var item = $(this).closest('li').find('input').val(); // Ambil nilai item alat/bahan
                var resepId = <?php echo $_REQUEST['id-resep']; ?>; // Ambil ID resep dari PHP
                var currentLi = $(this).closest('li');

                $.ajax({
                    type: 'POST',
                    url: 'proses-form/hapus_alat_bahan.php', // Ganti dengan file PHP yang akan menangani penghapusan data
                    data: { item: item, resep_id: resepId },
                    success: function (response) {
                        console.log(response); // Contoh respons: 'Item berhasil dihapus!'
                        // Hapus elemen form terkait setelah item dihapus dari database
                        currentLi.remove();
                    }
                });
            });
        });
    </script>

    <!-- Fungsi Hapus Langkah -->
    <script>
        $(document).ready(function () {
            // Fungsi untuk menghapus langkah menggunakan AJAX
            $('#langkah_list').on('click', '.remove-langkah', function () {
                var resepId = <?php echo $_REQUEST['id-resep']; ?>; // Ganti dengan cara yang sesuai untuk mendapatkan ID resep
                var langkahId = $(this).siblings('[name="langkah_id[]"]').val();
                var currentLi = $(this).closest('li');

                $.ajax({
                    type: 'POST',
                    url: 'proses-form/hapus_langkah.php', // Ganti dengan file PHP yang akan menangani penghapusan langkah
                    data: { resep_id: resepId, langkah_id: langkahId },
                    success: function (response) {
                        console.log(response); // Tampilkan respons dari server di console 'Item berhasil dihapus!'
                        // Hapus elemen form terkait setelah langkah dihapus dari database
                        currentLi.remove();
                    }
                });
            });
        });
    </script>


    <script>
        $(document).ready(function () {
            // Fungsi untuk menambahkan alat bahan
            $('#add_alat_bahan').click(function () {
                var ul = $('#alat_bahan_list');
                var li = $('<li><input type="text" class="form-control" name="alat_bahan[]" placeholder="Masukkan alat dan bahan"> <button type="button" class="btn btn-danger mt-3 remove-alat-bahan">Hapus</button></li>');
                ul.append(li);
            });

            // Buton "Hapus" pada alat bahan
            $(document).on('click', '.remove-alat-bahan', function () {
                $(this).parent().remove();
            });

            // Menampilkan tombol "Hapus" pada setiap elemen saat edit
            // Misalnya, jika ada elemen dari hasil query database saat edit
            $('.existing-alat-bahan').each(function () {
                var removeButton = $('<button type="button" class="btn btn-danger mt-3 remove-alat-bahan">Hapus</button>');
                $(this).append(removeButton);
            });

            // Menghapus elemen pada tombol "Hapus" yang muncul dari database saat edit
            $(document).on('click', '.remove-alat-bahan', function () {
                $(this).parent().remove();
            });
        });

    </script>



</body>

</html>
<!-- End Footer-->