<?php
include 'dbConnection.php';

// Ambil email dari query string
$email = $_GET['email'];

// Lakukan pengecekan apakah email sudah ada dalam database
$stmt = $conn->prepare("SELECT COUNT(*) AS count FROM user WHERE us_email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Kembalikan data dalam format JSON
header('Content-Type: application/json');
echo json_encode(['exists' => $row['count'] > 0]);
?>
