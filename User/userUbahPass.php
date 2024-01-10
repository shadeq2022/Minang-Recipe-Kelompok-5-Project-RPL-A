<?php
if (!isset($_SESSION)) {
    session_start();
}

$currentPage = 'userUbahPass';
include('../mainInclude/headerUser.php');
include('../dbConnection.php');

if (isset($_SESSION['is_login'])) {
    $usEmail = $_SESSION['usLogemail'];
} else {
    echo "<script> location.href='../index.php'; </script>";
}

//inisialisasi variabel $userEmail yang diambil dari session 
$userEmail = $_SESSION['usLogemail'];
if (isset($_REQUEST['userPassUpdateBtn'])) {
    if (($_REQUEST['us_pass'] == "")) {
        $msg = '<div class="alert alert-warning alert-dismissible fade show" role="alert"> <i class="fa fa-exclamation-triangle"></i> <strong>Warning!  </strong>Tidak boleh ada field yang kosong!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    } else {
        $sql = "SELECT * FROM user WHERE us_email='$userEmail'";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $usPass = $_REQUEST['us_pass'];
            $sql = "UPDATE user SET us_pass = '$usPass' WHERE us_email = '$userEmail'";
            if ($conn->query($sql) == TRUE) {
                $passmsg = '<div class="alert alert-success alert-dismissible fade show" role="alert"> <i class="fa fa-check"></i> <strong>Sukses!  </strong>Password berhasil diubah! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            } else {
                $passmsg = '<div class="alert alert-danger alert-dismissible fade show" role="alert"> <i class="fa fa-ban"></i> <strong>Gagal mengubah password!  </strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>' . mysqli_error($conn);
            }
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
        background-color: #AA6514;
        /* Ganti dengan kode hex yang diinginkan */
        color: #ffffff;
        /* Sesuaikan dengan warna teks yang kontras */
    }
</style>
<div class="container mt-4" id="container-wrapper" style="margin-right: 100px; margin-left: 100px; padding-top: 30px;">
    <div class="row mb-3">
        <div class="col-lg-12">
            <div class="card mb-4">
                <?php if (isset($passmsg)) {
                    echo $passmsg;
                } ?>
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-center bg-body-tertiary">
                    <h3 class="m-0 font-weight-bold text-primary">UBAH PASSWORD</h3>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">

                    <div class="container-fluid mt-4 px-5" id="container-wrapper">

                        <div class="col-lg-12">
                            <!-- Prefilled form setelah icon pensil ditekan  -->

                            <!-- form input data user -->
                            <strong class="strong-pri"><label for="inputEmail"
                                    class="form-label">Email:</label></strong>
                            <input type="email" class="form-control mb-4 bg-secondary" name="inputEmail" id="inputEmail"
                                value="<?php echo $userEmail ?>" readonly>

                            <strong class="strong-pri"><label for="inputnewpassword" class="form-label">Password
                                    Baru:</label></strong>
                            <input type="text" class="form-control mb-4" name="us_pass" id="inputnewpassword"
                                required>

                        </div>

            </div>
            <div class="card-footer text-center">
                <button type="submit" class="btn btn-primary mt-4 mb-3" id="userPassUpdateBtn"
                    name="userPassUpdateBtn">Update</button>
                <button type="reset" class="btn btn-outline-primary mt-4 mb-3">Reset</button>
            </div>
            </form>


            </main>
            
            <!-- Start Footer & Including JS-->
            <?php
                include('../mainInclude/footerUser.php');
            ?>
            <!-- End Footer-->

            <!-- JQuery Link -->
            <script src="../assets/js/jquery-3.7.1.min.js"></script>
            <script src="../assets/js/popper.min.js"></script>
            <script src="../assets/js/bootstrap.min.js"></script>
            <script src="../assets/js/all.min.js"></script>
            <script src="../assets/js/ajaxrequest.js?v=<?php echo time(); ?>"></script>
            <script src="../assets/js/adminajaxrequest.js?v=<?php echo time(); ?>"></script>
            <!-- Script tooltips Bootstrap -->
            <script>
                const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
                const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
            </script>
            </body>

            </html>
            <!-- End Footer-->