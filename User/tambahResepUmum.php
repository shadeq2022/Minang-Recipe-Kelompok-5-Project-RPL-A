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
  if (!isset($_SESSION)) {
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
  if (isset($_REQUEST['resepSubmitBtn'])) {
    if (($_REQUEST['title'] == "") || ($_REQUEST['us_id'] == "") || ($_REQUEST['deskripsi'] == "") || ($_REQUEST['durasi'] == "") || ($_REQUEST['daerah_asal'] == "") || ($_REQUEST['alat_bahan'] == "") || ($_REQUEST['tipe'] == "")) {
      $msg = '<div class="alert alert-warning alert-dismissible fade show" role="alert"> <i class="fa fa-exclamation-triangle"></i> <strong>Warning!  </strong>Tidak boleh ada field yang kosong!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    } else {

      $title = $_POST['title'];
      $us_id = $_POST['us_id'];
      $deskripsi = $_POST['deskripsi'];
      $durasi = $_POST['durasi'];
      $daerah_asal = $_POST['daerah_asal'];
      ;
      $tipe = $_POST['tipe'];
      $alat_bahan = $_POST['alat_bahan'];
      $langkah_nama = $_POST['langkah_nama'];
      $thumbnail = $_FILES['thumbnail'];

      // Simpan thumbnail
      $thumbnail_name = $thumbnail['name'];
      $thumbnail_tmp = $thumbnail['tmp_name'];
      $thumbnail_destination = '../preview/upload/' . $thumbnail_name;

      move_uploaded_file($thumbnail_tmp, $thumbnail_destination);


      // Simpan data resep ke database
      $insert_query = "INSERT INTO resep (title, us_id, deskripsi, durasi, daerah_asal, tipe, thumbnail) VALUES ('$title', '$us_id', '$deskripsi', '$durasi', '$daerah_asal', '$tipe', '$thumbnail_destination')";
      $result = mysqli_query($conn, $insert_query);

      if ($result) {
        $resep_id = mysqli_insert_id($conn);

        // Simpan alat dan bahan ke database
        foreach ($alat_bahan as $item) {
          $insert_alat_bahan_query = "INSERT INTO alat_bahan (resep_id, item) VALUES ($resep_id, '$item')";
          mysqli_query($conn, $insert_alat_bahan_query);
        }

        // Simpan langkah-langkah ke database
        for ($i = 0; $i < count($langkah_nama); $i++) {
          $langkah_gambar_name = $_FILES['langkah_gambar']['name'][$i];
          $langkah_gambar_tmp = $_FILES['langkah_gambar']['tmp_name'][$i];
          $langkah_gambar_destination = '../preview/upload/' . $langkah_gambar_name;

          move_uploaded_file($langkah_gambar_tmp, $langkah_gambar_destination);

          $insert_langkah_query = "INSERT INTO langkah (resep_id, nama, gambar) VALUES ($resep_id, '{$langkah_nama[$i]}', '$langkah_gambar_destination')";
          mysqli_query($conn, $insert_langkah_query);
        }
        $msg = '<div class="alert alert-success alert-dismissible fade show" role="alert"> <i class="fa fa-check"></i> <strong>Sukses!  </strong>Resep Berhasil Disimpan! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
      } else {
        $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert"> <i class="fa fa-ban"></i> <strong>Gagal menyimpan resep  </strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>' . mysqli_error($conn);
      }
    }
  }
  ?>

  <main class="d-flex flex-nowrap">
    <div class="container-fluid mt-4 px-5" id="container-wrapper">
      <div class="row mb-3">

        <!-- card -->
        <div class="col-lg-12 mb-4 text-center">
          <h2 class="font-weight-bold text-primary">TAMBAH RESEP</h2>
        </div>
        <div class="col-lg-12">
          <?php if (isset($msg)) {
            echo $msg;
          } ?>
          <div class="card mb-4">
            <!-- Thumbnail dan Data -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-info">
              <h6 class="m-0 font-weight-bold text-white">Tambahkan Thumbnail</h6>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <div class="prev-thumbnail">
                  <div class="grid-thumbnail">
                    <div class="prev-element-thumbnail">
                      <input type="file" name="thumbnail" id="file-0" accept="image/*" required>
                      <label for="file-0" id="file-0-preview">
                        <img src="../preview/preview.jpg" alt="">
                        <div> <span>+</span> </div>
                      </label>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group p-3">
                <strong class="strong-pri"><label for="title" class="form-label">Judul Resep:</label></strong>
                <input type="text" class="form-control mb-3" name="title" id="title" required>

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



                <strong class="strong-pri"><label for="deskripsi" class="form-label">Deskripsi Resep:</label></strong>
                <textarea class="form-control mb-3" name="deskripsi" id="deskripsi" rows="3" required></textarea>

                <strong class="strong-pri"><label for="durasi" class="form-label">Durasi Memasak (dalam
                    menit):</label></strong>
                <input type="number" class="form-control mb-3" name="durasi" id="durasi" required>

                <strong class="strong-pri"><label for="daerah_asal" class="form-label">Daerah Asal
                    Masakan:</label></strong>
                <input type="text" class="form-control mb-3" name="daerah_asal" id="daerah_asal" required>

                <input type="hidden" name="tipe" id="tipe" value="umum"> <!-- Input hidden tipe = "umum" -->
              </div>

              <!-- Alat dan Bahan -->

              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-info">
                <h6 class="m-0 font-weight-bold text-white">Alat dan Bahan</h6>
              </div>

              <div class="form-group p-3">
                <ul id="alat_bahan_list">
                  <li>
                    <input type="text" class="form-control mb-3" name="alat_bahan[]"
                      placeholder="Masukkan alat atau bahan" required>
                  </li>
                </ul>
                <button type="button" class="btn btn-primary geser" id="add_alat_bahan">Tambah</button>
              </div>

              <!-- Langkah Membuat -->

              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-info">
                <h6 class="m-0 font-weight-bold text-white">Langkah Membuat</h6>
              </div>

              <div class="form-group p-3">
                <ol id="langkah_list">
                  <li>
                    <input type="text" class="form-control mb-3" name="langkah_nama[]"
                      placeholder="Tuliskan step disini" required>
                    <div class="prev">
                      <div class="grid">
                        <div class="prev-element">
                          <input type="file" id="file-1" name="langkah_gambar[]" accept="image/*">
                          <label for="file-1" id="file-1-preview">
                            <img src="../preview/preview.jpg" alt="">
                            <div>
                              <span>+</span>
                            </div>
                          </label>
                        </div>
                      </div>
                    </div>
                    <hr>
                  </li>
                </ol>
                <button type="button" class="btn btn-primary geser" id="add_langkah">Tambah Langkah</button>
              </div>



              <!-- Langkah Membuat -->



              <div class="card-footer text-center">
                <button type="submit" class="btn btn-primary mt-4 mb-3" id="resepSubmitBtn"
                  name="resepSubmitBtn">Posting</button>
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
<!-- End Footer-->