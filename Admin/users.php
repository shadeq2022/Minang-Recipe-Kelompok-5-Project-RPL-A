<?php
if(!isset($_SESSION)){
session_start();
}

$currentPage = 'users';
include('../mainInclude/headerAdmin.php');
include('../dbConnection.php');

if(isset($_SESSION['is_admin_login'])){
 $adminEmail = $_SESSION['adminLogemail'];
} else {
    echo "<script> location.href='../index.php'; </script>";
}
?>

<?php
$msg = ''; // Pesan notifikasi default
if (isset($_REQUEST['delete-user'])) {
    $id_user = $_REQUEST['id-user'];
    $sql = "SELECT us_name FROM user WHERE us_id = $id_user"; // Ambil nama user yang akan dihapus
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nama_user = $row['us_name']; // Ambil nama resep dari hasil query
        $sql_delete = "DELETE FROM user WHERE us_id = $id_user"; 
        if ($conn->query($sql_delete) === TRUE) {
            $msg = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa fa-check"></i>
                        <strong>Sukses!</strong> User "' . $nama_user . '" Berhasil Dihapus!
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
        ?>
        <?php
        if (isset($_SESSION['success_user_msg'])) {
            echo $_SESSION['success_user_msg'];
            unset($_SESSION['success_user_msg']); // Hapus pesan notifikasi setelah ditampilkan
        }
        ?>
        
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-body-tertiary">
                    <h6 class="m-0 font-weight-bold text-primary">DAFTAR USER</h6>
                    <a href="tambahUserbaru.php" class="btn btn-primary">
                        <i class="fas fa fa-plus"></i>
                    </a>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th>ID User</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $hasil_ori = mysqli_query($conn, "SELECT * FROM user ORDER BY us_id ASC");
                        while ($data = mysqli_fetch_array($hasil_ori)) {
                            $id = $data['us_id'];
                        ?>
                            
                                <tr>
                                    <td><?= $data['us_id']; ?></td>
                                    <td><?= $data['us_name']; ?></td>
                                    <td><?= $data['us_email']; ?></td>                                    
                                    <td>
                                        <form action="editUser.php" method="POST" class="d-inline">
                                            <input type="hidden" name="id-user" value="<?= $data['us_id']; ?>">
                                            <button type="submit" class="btn btn-biru btn-sm text-white" name="edit-user">
                                                <i class="fas fa-pen"></i>
                                            </button>
                                        </form>

                                        <form method="POST" class="d-inline">
                                            <input type="hidden" name="id-user" value="<?= $data['us_id']; ?>">
                                            <button type="submit" class="btn btn-danger btn-sm" name="delete-user">
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
