<?php
if (!isset($_SESSION)) {
    session_start();
}

$currentPage = 'resep_ori';
include('../mainInclude/headerUser.php');
include('../dbConnection.php');
function ribuan($nilai)
{
    return number_format($nilai, 0, ',', '.');
}

if (isset($_SESSION['is_login'])) {
    $usEmail = $_SESSION['usLogemail'];

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
<style>
    .checked {
        color: orange;
    }
</style>
<div class="container-fluid mt-4" id="container-wrapper">

    <div class="row mb-3">
        <!-- Tabel Resep Ori -->
        <div class="col-lg-12">

            <div class="card mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-body-tertiary">
                    <h6 class="m-0 font-weight-bold text-primary"><img src="../assets/img/sparkle.svg"
                            class="icon-size"> RESEP ORI SAYA</h6>
                    <a href="../resep-utama.php" class="btn btn-primary">
                        <i class="fa fa-shopping-cart"></i>
                    </a>
                </div>

                <div class="row row-cols-1 row-cols-md-3 g-4 mt-2 mb-3" id="card-container-resep">
                    <!-- Kartu-kartu resep akan ditampilkan di sini -->
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
            var currentPageResep = 1; // Halaman awal untuk resep

            // Fungsi untuk memuat kartu-kartu resep berdasarkan halaman
            function loadResep(page) {
                $.ajax({
                    url: 'load_ori.php', // File PHP yang menangani data resep
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
                    url: 'pagination_resep_ori.php', // File PHP yang menangani paginasi
                    method: 'GET',
                    data: { limit: limit },
                    success: function (response) {
                        $('#pagination-resep').html(response);
                    }
                });
            }





            // Memuat kartu-kartu dan paginasi saat halaman dimuat
            loadResep(currentPageResep);
            loadPaginationResep();



            // Ketika halaman paginasi resep di klik
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