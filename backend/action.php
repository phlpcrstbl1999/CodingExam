<?php
session_start();
require_once('../db/db.php');

if(isset($_POST['q_id'])) {
    echo $_POST['answer'];
}

if(isset($_POST['access'])) {
    $name = $_POST['name'];
    $sql = "Insert into tblusers(name)values('$name')";
    $result = mysqli_query($con, $sql);
    if($result) {
        $_SESSION['name'] = $name;
        header('location:../index.php');
    }
}
?>