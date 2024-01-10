<?php
if (!isset($_SESSION)) {
    session_start();
}

$currentPage = 'kelolaResep';
include('../mainInclude/headerAdmin.php');
include('../dbConnection.php');

if (isset($_SESSION['is_admin_login'])) {
    $adminEmail = $_SESSION['adminLogemail'];
} else {
    echo "<script> location.href='../index.php'; </script>";
}
?>
<?php
function ribuan($nilai)
{
    return number_format($nilai, 0, ',', '.');
}

$msg = ''; // Pesan notifikasi default
if (isset($_REQUEST['delete-ori'])) {
    $id_ori = $_REQUEST['id-resep'];
    $sql = "SELECT title FROM resep WHERE resep_id = $id_ori"; // Ambil judul resep yang akan dihapus
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $judul_resep = $row['title']; // Ambil judul resep dari hasil query
        $sql_delete = "DELETE FROM resep WHERE resep_id = $id_ori";
        if ($conn->query($sql_delete) === TRUE) {
            $msg = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa fa-check"></i>
                        <strong>Sukses!</strong> Resep "' . $judul_resep . '" Berhasil Dihapus!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        } else {
            echo "Unable to Delete Data";
        }
    }
}
?>

<div class="container-fluid mt-4" id="container-wrapper">

    <div class="row mb-3">
        <!-- Tabel Resep Ori -->
        <div class="col-lg-12">
            <?= $msg; // pesan notifikasi di sini 
            if (isset($_SESSION['success_msg'])) {
                echo $_SESSION['success_msg'];
                unset($_SESSION['success_msg']); // Hapus pesan notifikasi setelah ditampilkan
            }
            ?>

            <div class="card mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-body-tertiary">
                    <h6 class="m-0 font-weight-bold text-primary"><img src="../assets/img/sparkle.svg"
                            class="icon-size"> RESEP ORI</h6>
                    <a href="tambahResepOri.php" class="btn btn-primary">
                        <i class="fas fa fa-plus"></i>
                    </a>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th>ID Resep</th>
                                <th>Nama Resep</th>
                                <th>Author</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $hasil_ori = mysqli_query($conn, "SELECT * FROM resep WHERE tipe = 'ori' ORDER BY resep_id ASC");
                            while ($data = mysqli_fetch_array($hasil_ori)) {
                                $id = $data['resep_id'];
                                ?>

                                <tr>
                                    <td>
                                        <?= $data['resep_id']; ?>
                                    </td>
                                    <td>
                                        <?= $data['title']; ?>
                                    </td>
                                    <td>
                                        <?= $data['author']; ?>
                                    </td>
                                    <td>Rp.
                                        <?= ribuan($data['harga']); ?>
                                    </td>
                                    <td>
                                        <form action="editResepOri.php" method="POST" class="d-inline">
                                            <input type="hidden" name="id-resep" value="<?= $data['resep_id']; ?>">
                                            <button type="submit" class="btn btn-biru btn-sm text-white" name="edit-ori">
                                                <i class="fas fa-pen"></i>
                                            </button>
                                        </form>

                                        <form method="POST" class="d-inline">
                                            <input type="hidden" name="id-resep" value="<?= $data['resep_id']; ?>">
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

        <!-- Tabel Resep Umum -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-body-tertiary">
                    <h6 class="m-0 font-weight-bold text-primary">RESEP UMUM</h6>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th>ID Resep</th>
                                <th>Nama Resep</th>
                                <th>Author</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $hasil_umum = mysqli_query($conn, "SELECT resep.*, user.us_name 
                        FROM resep 
                        INNER JOIN user ON resep.us_id = user.us_id 
                        WHERE resep.tipe = 'umum' 
                        ORDER BY resep.resep_id ASC");

                            while ($data = mysqli_fetch_array($hasil_umum)) {
                                $id = $data['resep_id'];
                                ?>

                                <tr>
                                    <td>
                                        <?= $data['resep_id']; ?>
                                    </td>
                                    <td>
                                        <?= $data['title']; ?>
                                    </td>
                                    <td>
                                        <?= $data['us_name']; ?>
                                    </td> <!-- Menampilkan us_name dari tabel user -->
                                    <td>

                                        <form method="POST" class="d-inline">
                                            <input type="hidden" name="id-resep" value="<?= $data['resep_id']; ?>">
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


</div>
</main>


<!-- Start Footer & Including JS-->
<?php
include('../mainInclude/footerAdmin.php');
?>