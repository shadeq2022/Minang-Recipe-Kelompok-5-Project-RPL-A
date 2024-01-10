<?php
if (!isset($_SESSION)) {
  session_start();
}

$currentPage = 'profil';
include('../mainInclude/headerUser.php');
include('../dbConnection.php');

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

  if (isset($_REQUEST['updateUsNameBtn'])) {
    if (empty($_POST['usName'])) {
      $msg = '<div class="alert alert-warning alert-dismissible fade show" role="alert"> <i class="fa fa-exclamation-triangle"></i> <strong>Warning!  </strong>field nama tidak boleh kosong!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    } else {
      $usName = $_POST['usName'];
      $usOcc = $_POST["usOcc"];
      $thumbnail = $_FILES["usImg"];

      // Validasi jika ada file yang diunggah
      if ($thumbnail['error'] === UPLOAD_ERR_OK) {
        $thumbnail_name = $thumbnail['name'];
        $thumbnail_tmp = $thumbnail['tmp_name'];
        $thumbnail_destination = '../preview/upload/' . $thumbnail_name;
        move_uploaded_file($thumbnail_tmp, $thumbnail_destination);
      }

      // Cek apakah ada file yang diunggah atau tidak
      if (isset($thumbnail_name) && $thumbnail_name !== '') {
        // Jika ada gambar yang diunggah, update dengan path gambar yang baru
        $update_query = "UPDATE user SET us_name=?, us_occ=?, us_img=? WHERE us_email = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("ssss", $usName, $usOcc, $thumbnail_destination, $usEmail);
      } else {
        // Jika tidak ada gambar yang diunggah, hanya perbarui data kecuali gambar
        $update_query = "UPDATE user SET us_name=?, us_occ=? WHERE us_email = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("sss", $usName, $usOcc, $usEmail);
      }

      // Eksekusi pernyataan SQL
      $result = $stmt->execute();

      // Handle pesan berdasarkan hasil eksekusi
      if ($result) {
        $msgp = '<div class="alert alert-success alert-dismissible fade show" role="alert"> <i class="fa fa-check"></i> <strong>Sukses!  </strong>Data berhasil diperbarui! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        echo "<script> location.href='./userProfil.php'; </script>";
      } else {
        $msgp = '<div class="alert alert-danger alert-dismissible fade show" role="alert"> <i class="fa fa-ban"></i> <strong>Gagal memperbarui data!  </strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>' . $conn->error;
      }
    }
  }


} else {
  echo "<script> location.href='../index.php'; </script>";
}
?>


<!--Dari sini html -->
<style>
  .strong-pri {
    color: #AA6514;
  }

  .custom-tooltip .tooltip-inner {
    background-color: #AA6514;
    /* Ganti dengan kode hex yang diinginkan */
    color: #ffffff;
    /* Sesuaikan dengan warna teks yang kontras */
  }
</style>
<div class="container-fluid mt-4" id="container-wrapper" style="margin-right: 100px; margin-left: 100px;">
  <div class="row mb-3">
    <div class="col-lg-12">



      <div class="card mb-4">
        <?php if (isset($msgp)) {
          echo $msgp;
        } ?>
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center bg-body-tertiary">
          <h3 class="m-0 font-weight-bold text-primary"></h3>
        </div>
        <form action="" method="POST" enctype="multipart/form-data">

          <div class="container-fluid mt-4 px-5" id="container-wrapper">

            <div class="col-lg-12">
              <!-- Pesan notifikasi sukses perbarui data -->

              <!-- Prefilled form   -->
              <div class="form-group p-3">
                <strong class="strong-pri"><label for="usId" class="form-label">ID User:</label></strong>
                <input type="text" class="form-control mb-4 bg-secondary" name="usId" id="usId" value="<?php if (isset($usId)) {
                  echo $usId;
                } ?>" readonly>

                <strong class="strong-pri">
                  <label for="us_email" class="form-label">Email:</label>
                </strong>
                <div class="input-group mb-4">
                  <input type="email" class="form-control" name="usEmail" id="usEmail" value="<?php echo $usEmail; ?>"
                    data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" title="Tidak bisa edit email"
                    readonly>
                </div>

                <strong class="strong-pri"><label for="usName" class="form-label">Nama:</label></strong>
                <input type="text" class="form-control mb-4" name="usName" id="usName" value="<?php if (isset($usName)) {
                  echo $usName;
                } ?>" required>

                <strong class="strong-pri"><label for="usOcc" class="form-label">Pekerjaan:</label></strong>
                <input type="text" class="form-control mb-4" name="usOcc" id="usOcc" value="<?php if (isset($usOcc)) {
                  echo $usOcc;
                } ?>">

                <strong class="strong-pri"><label for="usImg" class="form-label">Foto Profil:</label></strong>
                <div class="prev">
                  <div class="grid">
                    <div class="prev-element">
                      <input type="file" name="usImg" id="file-0" accept="image/*">
                      <label for="file-0" id="file-0-preview">
                        <?php
                        if (isset($row['us_img']) && !empty($row['us_img'])) {
                          echo '<img src="../preview/' . $row['us_img'] . '" alt="">';
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




            </div>
          </div>
          <div class="card-footer text-center">
            <button type="submit" class="btn btn-primary mt-4 mb-3" id="updateUsNameBtn"
              name="updateUsNameBtn">Simpan</button>
          </div>
        </form>


        </main>

        <?php
        include('../mainInclude/footerUser.php');
        ?>