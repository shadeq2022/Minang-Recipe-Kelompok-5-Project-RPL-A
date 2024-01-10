<?php
if(!isset($_SESSION)){
    session_start();
}
include_once('../dbConnection.php');


//Admin Login verification
if(!isset($_SESSION['is_admin_login'])){
    if(isset($_POST['checkLogemail']) && isset($_POST['adminLogemail']) && isset($_POST['adminLogpass'])){
        $adminLogemail = $_POST['adminLogemail'];
        $adminLogpass = $_POST['adminLogpass'];

        $sql = "SELECT admin_email, admin_pass FROM admin WHERE admin_email = '".$adminLogemail."' AND admin_pass = '".$adminLogpass."'";

        $result = $conn->query($sql);

        $row = $result->num_rows;

        if($row === 1){
            $_SESSION['is_admin_login'] = true;
            $_SESSION['adminLogemail'] = $adminLogemail;

            echo json_encode($row);

            if (isset($_SESSION['is_login'])) {
                unset($_SESSION['is_login']); // Hapus sesi 'is_login' jika sudah ada sesi 'is_admin_login'
            }
        } else if($row === 0){
            echo json_encode($row);
        }
    }
}

?>