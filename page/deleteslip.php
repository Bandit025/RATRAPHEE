<?php
require('connect.php');

session_start();

if (!$_SESSION['userid']) {
    header("Location: index.php");
} else {

    $id_pay = $_GET["id_pay"];
    // echo  $id_pay;

    $sql = "DELETE FROM `pay_bill` WHERE id_pay = $id_pay";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo '<script>alert("ลบรายการโอนสำเร็จ")</script>';
        header('refresh:1;pay_complead.php');
            exit(0);
        
    } else {
        echo "เกิดข้อผิดพลาดเกิดขึ้น";
    }
}
