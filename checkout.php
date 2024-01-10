<?php
include('./mainInclude/header.php');
include('./dbConnection.php');


// Periksa apakah ada sesi usLogemail yang tersimpan
if (!isset($_SESSION['usLogemail'])) {
    // Jika tidak, arahkan pengguna kembali ke halaman login
    header("Location: ./loginorsignup.php");
    exit();
} else {
    // Jika sesi usLogemail ada, ambil email dari sesi
    $usEmail = $_SESSION['usLogemail'];

    // Lakukan query untuk mendapatkan us_id dari tabel user berdasarkan us_email
    $query = "SELECT us_id FROM user WHERE us_email = '$usEmail'";
    $result = $conn->query($query);

    // Periksa hasil query
    if ($result && $result->num_rows > 0) {
        // Jika ada hasil, ambil us_id
        $row = $result->fetch_assoc();
        $us_id = $row['us_id'];
    } else {
        // Jika tidak ada hasil, atur us_id ke nilai default
        $us_id = "Nilai Default"; // Misalnya, sesuaikan dengan nilai default yang sesuai
    }

    // Ambil resep_id dari input tersembunyi
    $resep_id = $_POST['resep_id'];


    // Lakukan query ke database untuk mendapatkan nama resep berdasarkan resep_id
    $query = "SELECT title,harga FROM resep WHERE resep_id = $resep_id";
    $result = $conn->query($query);

    // Periksa hasil query dan tampilkan nama resep jika ada
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nama_resep = $row['title'];
        $harga_resep = $row['harga'];
    } else {
        $nama_resep = "Nama Resep Tidak Ditemukan"; // Pesan default jika resep_id tidak ditemukan
    }


    if (!isset($_SESSION['usLogemail'])) {
        echo "<script> location.href='./loginorsignup.php'; </script>";
    } else {
        $usEmail = $_SESSION['usLogemail'];
    }
    ?>



    <!-- Jika belum login maka arahkan ke loginorsignup.php
Jika sudah login maka dapat mengakses konten checkout.php -->


    <style>
        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .custom-link a {
            text-decoration: none;
        }

        .custom-link a:hover {
            text-decoration: underline;
        }

        .nav-link {
            color: black;
        }

        .icon-size {
            width: 27px;
            margin-right: 5px;
        }

        .custom-link a {
            text-decoration: none;
        }

        .custom-link a:hover {
            text-decoration: underline;
        }

        .nav-link {
            color: black;
        }

        .strong-pri {
            color: #AA6514;
        }



        hr {
            border: none;
            border-bottom: 2px solid #AA6514;
            margin: 10px 0;
        }
    </style>


    <main class="px-5 d-flex flex-nowrap">
        <div class="container p-5 mt-4 px-5 py-3" id="container-wrapper">
            <div class="row p-5 mb-5">

                <!-- card -->
                <div class="col-lg-12 mb-5 text-center">


                    <div class="col-md-12 text-center">
                        <h2 class="text-info mb-3">
                            CHECKOUT
                        </h2>

                        <div class="card mb-6 mx-auto" style="max-width: 500px;">

                            <div class="form-group p-3">
                                <!-- Thumbnail dan Data -->
                                <?php
                                // Lakukan pembuatan $order_id di sini
                                $order_id = "ORD" . rand(10000, 99999999);
                                ?>
                                <form action="prosesCheckout.php" method="POST" id="buyForm">
                                    <div class="mb-3">
                                        <strong class="strong-pri"><label for="order_id" class="form-label">Order
                                                ID:</label></strong>
                                        <input type="text" class="form-control mb-3" name="order_id" id="order_id"
                                            value="<?php echo $order_id ?>" readonly disabled>

                                        <strong class="strong-pri"><label for="harga"
                                                class="form-label">Resep:</label></strong>
                                        <input type="text" class="form-control mb-3" name="nama_resep" id="nama_resep"
                                            value="<?php echo $nama_resep; ?>" readonly>

                                        <strong class="strong-pri"><label for="us_email"
                                                class="form-label">Email:</label></strong>
                                        <input type="text" class="form-control mb-3" name="us_email" id="us_email" value="<?php if (isset($usEmail)) {
                                            echo $usEmail;
                                        } ?>" readonly>

                                        <strong class="strong-pri"><label for="harga"
                                                class="form-label">Harga:</label></strong>
                                        <input type="text" class="form-control mb-3" name="harga" id="harga" value="<?php if (isset($_POST['id'])) {
                                            echo 'Rp. ' . number_format($_POST['id'], 0, ',', '.');
                                        } ?>" readonly>
                                        <!-- Di dalam formulir checkout -->
                                        <input type="hidden" name="resep_id" value="<?php echo $resep_id; ?>">
                                        <input type="hidden" name="harga_resep" value="<?php echo $harga_resep; ?>">
                                        <input type="hidden" name="order_id_resep" value="<?php echo $order_id; ?>">


                                    </div>
                                    <div class="card-footer text-center p-2">
                                        <div class="row">
                                        <div class="col-4 p-2 text-center" style="margin-left: 80px;">
                                                <button type="submit" class="btn btn-primary col-12"
                                                    onclick="delaySubmit(event)">
                                                    <span class="spinner-border spinner-border-sm me-2" role="status"
                                                        aria-hidden="true" style="display: none;"></span>
                                                    Bayar
                                                </button>
                                            </div>
                                            <div class="col-4 p-2 text-center" >
                                                <a href="javascript:window.history.back();"
                                                    class="btn btn-outline-primary col-12">Kembali</a>
                                            </div>                                            
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <script>
        function delaySubmit(event) {
            event.preventDefault(); // Menghentikan perilaku default tombol submit

            // Menampilkan spinner saat tombol diklik
            var button = event.target;
            var spinner = button.querySelector('.spinner-border');
            spinner.style.display = 'inline-block';

            
            setTimeout(function () {
                document.getElementById('buyForm').submit(); // Mengirimkan formulir setelah penundaan
            }, 1500);
        }
    </script>
    <!-- Start Footer & Including JS-->
    <?php
    include('./mainInclude/footer.php');
    ?>
    <!-- End Footer-->
    <?php
}
?>