<?php
session_start();
require_once('../db/db.php');

if(isset($_POST['q_id'])) {
    $q_id = $_POST['q_id'];
    $u_id = $_POST['u_id'];
    $ans = $_POST['answer'];
    $sql = "Insert into tbluseranswers(q_id,u_id,u_ans)values('$q_id','$u_id','$ans')";
    $result = mysqli_query($con, $sql);
    if($result) {
        header('location:../index.php');
    }
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
            $sql = "Select * from tblusers where name = '$name'";
            $result = mysqli_query($con, $sql);
            while($row = mysqli_fetch_array($result)){
                $u_id = $row['u_id'];
            }
            $_SESSION['u_id'] = $u_id; 
            $_SESSION['name'] = $name;
            header('location:../index.php');
        }
    }
}
?>