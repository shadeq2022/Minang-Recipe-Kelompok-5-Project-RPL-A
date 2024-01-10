<?php
if (!isset($_SESSION)) {
  session_start();
}

$currentPage = 'laporan';
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
<link rel="stylesheet" href="../assets/css/print.css">
<style>
    #tabel_laporan {
        display: none;
    }
</style>
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
        <h6 class="m-0 font-weight-bold text-primary">LAPORAN PENJUALAN RESEP</h6>
      </div>
      <div class="table-responsive p-3">
      <!-- Date Picker Input -->
      <div class="row mb-3">
                <div class="col-md-3">
                    <label for="startDate">Mulai Tanggal</label>
                    <input type="date" class="form-control" id="startDate" name="startDate">
                </div>
                <div class="col-md-3">
                    <label for="endDate">Sampai Tanggal</label>
                    <input type="date" class="form-control" id="endDate" name="endDate">
                </div>
            </div>
        <table class="table align-items-center table-flush table-hover" id="tabel_laporan">
          <thead class="thead-light">
            <tr>
              <th style="width: 5%;">No</th>
              <th style="width: 15%;">ID Order</th>
              <th style="width: 13%;">Email User</th>
              <th style="width: 10%;">Harga</th>
              <th style="width: 15%;">Tanggal Order</th>
              <th style="width: 10%;">Status</th>
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
                  <?= $data['us_email']; ?>
                </td>
                <td>Rp.
                  <?= ribuan($data['harga']); ?>
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
include('../mainInclude/footerAdmin.php');
?>

<!-- Script untuk jQuery (pastikan jQuery sudah dimuat) -->
<script>
    $(document).ready(function() {
        $('#startDate, #endDate').change(function() {
            var startDate = $('#startDate').val();
            var endDate = $('#endDate').val();

            // Kirim permintaan Ajax
            $.ajax({
                type: 'POST',
                url: 'proses-form/proses_laporan.php',
                data: {
                    startDate: startDate,
                    endDate: endDate
                },
                success: function(response) {
                    // Perbarui tabel dengan data yang diterima dari server
                    $('#tabel_laporan').html(response);
                    $('#tabel_laporan').show(); // Tampilkan tabel setelah memuat data
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // Tampilkan pesan kesalahan jika terjadi masalah dalam permintaan Ajax
                }
            });
        });
    });
</script>
<script>
    function printPage() {
        window.print();
    }
</script>