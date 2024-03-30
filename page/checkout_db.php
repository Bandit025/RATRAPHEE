<?php
require_once 'connect.php';
session_start();

if (!$_SESSION['userid']) {
    header("Location: index.php");
} else {


    $id_r = $_POST["id_r"];

    $live_r = $_POST["live_r"];;
    $id_card = $_POST["id_card"];
    $date_out = $_POST["date_out"];

    // echo "id: " . $id_r . "<br>";
    // echo "live_r: " . $live_r . "<br>";
    // echo "id_card: " . $id_card . "<br>";
    // echo "type_r: " . $date_out . "<br>";

    $sql = "INSERT INTO `check_out`( `room_out`, `date_out`, `live_out`,`status_checkout`) 
                       VALUES ('$id_r','$date_out','$live_r','1')";
    $result = mysqli_query($conn, $sql);

$sqlupdateroom="UPDATE `room` SET `status_out`='1' WHERE id_r='$id_r'";
$resultup=mysqli_query($conn, $sqlupdateroom);


    if ($result && $resultup) {
        echo "<script>alert('แจ้งย้ายออกสำเร็จ');</script>";
        header('refresh:1;url=waitingout.php');
    } else {
        echo mysqli_error($conn);
    }
}
