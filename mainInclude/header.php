<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/main.min.css">
  <link rel="stylesheet" href="assets/css/font-awesmome/css/all.css">
  <link rel="stylesheet" href="assets/css/home.css">
  <link rel="stylesheet" href="preview/style-prev.css">
  <title>Minang Recipe</title>
</head>

<body>

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
      <a class="navbar-brand me-auto" href="index.php">
        <img src="assets/img/Minang Recipe.png"></a>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvass-title" id="offcanvasNavbarLabel"><img src="assets/img/Minang Recipe.png"></h5>
          <button type="button" class="btn-close shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link mx-lg-3 <?php if ($currentPage === 'home') echo 'active'; ?>" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-3 <?php if ($currentPage === 'resep') echo 'active'; ?>" href="resep-utama.php">Resep</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-3 <?php if ($currentPage === 'bantuan') echo 'active'; ?>" href="bantuan.php">Bantuan</a>
            </li>
          </ul>
        </div>
      </div>
      <?php
        session_start();
        if(isset($_SESSION['is_login'])){
          echo '
          <div><a href="User/userProfil.php" class="btn btn-outline-primary mx-lg">Profil Saya</a>
          <a href="logout.php" class="btn btn-primary mx-lg-2">Keluar</a>
          </div>';
        } else {
          echo '
          <div><a href="#" class="btn btn-outline-primary mx-lg" data-bs-toggle="modal" data-bs-target="#usLoginModalCenter">Masuk</a>
          <a href="#" class="btn btn-primary mx-lg-2" data-bs-toggle="modal" data-bs-target="#usRegModalCenter">Daftar</a>
          </div>';
        }

       
      ?>
      
      <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </nav>
  <!-- END -->
  