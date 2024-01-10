<?php
include_once('../dbConnection.php');
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['is_login'])) {
  $usEmail =  $_SESSION['usLogemail'];
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
  <link rel="stylesheet" href="../assets/vendor-tables/datatables/dataTables.bootstrap4.min.css">
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

      

        hr {
            border: none;
            /* Menghilangkan garis bawaan */
            border-bottom: 2px solid #AA6514;
            /* Mengatur garis bawah dengan ketebalan 2px dan warna hitam (#000) */
            margin: 10px 0;
            /* Memberi sedikit ruang di atas dan di bawah garis */
        }
    </style>

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
              <a class="nav-link mx-lg-3"  href="../index.php">Home</a>
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
  
  <!-- END -->

  <style>
  .b-example-vr {
    flex-shrink: 0;
    width: 1.5rem;
    height: 100vh;
  }

  .bi {
    vertical-align: -.125em;
    fill: currentColor;
  }

  .custom-link a {
    text-decoration: none;
  }

  .custom-link a:hover {
    text-decoration: underline;
  }
  .nav-link{
    color: black;
  }
  .icon-size {
  width: 27px;
  margin-right: 5px;
  }
  
</style>

