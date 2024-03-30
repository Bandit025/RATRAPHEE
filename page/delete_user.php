<?php
require('connect.php');

session_start();

if (!$_SESSION['userid']) {
    header("Location: index.php");
} else {

    $id = $_GET["id"];
    // echo  $id;

    $sql = "DELETE FROM `users` WHERE id= $id";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo '<script>alert("ลบข้อมูลผู้ใช้สำเร็จ")</script>';
        header('refresh:1;userlist.php');
        
    } else {
        echo "เกิดข้อผิดพลาดเกิดขึ้น";
    }
}
?>
