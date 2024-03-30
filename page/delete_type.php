<?php
require('connect.php');

session_start();

if (!$_SESSION['userid']) {
    header("Location: index.php");
} else {

    $id_t = $_GET["id_t"];
    // echo  $id_bill;

    $sql = "DELETE FROM `type_room` WHERE id_t = $id_t";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo '<script>alert("ลบประเภทห้องสำเร็จ")</script>';
        header('refresh:1;room_type.php'); 
            exit(0);
        
    } else {
        echo "เกิดข้อผิดพลาดเกิดขึ้น";
    }
}
