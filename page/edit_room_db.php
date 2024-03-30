<?php
require_once 'connect.php';
session_start();

if (!$_SESSION['userid']) {
    header("Location: index.php");
    exit; // Make sure to exit here so the rest of the code doesn't run after redirection
} else {
    $id_r = $_POST["id_r"];
    $bib_r = $_POST["bib_r"];
     
    $status_r = $_POST["status_r"];
    $type_r = $_POST["type"];
    $befor_wather = $_POST["befor_wather"];
    $befor_electricity = $_POST["befor_electricity"];
    $live_r = $_POST["live_r"];
    $live_r2 = $_POST["live_r2"];

    // echo "live_r=" . $live_r."<br>";
    // echo "live_r2=" . $live_r2."<br>";

    // Initialize variables to avoid undefined variable errorsX
    $result1 = $result2 = $result3 = $result4 = false;

    if ($status_r == 1) {
        $data = 0;
        $sqluser = "UPDATE users SET `user_r` = '$data' WHERE id = $live_r2";
        
        
        $sql3 = "UPDATE `room` SET `status_r`= '$status_r',
                                  `live_r`= '$live_r',
                                  `type_r`='$type_r',
                                  `wather`='$befor_wather',
                                  `electricity`='$befor_electricity',
                                  `status_out`='3' WHERE id_r = '$id_r'";
                                  $result2 = mysqli_query($conn, $sqluser);
        $result4 = mysqli_query($conn, $sql3);
    } else {
        $data = $bib_r;
        $sql = "UPDATE `room` SET `status_r`= '$status_r',
                                 `live_r`= '$live_r',
                                 `type_r`='$type_r',
                                 `wather`='$befor_wather',
                                 `electricity`='$befor_electricity' WHERE id_r = '$id_r'";
        $result1 = mysqli_query($conn, $sql);
        
        $sql2 = "UPDATE users SET `user_r`='$data' WHERE id = $live_r";
        
        $result3 = mysqli_query($conn, $sql2);
    }

    if ($result1 || $result3 || $result2 || $result4) {
        echo '<script>alert("แก้ไขข้อมูลห้องสำเร็จ")</script>';
        header('refresh:1;roomstatus.php');
        exit(0);
    } else {
        echo mysqli_error($conn);
    }
}
?>
