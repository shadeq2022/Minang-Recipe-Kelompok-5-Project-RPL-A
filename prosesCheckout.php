<?php
include('./dbConnection.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Periksa apakah ada sesi usLogemail yang tersimpan
    if (!isset($_SESSION['usLogemail'])) {
        // Jika tidak, arahkan pengguna kembali ke halaman login
        header("Location: ./loginorsignup.php");
        exit();
    } else {
        // Pastikan kunci array $_POST tersedia sebelum mengakses nilainya
        $resep_id = isset($_POST['resep_id']) ? $_POST['resep_id'] : null;
        $harga = isset($_POST['harga_resep']) ? $_POST['harga_resep'] : null;
        $order_id = isset($_POST['order_id_resep']) ? $_POST['order_id_resep'] : null;

        $usEmail = $_SESSION['usLogemail'];
        $query = "SELECT us_id FROM user WHERE us_email = '$usEmail'";
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $us_id = $row['us_id'];

            $current_date_time = date("Y-m-d H:i:s");

            $insert_query = "INSERT INTO orderan (form_order_id, us_id, resep_id, harga, tgl_order) VALUES ('$order_id', '$us_id', '$resep_id', '$harga', '$current_date_time')";

            if ($conn->query($insert_query) === TRUE) {
                // Pesan dan tampilan
                echo <<<HTML
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <title>Pesanan Berhasil</title>
                    <style>
                        body {
                            display: flex;
                            flex-direction: column;
                            align-items: center;
                            justify-content: center;
                            height: 100vh;
                            font-family: Arial, sans-serif;
                        }
                        .success-message {
                            text-align: center;
                            margin-top: 10px;
                        }
                    </style>
                </head>
                <body>
                    <img src="./preview/upload/sukses_beli.gif" class="rounded-4" alt="Success GIF" />
                    <div class="success-message">
                        <h2>Pesanan Berhasil Disimpan, Mohon tunggu...</h2>
                        <p>Terima kasih atas pesanan Anda.</p>
                    </div>
                </body>
                </html>
                HTML;
                // Redirect ke halaman lain setelah tampilan pesan ditampilkan selama 3 detik
                header("Refresh: 4; URL=User/userResepOri.php");
                exit(); // Pastikan untuk exit setelah melakukan redirect
            } else {
                echo "Error: " . $insert_query . "<br>" . $conn->error;
            }
        } else {
            echo "Us_id tidak ditemukan.";
        }
    }
} else {
    echo "Metode request tidak valid.";
}
?>
