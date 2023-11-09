<?php
session_start();
require_once('../db/db.php');

if(isset($_POST['q_id'])) {
    echo $_POST['answer'];
}

if(isset($_POST['access'])) {
    $name = $_POST['name'];
    $sql = "Select * from tblusers where name = '$name'";
    $result = mysqli_query($con, $sql);
    $row_count = mysqli_num_rows($result);
    if($row_count == 1) {
            $_SESSION['status'] = "User Already Access";
            $_SESSION['status_code'] = "error";  
            $_SESSION['status_text'] = "Please try again";
            header("location:../login.php");
    } else {
        $sql = "Insert into tblusers(name)values('$name')";
        $result = mysqli_query($con, $sql);
        if($result) {
            $_SESSION['name'] = $name;
            header('location:../index.php');
        }
    }
}
?>