<?php
if (!isset($_SESSION)) {
  session_start();
}

$currentPage = 'laporan';
include('../mainInclude/headerUser.php');

if (isset($_SESSION['is_login'])) {
  $usEmail = $_SESSION['usLogemail'];
} else {
  echo "<script> location.href='../index.php'; </script>";
}
function ribuan($nilai)
{
  return number_format($nilai, 0, ',', '.');
}
?>
<div class="container-fluid mt-4" id="container-wrapper">

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
        <h6 class="m-0 font-weight-bold text-primary">RIWAYAT PEMBELIAN RESEP</h6>
      </div>
      <div class="table-responsive p-3">
        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
          <thead class="thead-light">
            <tr>
              <th style="width: 5%;">No</th>
              <th style="width: 15%;">ID Order</th>
              <th style="width: 15%;">Nama Resep</th>
              <th style="width: 13%;">Email User</th>
              <th style="width: 10%;">Tanggal Order</th>
              <th style="width: 10%;">Status</th>
              <th style="width: 10%;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include('../dbConnection.php');

            $no = 1;
            $usEmail = $_SESSION['usLogemail']; // Ambil 'us_email' dari sesi yang sedang login
            
            $query = mysqli_query($conn, "SELECT orderan.*, resep.*, user.us_email
            FROM orderan 
            INNER JOIN resep ON orderan.resep_id = resep.resep_id 
            INNER JOIN user ON orderan.us_id = user.us_id
            WHERE user.us_email = '$usEmail' 
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
                <td>
                 <?= $data['tgl_order']; ?>
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
        <button class="btn btn-primary mt-3" onclick="printPage()">
          <i class="fa fa-print" aria-hidden="true"></i> Cetak
        </button>
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
include('../mainInclude/footerUser.php');
?>

<script>
  function printPage() {
    window.print();
  }
</script>