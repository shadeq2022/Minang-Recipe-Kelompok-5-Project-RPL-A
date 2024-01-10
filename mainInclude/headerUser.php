<?php
include_once('../dbConnection.php');
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['is_login'])) {
  $usEmail =  $_SESSION['usLogemail'];
}

if(isset($usEmail)){
  $sql = "SELECT us_img FROM user WHERE us_email = '$usEmail'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $us_img = $row["us_img"];
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
      </div>
        
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

<main class="d-flex flex-nowrap">

<!-- SIDEBAR -->
  <div class="d-flex flex-column flex-shrink-0 p-4 bg-body-tertiary" style="width: 280px;">

    <ul class="nav nav-pills flex-column mb-auto">
      <li class="text-center mb-3">
          <?php
              if (!empty($us_img)) {
                  echo '<img src="' . $us_img . '" class="img-thumbnail rounded-circle" alt="..." style="width: 170px; height: 170px;">';
              } else {
                  echo '<img src="../assets/img/blank-profile.png" class="img-thumbnail rounded-circle" alt="Default Image" style="width: 170px; height: 170px;">';
              }
          ?>
      </li>
        
      <li>
        <a href="userProfil.php" class="nav-link <?php if ($currentPage === 'profil') echo 'active';?>">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person me-2" viewBox="0 0 16 16">
          <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664z"/>
        </svg>
          Profil
        </a>
      </li>
      <li>
        <a href="userPostingan.php" class="nav-link <?php if ($currentPage === 'postingan') echo 'active'; ?>" aria-current="page">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist me-2" viewBox="0 0 16 16">
        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
        <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0M7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"/>
      </svg>
          Postingan Resep
        </a>
      </li>
      <li>
        <a href="userResepOri.php" class="nav-link <?php if ($currentPage === 'resep_ori') echo 'active'; ?>" aria-current="page">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-star me-2" viewBox="0 0 16 16">
        <path d="M7.84 4.1a.178.178 0 0 1 .32 0l.634 1.285a.178.178 0 0 0 .134.098l1.42.206c.145.021.204.2.098.303L9.42 6.993a.178.178 0 0 0-.051.158l.242 1.414a.178.178 0 0 1-.258.187l-1.27-.668a.178.178 0 0 0-.165 0l-1.27.668a.178.178 0 0 1-.257-.187l.242-1.414a.178.178 0 0 0-.05-.158l-1.03-1.001a.178.178 0 0 1 .098-.303l1.42-.206a.178.178 0 0 0 .134-.098z"/>
        <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z"/>
      </svg>
         Resep Ori
        </a>
      </li>
      <li>
        <a href="userLaporan.php" class="nav-link <?php if ($currentPage === 'laporan') echo 'active'; ?>" aria-current="page">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-graph-up-arrow me-2" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M0 0h1v15h15v1H0zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5"/>
          </svg>
          Riwayat Pembelian
        </a>
      </li>
      <li>
        <a href="userUbahPass.php" class="nav-link <?php if ($currentPage === 'userUbahPass') echo 'active'; ?>" aria-current="page">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key me-2" viewBox="0 0 16 16">
            <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8m4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5"/>
            <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
          </svg>
          Ubah Password
        </a>
      </li>
      <li>
        <a href="../logout.php" class="nav-link">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right me-2" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
          </svg>
          Keluar
        </a>
      </li>
    </ul>
  </div>

  <div class="b-example-divider b-example-vr"></div>