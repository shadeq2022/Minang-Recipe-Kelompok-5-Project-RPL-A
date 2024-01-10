<!-- Start Header-->
<?php
include('./dbConnection.php');
include('./mainInclude/header.php');
function ribuan($nilai)
{
    return number_format($nilai, 0, ',', '.');
}
?>
<!-- End Header-->

<div class="my-5">
    <h1 class="text-center">BELI RESEP</h1>
</div>

<?php
// Pastikan koneksi ke basis data sudah dilakukan sebelumnya
$button_disabled = false; // 
if (isset($_GET['id-resep'])) {
    $resep_id = $_GET['id-resep'];
    $_SESSION['id-resep'] = $resep_id;
    // Periksa apakah pengguna sudah login
    if (isset($_SESSION['is_login'])) {
        $usEmail = $_SESSION['usLogemail'];

        // Query untuk mengambil us_id berdasarkan us_email dari tabel user
        $user_query = "SELECT user.us_id
                       FROM user
                       WHERE user.us_email = '$usEmail'";
        $user_result = mysqli_query($conn, $user_query);

        if ($user_result && mysqli_num_rows($user_result) > 0) {
            $user_row = mysqli_fetch_assoc($user_result);
            $us_id = $user_row['us_id'];
    
            // Query untuk memeriksa apakah resep_id dengan us_id yang sama sudah ada dalam tabel orderan
            $check_query = "SELECT * FROM orderan WHERE resep_id = $resep_id AND us_id = $us_id";
            $check_result = mysqli_query($conn, $check_query);
    
            if (mysqli_num_rows($check_result) > 0) {
                // Jika sudah ada, variabel $button_disabled disetel ke true
                $button_disabled = true;
            }
        }
    }

    // Query untuk mengambil data resep berdasarkan resep_id
    $query = "SELECT * FROM resep WHERE resep_id = $resep_id AND tipe = 'ori'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        ?>
        <div class="containers p-3 mx-5 mb-5 bg-secondary">
            <div class="bg-white p-3">
                <div class="row align-items-center">
                    <div class="col-sm-4 text-center" style="margin-right: 150px; margin-left: 30px;">
                        <!-- Kolom pertama dengan padding ke kanan -->

                        <img src="<?php echo str_replace('../', './', $row['thumbnail']) ?>" alt="Thumbnail"
                            class="img-fluid rounded-5 mt-3" style="max-width: 500px; max-height: 350px;" />

                    </div>
                    <div class="col-md-5"> <!-- Kolom kedua memenuhi sisa grid dan rata kanan -->
                        <h2 class="text-primary fw-bold mt-4">
                            <?php echo $row['title']; ?>
                        </h2>
                        <div class="d-flex align-items-left mt-2">
                            <h4 class="text-white bg-info d-inline-block mt-2 rounded-4"
                                style="padding-right: 20px; padding-left: 20px; padding-top: 5px; padding-bottom: 5px;">
                                <?php echo $row['author']; ?>
                            </h4>
                        </div>
                        <div>
                            <p>
                                <?php echo $row['deskripsi']; ?>
                            </p>
                        </div>
                        <form action="checkout.php" method="post">
                            <div>
                                <h4 class="card-title col-9" style="margin-top: auto;">Rp.
                                    <?php echo number_format($row['harga'], 0, ',', '.'); ?>
                                </h4>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $row['harga']; ?>">
                            <input type="hidden" name="resep_id" value="<?php echo $row['resep_id']; ?>">

                            <div class="row mt-4">
                            <div class="col-md-12 text-end mt-3">
                                <?php if ($button_disabled && isset($_SESSION['is_login'])): ?>
                                    <button type="submit" class="btn btn-primary" name="buy"
                                        style="font-size: 27px; width: 100px; border-radius: 15px;" disabled>
                                        Beli
                                    </button>
                                    <div>
                                            <small class="text-danger">Anda sudah membeli resep ini!</small>
                                        </div>
                                <?php elseif (!$button_disabled && isset($_SESSION['is_login'])): ?>
                                    <button type="submit" class="btn btn-primary" name="buy"
                                        style="font-size: 27px; width: 100px; border-radius: 15px;">
                                        Beli
                                    </button>
                                <?php else: ?>
                                    <!-- Jika pengguna tidak login, biarkan tombol normal tanpa pesan -->
                                    <button type="submit" class="btn btn-primary" name="buy"
                                        style="font-size: 27px; width: 100px; border-radius: 15px;">
                                        Beli
                                    </button>
                                <?php endif; ?>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } else {
        echo "Resep tidak ditemukan.";
    }
} else {
    echo "Resep_id tidak ditemukan.";
}
?>


<!-- Start Footer & Including JS-->
<?php
$currentPage = 'resep';
include('./mainInclude/footer.php');
?>
<!-- End Footer-->