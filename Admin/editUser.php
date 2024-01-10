<?php
if(!isset($_SESSION)){
    session_start();
    }
    $currentPage = 'users';
    include('../mainInclude/headerAdmin.php');
    include("../dbConnection.php");
    if(isset($_SESSION['is_admin_login'])){
     $adminEmail = $_SESSION['adminLogemail'];
    } else {
        echo "<script> location.href='../index.php'; </script>";
    }
    ?>

    <!--Proses Edit User Setelah Tombol Posting Edit di tekan -->
    <?php
    if (isset($_REQUEST['requpdate'])) {
        if (($_REQUEST['us_name'] == "") || ($_REQUEST['us_email'] == "") || ($_REQUEST['us_pass'] == "") || ($_REQUEST['us_occ'] == "")) {
            $msg = '<div class="alert alert-warning alert-dismissible fade show" role="alert"> <i class="fa fa-exclamation-triangle"></i> <strong>Warning!  </strong>Tidak boleh ada field yang kosong!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        } else {
            $rid = $_POST['us_id'];
            $rus_name = $_POST['us_name'];
            $rus_email = $_POST['us_email'];
            $rus_pass = $_POST['us_pass'];
            $rus_occ = $_POST['us_occ'];

            $query = "SELECT * FROM `user` WHERE `us_email` LIKE '$rus_email'";
            $hasil = mysqli_query($conn, $query);
            $jumlah = mysqli_num_rows($hasil);

            // Simpan data user ke database
            $update_query = "UPDATE user SET us_name='$rus_name', us_email='$rus_email', us_pass='$rus_pass', us_occ='$rus_occ' WHERE us_id = $rid";
            $result = mysqli_query($conn, $update_query);

            if ($result) {
                $_SESSION['success_user_msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert"> <i class="fa fa-check"></i> <strong>Sukses!  </strong>User "' . $rus_name . '" berhasil diperbarui! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                echo "<script> location.href='./users.php'; </script>";
                exit();
            } else {
                $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert"> <i class="fa fa-ban"></i> <strong>Gagal menambahkan user!  </strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>' . mysqli_error($conn);
            }
            
        }
    }
    ?>


<!--Dari sini html -->
<style>
    .strong-pri {
        color: #AA6514;
    }
    .custom-tooltip .tooltip-inner {
    background-color: #AA6514; /* Ganti dengan kode hex yang diinginkan */
    color: #ffffff; /* Sesuaikan dengan warna teks yang kontras */
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
                    <h3 class="m-0 font-weight-bold text-primary">EDIT USER</h3>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">

                    <div class="container-fluid mt-4 px-5" id="container-wrapper">

                        <div class="col-lg-12">
                        <!-- Prefilled form setelah icon pensil ditekan  -->
                        <?php

                        if (isset($_REQUEST['edit-user'])) {
                            $sql = "SELECT * FROM user WHERE us_id = {$_REQUEST['id-user']}";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                        }
                        ?>

                            <!-- form input data user -->
                            <div class="form-group p-3">
                                <strong class="strong-pri"><label for="us_id"
                                        class="form-label">ID User:</label></strong>
                                <input type="text" class="form-control mb-4 bg-secondary" name="us_id" id="us_id" value="<?php if (isset($row['us_id'])) {
                                    echo $row['us_id'];
                                } ?>" readonly>

                                <strong class="strong-pri"><label for="us_name"
                                        class="form-label">Nama:</label></strong>
                                <input type="text" class="form-control mb-4" name="us_name" id="us_name" value="<?php if (isset($row['us_name'])) {
                                    echo $row['us_name'];
                                } ?>" required>

                                <strong class="strong-pri">
                                    <label for="us_email" class="form-label">Email:</label>
                                </strong>
                                <div class="input-group mb-4">
                                    <input type="email" class="form-control" name="us_email" id="us_email" value="<?php if (isset($row['us_email'])) { echo $row['us_email']; } ?>" data-bs-toggle="tooltip"
                                    data-bs-custom-class="custom-tooltip" title="Tidak bisa edit email" readonly>
                                </div>

                                <strong class="strong-pri"><label for="us_pass"
                                        class="form-label">Password:</label></strong>
                                <input type="text" class="form-control mb-4" name="us_pass" id="us_pass" value="<?php if (isset($row['us_pass'])) {
                                    echo $row['us_pass'];
                                } ?>" required>

                                <strong class="strong-pri"><label for="us_occ"
                                        class="form-label">Pekerjaan:</label></strong>
                                <input type="text" class="form-control mb-4" name="us_occ" id="us_occ" value="<?php if (isset($row['us_occ'])) {
                                    echo $row['us_occ'];
                                } ?>" required>
                            </div>

                            
                        </div>
                    </div>
                    <div class="card-footer text-center">
                    <button type="submit" class="btn btn-primary mt-4 mb-3" id="requpdate"
                        name="requpdate">Simpan</button>
                    <a href="users.php" class="btn btn-outline-primary mt-4 mb-3 ">Kembali</a>
                    </div>
                </form>


                </main>

                <?php
                    include('../mainInclude/footerAdmin.php');
                ?>