<?php

require_once 'connect.php';
session_start();

if (!$_SESSION['userid']) {
    header("Location: index.php");
    exit; // Make sure to exit here so the rest of the code doesn't run after redirection
} else {
    $id_b = $_POST["id_b"];
    $id_r = $_POST["id_r"];
    $bib_r = $_POST["bib_r"];
    $menstrual_cycle = $_POST["menstrual_cycle"];
    $live_r = $_POST["live_r"];
    $live_r2 = $_POST["live_r2"];
    $dateline = $_POST["dateline"];
    $status_r = $_POST["status_r"];
    $befor_wather = $_POST["wather"];
    $after_wather = $_POST["after_wather"];
    $dateline = $_POST["dateline"];
    $befor_electricity = $_POST["electricity"];
    $after_electricity = $_POST["after_electricity"];
    $Price_t = $_POST["Price_t"];
    $status_b = $_POST["status_b"];
    // echo "ผู้เช่า =".$live_r2."<br>";

    $result1 = $result2 = $result3 = $result4 = false;

    $sql3="SELECT * FROM `value_rate`";
    $resultval=mysqli_query($conn, $sql3);
    $rowval=mysqli_fetch_assoc($resultval);
    $num_wather=$rowval['wather_value_rate'];
    $num_electricity=$rowval['electricity_value_rate'];
    $value_wather=(($after_wather-$befor_wather)*$num_wather);
    $value_electricity=(($after_electricity-$befor_electricity)*$num_electricity);
    // echo "คิดค่าน้ำ=((เลขมิเตอร์น้ำรอบนี้ - เลขมิเตอร์น้ำรอบก่อน) X หน่วยค่าน้ำ)<br>";
    // echo "คิดค่าน้ำ= ((" .$after_wather."-".$befor_wather.") X ".$num_wather.")<br>";
    // echo "ค่าน้ำ=". $value_wather ."<br>";
    // echo "คิดค่าไฟ=((เลขมิเตอร์ไฟรอบนี้ - เลขมิเตอร์ไฟรอบก่อน) X หน่วยค่าไฟ)<br>";
    // echo "คิดค่าไฟ= ((" .$after_electricity."-".$befor_electricity.") X ".$num_electricity.")<br>";
    // echo "ค่าไฟ=".$value_electricity."<br>";
    // echo "ค่าใช้จ่ายรวม = ค่าห้อง+ค่าไฟ+ค่าน้ำ <br>";
    $priceall=$Price_t+$value_electricity+$value_wather;
    // echo "ค่าใช้จ่ายรวม =".$Price_t."+".$value_electricity."+".$value_wather."<br>";
    // echo "ค่าใช้จ่ายรวม =".$priceall;
        
    if ($status_r == 1) {
        // echo "เข้าเงื่อนไข1 <br>";
        $data = 0;
        $sqluser = "UPDATE users SET `user_r` = '$data' WHERE id = $live_r";
        $result2 = mysqli_query($conn, $sqluser);
        
        $sql3 = "UPDATE `room` SET `status_r`= '$status_r',
                                  `live_r`= '$live_r',
                                  `wather`='$befor_wather',
                                  `electricity`='$befor_electricity' WHERE id_r = '$id_r'";
        $result4 = mysqli_query($conn, $sql3);
    } else {
        // echo "เข้าเงื่อนไข2 <br>";
        $data = $bib_r;
        $sql = "UPDATE `room` SET `status_r`= '$status_r',
                                 `live_r`= '$live_r2',
                                 `wather`='$befor_wather',
                                 `outstanding`='$priceall',
                                 `electricity`='$befor_electricity' WHERE id_r = '$id_r'";
            // echo "result1 = ".$sql."<br>";
        $result1 = mysqli_query($conn, $sql);
        // echo $sql;
        
        $sql2 = "UPDATE users SET `user_r`='$data' WHERE id = $live_r2";
        $result3 = mysqli_query($conn, $sql2);
    }
    
    $sql4="UPDATE `bill` SET 
                             `menstrual_cycle`='$menstrual_cycle',
                             `live_r_b`='$live_r2',
                             `dateline_pay`='$dateline',
                             `befor_wather`='$befor_wather',
                             `befor_electricity`='$befor_electricity',
                             `after_wather`='$after_wather',
                             `after_electricity`='$after_electricity'
                             ,`price_b`='$Price_t',
                             `value_electricity`='$value_electricity',
                             `value_wather`='$value_wather',
                             `price_all`=' $priceall',
                             `status_b`='$status_b' WHERE id_b=$id_b";
                            //  echo $sql4;}
     $result5=mysqli_query($conn,$sql4);
    if ($result1 || $result3 || $result2 || $result4 || $result5) {
         echo '<script>alert("แก้ไขข้อมูลห้องสำเร็จ")</script>';
        header('refresh:1;show_bill.php');
        exit(0);
    } else {
        echo mysqli_error($conn);
     }
}
?>
