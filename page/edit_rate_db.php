<?php
require_once 'connect.php';
session_start();

if (!$_SESSION['userid']) {
    header("Location: index.php");
} else {


    $id_rate = $_POST["id_rate"];
    $wather_value_rate = $_POST["wather_value_rate"];
    $electricity_value_rate = $_POST["electricity_value_rate"];

    //   echo "id: " . $id_r . "<br>";
    //   echo "live_r: " . $live_r . "<br>";
    //   echo "status_r: " . $status_r . "<br>";

    $sql = "UPDATE `value_rate` SET `wather_value_rate`= '$wather_value_rate',
                                 `electricity_value_rate`= '$electricity_value_rate' 
                            WHERE id_rate = '$id_rate' ";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo '<script>alert("แก้ไขเรทค่าน้ำค่าไฟสำเร็จ")</script>';
        header('refresh:1;rate_current.php');
        exit(0);
    } else {
        echo mysqli_error($conn);
    }
}
