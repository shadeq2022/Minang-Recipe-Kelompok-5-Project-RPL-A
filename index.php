<!-- Start Header-->
<?php
$currentPage = 'home';
include('./dbConnection.php');
include('./mainInclude/header.php');
function ribuan($nilai)
{
    return number_format($nilai, 0, ',', '.');
}
?>


<!-- End Header-->

  

  <!-- Start Seksi Hero -->
  <section class="hero" id="hero">
    <div class="container-lg text-bg-secondary">
      <div class="row align-items-center">
        <div class="col-sm-6">
          <h1 class="display-4 fw-bold">Rendang</h1>
          <p>Minang atau Sumatera Barat terkenal dengan makanan atau kuliner yang sangat enak dan sudah
            mendunia, salah satunya adalah rendang.
          </p>
          <a class="btn btn-outline-primary btn-lg" href="tampilResepUmum.php?id-resep=61">Lihat Selengkapnya</a>

        </div>
        <div class="col-sm-6 text-center">
          <img src="assets/img/hero.png" class="img-fluid" alt="">
        </div>
      </div>
    </div>
  </section>
  <!-- End Seksi Hero-->

  <!-- Start Seksi Resep Ori -->
  <section class="resepori" id="resepori">
    <div class="container">
      <h2 class="display-5 fw-bold mb-4">Resep Ori</h2>
      <div id="carouselExampleControls" class="carousel">
        <div class="carousel-inner">
  
          <?php
          $query = "SELECT resep_id, title, durasi, daerah_asal, harga, author, thumbnail, tipe FROM resep WHERE tipe = 'ori' LIMIT 9";
          $result = mysqli_query($conn, $query);
          
          // Membuat struktur HTML untuk setiap card
          while ($row = mysqli_fetch_assoc($result)) {
              echo '<div class="carousel-item">';
              echo '<div class="card">';
              echo '<div class="img-wrapper"><img src="' . str_replace('..', '.', $row['thumbnail']) . '" class="d-block w-100" alt=""></div>';
              echo '<div class="card-body">';
              // Informasi resep dari database
              echo '<h5 class="card-title">' . $row['title'] . '</h5>';
              echo '<span class="badge rounded-pill text-bg-secondary" style="margin-right: 10px;">' . $row['durasi'] . ' Menit</span>';
              echo '<span class="badge rounded-pill text-bg-secondary" style="margin-right: 10px;">' . $row['daerah_asal'] . '</span>';
              echo '<span class="badge rounded-pill text-bg-warning text-white">ori</span>';
              echo '<p class="card-text">Author: ' . $row['author'] . '</p>';
              echo '<div class="card-footer">';
              echo '<div class="row">';
              echo '<h5 class="card-title col-9" style="margin-top: auto;">Rp. ' . ribuan($row['harga']) . '</h5>';
              echo '<a href="beliResep.php?id-resep=' . $row['resep_id'] . '" class="btn btn-primary d-grid gap-4 col-3 mx-auto">Beli</a>';
              echo '</div></div></div></div>';
              echo '</div>';
          }
          
          ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
          data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
          data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </section>
  <!-- End Seksi Resep Ori -->

  <!-- Start Seksi Resep Umum -->
  <section class="resepumum" id="resepumum">
    <div class="container">
      <h2 class="display-5 fw-bold mb-4">Resep Umum</h2>

      <?php
      // Query untuk mengambil data resep beserta informasi penulisnya (usname)
      $sql = "SELECT r.*, u.us_name
      FROM resep r
      LEFT JOIN user u ON r.us_id = u.us_id WHERE tipe = 'umum' LIMIT 3";

      $result = $conn->query($sql);

      // Tampilkan hasil dalam format kartu resep dengan informasi penulis (usname)
      if ($result->num_rows > 0) {
      echo '<div class="row row-cols-1 row-cols-md-3 g-4">';
      while ($row = $result->fetch_assoc()) {
      echo '<div class="col">';
      echo '<div class="card">';
      echo '<div class="img-wrapper"><img src="' . str_replace('..', '.', $row['thumbnail']) . '" class="d-block w-100" alt=""></div>';
      echo '<div class="card-body">';
      echo '<h5 class="card-title">' . $row['title'] . '</h5>';
      echo '<span class="badge rounded-pill text-bg-secondary" style="margin-right: 6px;">' . $row['durasi'] . ' Menit</span>';
      echo '<span class="badge rounded-pill text-bg-secondary" style="margin-right: 6px;">' . $row['daerah_asal'] . '</span>';
      echo '<p class="card-text">Author : ' . $row['us_name'] . '</p>';
      echo '<div class="card-footer">';
      echo '<div class="row">';
      echo '<a href="./tampilResepUmum.php?id-resep=' . $row['resep_id'] . '" class="btn btn-primary d-grid gap-4 col-11 mx-auto"> Lihat </a>';
      echo '</div>';
      echo '</div>';
      echo '</div>';
      echo '</div>';
      echo '</div>';
      }
      echo '</div>';
      } else {
      echo "Tidak ada data resep.";
      }

      ?>
      <div class="text-center mb-4 mt-4">
        <a href="resep-utama.php" class="btn btn-outline-info">Semua Resep</a>
      </div>
  </section>
  <!-- End Seksi Resep Umum -->

<!-- Start Footer & Including JS-->
<?php
  $currentPage = 'home';
  include('./mainInclude/footer.php');
?>
<!-- End Footer-->