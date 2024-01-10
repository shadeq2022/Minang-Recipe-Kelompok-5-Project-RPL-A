<?php
if(!isset($_SESSION)){
    session_start();
}
include_once('../dbConnection.php');

//cek email sdh terdaftar atau tidak
if(isset($_POST['checkemail']) && isset($_POST['$usemail'])){
    $usemail = $_POST['usemail'];
    $sql = "SELECT us_email FROM user WHERE us_email = '".$usemail."'";
    $result = $conn->query($sql);
    $row = $result->num_rows;
    echo json_encode($row);
}

//insert user

if(isset($_POST['ussignup']) && isset($_POST['usname']) && isset($_POST['usemail']) && isset($_POST['uspass'])){

    $usname = $_POST['usname'];
    $usemail = $_POST['usemail'];
    $uspass = $_POST['uspass'];

    $sql = "INSERT INTO user(us_name, us_email, us_pass) VALUES('$usname', '$usemail', '$uspass')";

    if($conn->query($sql) == TRUE){
        echo json_encode("OK");
    } else {
        echo json_encode("Failed");
    }
}

//User Login verification
if(!isset($_SESSION['is_login'])){
    if(isset($_POST['checkLogemail']) && isset($_POST['usLogemail']) && isset($_POST['usLogpass'])){
        $usLogemail = $_POST['usLogemail'];
        $usLogpass = $_POST['usLogpass'];

        $sql = "SELECT us_email, us_pass FROM user WHERE us_email = '".$usLogemail."' AND us_pass = '".$usLogpass."'";

        $result = $conn->query($sql);

        $row = $result->num_rows;

        if($row === 1){
            $_SESSION['is_login'] = true;
            $_SESSION['usLogemail'] = $usLogemail;
            echo json_encode($row);
        } else if($row === 0){
            echo json_encode($row);
        }
    }
}
?>