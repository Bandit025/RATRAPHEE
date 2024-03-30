<?php
require('connect.php');

session_start();

if (!$_SESSION['userid']) {
    header("Location: index.php");
    exit; // จบการทำงานของสคริปต์หลังจากการเปลี่ยนเส้นทางของหน้าเว็บ
}

if(isset($_GET['id_pay'])) {
    $id_pay = $_GET['id_pay'];

    $sql = "SELECT photo FROM pay_bill WHERE id_pay = '$id_pay'";
    $result = mysqli_query($conn, $sql);

    // แสดงรูปภาพ
    if ($result && mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "<div style='text-align:center;'>";
            echo "<img src='uploads/" . $row['photo'] . "' alt='รูปภาพ' style='width:400px; display:inline-block;'>";
            echo "</div>";
        }
    } else {
        echo "ไม่พบรูปภาพ";
    }
} else {
    echo "ไม่พบรหัสรายการจ่ายเงิน";
}

?>


