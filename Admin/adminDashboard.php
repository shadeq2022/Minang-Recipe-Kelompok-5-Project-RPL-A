<?php
if (!isset($_SESSION)) {
  session_start();
}

$currentPage = 'dashboard';
include('../mainInclude/headerAdmin.php');

if (isset($_SESSION['is_admin_login'])) {
  $adminEmail = $_SESSION['adminLogemail'];
} else {
  echo "<script> location.href='../index.php'; </script>";
}
function ribuan($nilai)
{
  return number_format($nilai, 0, ',', '.');
}



?>

<div class="container-fluid mt-4" id="container-wrapper">

  <div class="row mb-3">
    <!-- 3 Card dashboard -->

    <!-- Total resep Card -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Total Resep</div>
              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                <?php
                include("../dbConnection.php"); // Menghubungkan ke file koneksi.php
                
                // Mengambil data total resep dari tabel resep
                $query = "SELECT COUNT(*) AS total_resep FROM resep";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);
                $total_resep = $row['total_resep'];

                // Menampilkan total resep
                echo $total_resep;
                ?>
              </div>
              <div class="mt-2 mb-0 text-muted text-s custom-link">
                <a href="kelolaResep.php" class="text-primary mr-2"><i class="fas fa fa-info-circle"
                    style="margin-right: 5px;"></i>Lihat</a>
              </div>
            </div>
            <div class="col-auto">
              <i class="fa-solid fa-bowl-rice fa-2x text-primary"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Total user Card -->
    <div class="col-xl-4 col-md-6 mb-4 ">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Total User</div>
              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                <?php
                include("../dbConnection.php"); // Menghubungkan ke file koneksi.php
                
                // Mengambil data total user dari tabel user
                $query = "SELECT COUNT(*) AS total_us FROM user";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);
                $total_us = $row['total_us'];

                // Menampilkan total user
                echo $total_us;
                ?>
              </div>
              <div class="mt-2 mb-0 text-muted text-s custom-link">
                <a href="#" class="text-biru mr-2"><i class="fas fa fa-info-circle"
                    style="margin-right: 5px;"></i>Lihat</a>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa fa-users fa-2x text-biru"></i>
            </div>
          </div>
        </div>
      </div>
    </div>




    <!-- Total terjual Card -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Total Terjual</div>
              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                <?php
                include("../dbConnection.php"); // Menghubungkan ke file dbConnection.php
                

                $query = "SELECT COUNT(*) AS total_ord FROM orderan"; // Gunakan backtick di sekitar 'order'
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);
                $total_ord = $row['total_ord'];

                // Menampilkan total terjual
                echo $total_ord;

                ?>
              </div>
              <div class="mt-2 mb-0 text-muted text-s custom-link">
                <a href="adminLaporan.php" class="text-success mr-2"><i class="fas fa fa-info-circle"
                    style="margin-right: 5px;"></i>Lihat</a>
              </div>
            </div>
            <div class="col-auto">
              <i class="fa-solid fa-money-bill-wave fa-2x text-success"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  $del_msg = ''; // Pesan notifikasi default
  if (isset($_REQUEST['delete-ori'])) {
    $id_order = $_REQUEST['id-order'];
    $sql = "SELECT form_order_id FROM orderan WHERE order_id = $id_order";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $judul_order = $row['form_order_id']; // Ambil judul resep dari hasil query
      $sql_delete = "DELETE FROM orderan WHERE order_id = $id_order";
      if ($conn->query($sql_delete) === TRUE) {
        $del_msg = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa fa-check"></i>
                            <strong>Sukses!</strong> Orderan dengan "' . $judul_order . '" Berhasil Dihapus!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
      } else {
        echo "Unable to Delete Data";
      }
    }
  }
  ?>
  <!-- DataTable with Hover -->
  <div class="col-lg-12">

    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">RESEP TERJUAL</h6>
      </div>
      <div class="table-responsive p-3">
        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
          <thead class="thead-light">
            <tr>
              <th style="width: 5%;">No</th>
              <th style="width: 15%;">ID Order</th>
              <th style="width: 15%;">Nama Resep</th>
              <th style="width: 13%;">Email User</th>
              <th style="width: 10%;">Harga</th>
              <th style="width: 10%;">Status</th>
              <th style="width: 10%;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include('../dbConnection.php');

            $no = 1;

            $query = mysqli_query($conn, "SELECT orderan.*, resep.*, user.us_email
                    FROM orderan 
                    INNER JOIN resep ON orderan.resep_id = resep.resep_id 
                    INNER JOIN user ON orderan.us_id = user.us_id
                    ORDER BY orderan.order_id DESC");
            while ($data = mysqli_fetch_array($query)) {
              $id = $data['resep_id'];
              ?>

              <tr>
              <td>
                  <?= $no++; ?>
                </td>
                <td>
                  <?= $data['form_order_id']; ?>
                </td>
                <td>
                  <?= $data['title']; ?>
                </td>
                <td>
                  <?= $data['us_email']; ?>
                </td>
                <td>Rp.
                  <?= ribuan($data['harga']); ?>
                </td>

                <td>
                  <?php
                  $status_pembayaran = $data['status_pembayaran']; // Pastikan kolom ini sesuai dengan yang ada di database
                  echo '<span class="badge bg-success text-white">' . $status_pembayaran . '</span>';
                  ?>
                </td>
                <td>
                  <form method="POST" class="d-inline">
                    <input type="hidden" name="id-order" value="<?= $data['order_id']; ?>">
                    <button type="submit" class="btn btn-danger btn-sm" name="delete-ori">
                      <i class="fas fa-trash"></i>
                    </button>
                  </form>
                </td>
              </tr>
              <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!--Row-->
</div>

<!--Row-->


</main>



<!-- Start Footer & Including JS-->
<?php
include('../mainInclude/footerAdmin.php');
?>
<!-- End Footer-->
