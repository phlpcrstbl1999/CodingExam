<?php   
# Connection

$con = mysqli_connect('localhost', 'root', '', 'codingexam_db');
if(!$con) {
    echo "error";
    exit;
}
?>

