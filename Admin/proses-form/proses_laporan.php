<?php

include('../../dbConnection.php');
function ribuan($nilai)
{
  return number_format($nilai, 0, ',', '.');
}


// Ambil nilai tanggal mulai dan tanggal selesai dari permintaan POST
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];


// Contoh query untuk mengambil data dari database berdasarkan rentang tanggal
$query = "SELECT orderan.*, resep.*, user.us_email
    FROM orderan 
    INNER JOIN resep ON orderan.resep_id = resep.resep_id 
    INNER JOIN user ON orderan.us_id = user.us_id
    WHERE orderan.tgl_order BETWEEN '$startDate' AND '$endDate'
    ORDER BY orderan.order_id DESC";

$result = mysqli_query($conn, $query);


if (mysqli_num_rows($result) > 0) {
    $output = '<thead class="thead-light">
                    <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 15%;">ID Order</th>
                    <th style="width: 13%;">Email User</th>
                    <th style="width: 10%;">Harga</th>
                    <th style="width: 15%;">Tanggal Order</th>
                    <th style="width: 10%;">Status</th>
                    
                    </tr>
                </thead>
                <tbody>';

    $no = 1;

    while ($data = mysqli_fetch_array($result)) {
        $output .= '<tr>
                        <td>' . $no++ . '</td>
                        <td>' . $data['form_order_id'] . '</td>
                        <td>' . $data['us_email'] . '</td>
                        <td>Rp.' . ribuan($data['harga']) . '</td>
                        <td>' .$data['tgl_order'] . '</td>
                        <td><span class="badge bg-success text-white">' . $data['status_pembayaran'] . '</span></td>
                        
                    </tr>';
    }

    $output .= '</tbody>';
} else {
    $output = '<tr><td colspan="7">Tidak ada data yang ditemukan</td></tr>';
}

echo $output;

mysqli_close($conn);
?>
