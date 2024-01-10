<?php
if (!isset($_SESSION)) {
    session_start();
}

$currentPage = 'postingan';
include('../mainInclude/headerUser.php');
include('../dbConnection.php');

if (isset($_SESSION['is_login'])) {
    $usEmail = $_SESSION['usLogemail'];

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


} else {
    echo "<script> location.href='../index.php'; </script>";
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
<div class="container-fluid mt-4" id="container-wrapper">

    <div class="row mb-3">
        <!-- Tabel Resep Ori -->
        <div class="col-lg-12">
            <?= $msg; // pesan notifikasi di sini 
            if (isset($_SESSION['success_edit_msg'])) {
                echo $_SESSION['success_edit_msg'];
                unset($_SESSION['success_edit_msg']); // Hapus pesan notifikasi setelah ditampilkan
            }
            ?>

            <div class="card mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-body-tertiary">
                    <h6 class="m-0 font-weight-bold text-primary"><img src="../assets/img/sparkle.svg"
                            class="icon-size"> POSTINGAN RESEP</h6>
                    <a href="tambahResepUmum.php" class="btn btn-primary">
                        <i class="fas fa fa-plus"></i>
                    </a>
                </div>
                <div class="row row-cols-1 row-cols-md-3 g-4 mt-2 mb-3" id="card-container-resep">
                    <!-- Kartu-kartu  akan ditampilkan di sini -->
                </div>
                <div id="pagination-resep" class="text-center" style="margin-left: 30px;">
                    <!-- Paginasi akan ditampilkan di sini -->
                </div>
            </div>
        </div>


    </div>


    </main>
    <script src="../assets/js/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function () {
            var limit = 3; // Jumlah kartu per halaman
            var currentPageResep = 1; // Halaman awal untuk 

            // Fungsi untuk memuat kartu-kartu  berdasarkan halaman
            function loadResep(page) {
                $.ajax({
                    url: 'load_resep.php', // File PHP yang menangani data 
                    method: 'GET',
                    data: { page: page, limit: limit },
                    success: function (response) {
                        $('#card-container-resep').html(response);
                    }
                });
            }

            // Fungsi untuk memuat paginasi 
            function loadPaginationResep() {
                $.ajax({
                    url: 'pagination_resep.php', // File PHP yang menangani paginasi 
                    method: 'GET',
                    data: { limit: limit },
                    success: function (response) {
                        $('#pagination-resep').html(response);
                    }
                });
            }





            // Memuat kartu-kartu  dan paginasi saat halaman dimuat
            loadResep(currentPageResep);
            loadPaginationResep();



            // Ketika halaman paginasi  di klik
            $(document).on('click', '#pagination-resep .pagination li a', function (e) {
                e.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                loadResep(page);
                currentPageResep = page;
                loadPaginationResep();
            });


        });
    </script>

    <?php
    include('../mainInclude/footerUser.php');
    ?>
    <!--End F O O T E R-->