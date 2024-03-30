<?php
require('connect.php');

session_start();

if (!$_SESSION['userid']) {
    header("Location: index.php");
} else {

    $id_bill = $_GET["id_b"];
    // echo  $id_bill;

    $sql = "DELETE FROM `bill` WHERE id_b = $id_bill";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo '<script>alert("ลบบิลสำเร็จ")</script>';
        header('refresh:1;show_bill.php'); 
            exit(0);
        
    } else {
        echo "เกิดข้อผิดพลาดเกิดขึ้น";
    }
}
