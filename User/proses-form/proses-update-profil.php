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
       // Handle pesan berdasarkan hasil eksekusi
       if ($result) {
        $msgp = '<div class="alert alert-success alert-dismissible fade show" role="alert"> <i class="fa fa-check"></i> <strong>Sukses!  </strong>Data berhasil diperbarui! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        // Simpan pesan dalam session atau tambahkan ke parameter URL untuk ditampilkan setelah redirect ke halaman profil
        // Contoh menggunakan session:
        session_start();
        $_SESSION['update_msg'] = $msgp;
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