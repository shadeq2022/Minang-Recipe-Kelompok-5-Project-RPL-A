<?php
if (!isset($_SESSION)) {
    session_start();
}

$currentPage = 'users';
include('../mainInclude/headerAdmin.php');
include('../dbConnection.php');

if (isset($_SESSION['is_admin_login'])) {
    $adminEmail = $_SESSION['adminLogemail'];
} else {
    echo "<script> location.href='../index.php'; </script>";
}
?>

<!--Proses Tambah User -->
<?php
if (isset($_REQUEST['newUsSubmitBtn'])) {
    if (($_REQUEST['us_name'] == "") || ($_REQUEST['us_email'] == "") || ($_REQUEST['us_pass'] == "") || ($_REQUEST['us_occ'] == "")) {
        $msg = '<div class="alert alert-warning alert-dismissible fade show" role="alert"> <i class="fa fa-exclamation-triangle"></i> <strong>Warning!  </strong>Tidak boleh ada field yang kosong!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    } else {

        $us_name = $_POST['us_name'];
        $us_email = $_POST['us_email'];
        $us_pass = $_POST['us_pass'];
        $us_occ = $_POST['us_occ'];


        // Cek data
        $query = "SELECT * FROM `user` WHERE `us_email` LIKE '$us_email'";
        $hasil = mysqli_query($conn, $query);
        $jumlah = mysqli_num_rows($hasil);

        if ($jumlah == 0) {
            // Simpan data user ke database
            $insert_query = "INSERT INTO user (us_name, us_email, us_pass, us_occ) VALUES ('$us_name', '$us_email', '$us_pass', '$us_occ')";
            $result = mysqli_query($conn, $insert_query);

            if ($result) {
                $msg = '<div class="alert alert-success alert-dismissible fade show" role="alert"> <i class="fa fa-check"></i> <strong>Sukses!  </strong>User berhasil ditambahkan! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            } else {
                $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert"> <i class="fa fa-ban"></i> <strong>Gagal menambahkan user!  </strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>' . mysqli_error($conn);
            }
        } else {
            $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert"> <i class="fa fa-ban"></i> <strong>Gagal!  </strong>User dengan email yang anda masukkan sudah ada!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }
    }
}
?>

<!--Dari sini html -->
<style>
    .strong-pri {
        color: #AA6514;
    }
</style>
<div class="container-fluid mt-4" id="container-wrapper" style="margin-right: 100px; margin-left: 100px;">
    <div class="row mb-3">
        <div class="col-lg-12">
            <div class="card mb-4">
                <?php if (isset($msg)) {
                    echo $msg;
                } ?>
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-center bg-body-tertiary">
                    <h3 class="m-0 font-weight-bold text-primary">TAMBAH USER</h3>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">

                    <div class="container-fluid mt-4 px-5" id="container-wrapper">

                        <div class="col-lg-12">
                            <!-- form input data user -->
                            <div class="form-group p-3">
                                <strong class="strong-pri"><label for="us_name"
                                        class="form-label">Nama:</label></strong>
                                <input type="text" class="form-control mb-4" name="us_name" id="us_name" required>

                                <strong class="strong-pri"><label for="us_email"
                                        class="form-label">Email:</label></strong>
                                <input type="email" class="form-control mb-4" name="us_email" id="us_email" required>

                                <strong class="strong-pri"><label for="us_pass"
                                        class="form-label">Password:</label></strong>
                                <input type="text" class="form-control mb-4" name="us_pass" id="us_pass" required>

                                <strong class="strong-pri"><label for="us_occ"
                                        class="form-label">Pekerjaan:</label></strong>
                                <input type="text" class="form-control mb-4" name="us_occ" id="us_occ" required>
                            </div>

                            <!-- seharusnya tombol submit disini!!!!! -->
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-primary mt-4 mb-3" id="newUsSubmitBtn"
                            name="newUsSubmitBtn">Posting</button>
                        <a href="users.php" class="btn btn-outline-primary mt-4 mb-3 ">Kembali</a>
                    </div>
                </form>


                </main>


                <?php
                include('../mainInclude/footerAdmin.php');
                ?>
                <!-- End Footer-->