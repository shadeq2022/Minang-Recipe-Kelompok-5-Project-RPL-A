<?php
if (!isset($_SESSION)) {
    session_start();
}

include('../mainInclude/headerView.php');
include('../dbConnection.php');


if (isset($_SESSION['is_login'])) {
    $usEmail = $_SESSION['usLogemail'];
} else {
    echo "<script> location.href='../index.php'; </script>";
}
?>


<main class="d-flex flex-nowrap">
    <div class="container-fluid mt-4 px-5" id="container-wrapper">
        <div class="row mb-3">

            <!-- card -->
            <div class="col-lg-12 mb-4 text-center">
                <h2 class="font-weight-bold text-primary">RESEP ORI</h2>
            </div>
            <div class="col-lg-12">

                <div class="card mb-4">
                    <!-- Thumbnail dan Data -->


                    <?php


                    $sql = "SELECT * FROM resep WHERE resep_id = {$_REQUEST['id-resep']}";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();

                    ?>


                    <div class="prev-thumbnail text-center">
                        <div class="grid-thumbnail">
                            <div class="prev-element-thumbnail">
                                <img src="../preview/<?php echo isset($row['thumbnail']) && !empty($row['thumbnail']) ? $row['thumbnail'] : 'preview.jpg'; ?>"
                                    alt="">
                            </div>
                        </div>
                    </div>

                    <div class="form-group p-3">
                        <input type="hidden" class="form-control mb-3" name="resep_id" id="resep_id" value="<?php if (isset($row['resep_id'])) {
                            echo $row['resep_id'];
                        } ?>">

                        <strong class="strong-pri"><label for="title" class="form-label">Judul
                                Resep:</label></strong>
                        <input type="text" class="form-control mb-3" name="title" id="title" value="<?php if (isset($row['title'])) {
                            echo $row['title'];
                        } ?>" readonly>

                        <strong class="strong-pri"><label for="author" class="form-label">Author:</label></strong>
                        <input type="text" class="form-control mb-3" name="author" id="author" value="<?php if (isset($row['author'])) {
                            echo $row['author'];
                        } ?>" readonly>

                        <strong class="strong-pri"><label for="deskripsi" class="form-label">Deskripsi
                                Resep:</label></strong>
                        <textarea class="form-control mb-3" name="deskripsi" id="deskripsi" rows="3" readonly><?php if (isset($row['deskripsi'])) {
                            echo $row['deskripsi'];
                        } ?></textarea>

                        <strong class="strong-pri"><label for="durasi" class="form-label">Durasi Memasak (dalam
                                menit):</label></strong>
                        <input type="number" class="form-control mb-3" name="durasi" id="durasi" value="<?php if (isset($row['durasi'])) {
                            echo $row['durasi'];
                        } ?>" readonly>

                        <strong class="strong-pri"><label for="daerah_asal" class="form-label">Daerah Asal
                                Masakan:</label></strong>
                        <input type="text" class="form-control mb-3" name="daerah_asal" id="daerah_asal" value="<?php if (isset($row['daerah_asal'])) {
                            echo $row['daerah_asal'];
                        } ?>" readonly>

                        <strong class="strong-pri"><label for="harga" class="form-label">Harga Resep
                                (RP):</label></strong>
                        <input type="number" class="form-control mb-3" name="harga" id="harga" value="<?php if (isset($row['harga'])) {
                            echo $row['harga'];
                        } ?>" readonly>
                        <input type="hidden" name="tipe" id="tipe" value="ori">
                        <!-- Input hidden tipe = "ori" -->
                    </div>

                    <!-- Alat dan Bahan -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-info">
                        <h6 class="m-0 font-weight-bold text-white">Alat dan Bahan</h6>
                    </div>

                    <div class="form-group p-3">
                        <ul id="alat_bahan_list">
                            <?php
                            if (isset($_REQUEST['id-resep'])) {
                                $sql = "SELECT resep.*, alat_bahan.item 
                FROM resep
                LEFT JOIN alat_bahan ON resep.resep_id = alat_bahan.resep_id
                WHERE resep.resep_id = {$_REQUEST['id-resep']}";

                                $result = $conn->query($sql);

                                if ($result) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <li>
                                            <div class="mb-3">
                                                <input type="text" class="form-control" name="alat_bahan[]"
                                                    placeholder="Masukkan alat atau bahan" value="<?php echo $row['item']; ?>"
                                                    readonly>
                                            </div>

                                        </li>
                                        <?php
                                    }
                                }
                            }
                            ?>
                        </ul>

                    </div>

                    <!-- Langkah Membuat -->

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-info">
                        <h6 class="m-0 font-weight-bold text-white">Langkah Membuat</h6>
                    </div>

                    <?php
                    // Ambil data resep yang akan di-edit dari database
                    if (isset($_REQUEST['id-resep'])) {
                        $resep_id = $_REQUEST['id-resep'];

                        // Query untuk mengambil data resep berdasarkan resep_id
                        $sql = "SELECT * FROM resep WHERE resep_id = $resep_id";
                        $result = mysqli_query($conn, $sql);

                        if ($result) {
                            $resep_data = mysqli_fetch_assoc($result);
                        }

                        // Query untuk mengambil data langkah-langkah yang terkait dengan resep tersebut
                        $langkah_sql = "SELECT * FROM langkah WHERE resep_id = $resep_id ORDER BY id_langkah ASC";
                        $langkah_result = mysqli_query($conn, $langkah_sql);

                        $langkah_data = [];
                        if ($langkah_result) {
                            while ($row = mysqli_fetch_assoc($langkah_result)) {
                                $langkah_data[] = $row;
                            }
                        }
                    }
                    ?>

                    <div class="form-group p-3">
                        <!-- Tampilkan langkah-langkah yang telah ada -->
                        <?php if (!empty($langkah_data)) { ?>
                            <ol id="langkah_list">
                                <?php foreach ($langkah_data as $langkah) { ?>
                                    <li>
                                        <input type="text" class="form-control" name="langkah_nama[]"
                                            value="<?php echo $langkah['nama']; ?>" placeholder="Tuliskan step di sini"
                                            readonly>
                                        <input type="hidden" name="langkah_id[]" value="<?php echo $langkah['id_langkah']; ?>">
                                        <input type="hidden" name="gambar_path[]" value="<?php echo $langkah['gambar']; ?>">
                                        <div class="prev">
                                            <!-- Tampilkan preview gambar jika ada -->
                                            <?php if (!empty($langkah['gambar'])) { ?>
                                                <div class="grid">
                                                    <div class="prev-element">
                                                        <img src="<?php echo $langkah['gambar']; ?>" alt="Preview Image">
                                                    </div>
                                                </div>
                                            <?php } else { ?>
                                                <img src="../preview/preview.jpg">Tidak ada gambar</span>
                                            <?php } ?>
                                        </div>

                                        <hr>
                                    </li>
                                <?php }
                        }
                        ?>

                        </ol>

                    </div>



                    <!-- url vidio -->

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-info">
                        <h6 class="m-0 font-weight-bold text-white">Vidio</h6>
                    </div>
                    <div class="form-group p-3" style="text-align: center;">
                        <?php
                        if (isset($_REQUEST['id-resep'])) {
                            $sql = "SELECT * FROM resep WHERE resep_id = {$_REQUEST['id-resep']}";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                        }
                        ?>
                        <?php if (isset($row['url_vidio'])): ?>
                            <div style="display: inline-block;">
                                <iframe width="560" height="315" src="<?php echo $row['url_vidio']; ?>" frameborder="0"
                                    allowfullscreen></iframe>
                            </div>
                        <?php endif; ?>
                    </div>


                    <div class="card-footer text-center">
                        <a href="./userResepOri.php" class="btn btn-outline-primary mt-4 mb-3 ">Kembali</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!--Row-->


    </div>

    <!--Row-->


</main>



<!-- Start Footer & Including JS-->
<!-- FOOTER -->
<footer class="text-center p-3 bg-body-tertiary">
    <div>Copyright 2023 || Kelompok 5 RPL
    </div>
</footer>

<!-- END -->

<!-- JQuery Link -->
<script src="../assets/js/jquery-3.7.1.min.js"></script>


<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/all.min.js"></script>
<script src="../assets/js/ajaxrequest.js?v=<?php echo time(); ?>"></script>
<script src="../assets/js/adminajaxrequest.js?v=<?php echo time(); ?>"></script>
<script src="../preview/script-prev-edit.js"></script>
</body>

</html>
<!-- End Footer-->