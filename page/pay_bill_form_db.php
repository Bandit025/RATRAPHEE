<?php
 require_once 'connect.php';
 session_start();

 if (!$_SESSION['userid']) {
     header("Location: index.php");
 } else {
    $id_r=$_POST["id_r"]; 
    // $id=$_POST["id"]; 
    $bib_r=$_POST["bib_r"];
    $live_r=$_POST["live_r"]; 
    $type_r=$_POST["type_r"]; 
    $dateline=$_POST["dateline"]; 
    $wather=$_POST["wather"]; 
    $Price_t=$_POST["Price_t"]; 
    $electricity=$_POST["electricity"]; 
    $menstrual_cycle=$_POST["menstrual_cycle"]; 
    $after_wather=$_POST["after_wather"]; 
    $after_electricity=$_POST["after_electricity"]; 

    $vale_rate="SELECT * FROM `value_rate`";
    $resultvale_rate = mysqli_query($conn, $vale_rate);
    if (mysqli_num_rows($resultvale_rate) > 0) {
        // Fetch one row from the result set
        $row_vale = mysqli_fetch_assoc($resultvale_rate);
        // echo "id_r: " . $id_r . "<br>";
        // // echo "id_user: " . $id . "<br>";
        // echo "bib_r: " . $bib_r . "<br>";
        // echo "live_r: " . $live_r . "<br>";
        // echo "dateline: " . $dateline . "<br>";
        // echo "wather: " . $wather . "<br>";
        // echo "Price_t: " . $Price_t . "<br>";
        // echo "electricity: " . $electricity . "<br>";
        // echo "menstrual_cycle: " . $menstrual_cycle . "<br>";
        // echo "after_wather: " . $after_wather . "<br>";
        // echo "after_electricity: " . $after_electricity . "<br>";
        // echo "wather_value_rate: " . $row_vale['wather_value_rate'] . "<br>";
        // echo "electricity_value_rate: " . $row_vale['electricity_value_rate'] . "<br>";
        $val_wather=$row_vale['wather_value_rate'];
        $value_electricity=$row_vale['electricity_value_rate'];
        // echo "value_wather: " . $val_wather . "<br>";
        $value_wather=($after_wather - $wather);
        $value_wather_price=$value_wather * $val_wather;
        $value_electricity=($after_electricity - $electricity);
        $value_electricity=$value_electricity*$row_vale['electricity_value_rate'];

        
        //  echo "ค่าไฟ = " . $value_electricity . "<br>";
        //  echo "ค่าน้ำ =  " . $value_wather_price . "<br>";
        //  echo "ค่าห้อง =  " . $Price_t . "<br>";

        $all_price=$Price_t+$value_electricity+$value_wather_price;
        //  echo "ยอดบิล = " . $all_price . "<br>";

        $sql="INSERT INTO `bill`(`room_b`, `menstrual_cycle`, `live_r_b`, `dateline_pay`, `befor_wather`, `befor_electricity`, `after_wather`, `after_electricity`, `price_b`, `value_electricity`, `value_wather`, `price_all`, `status_b`) 
                         VALUES ('$id_r',  '$menstrual_cycle','$live_r' ,'$dateline'    ,'$wather'      ,' $electricity'     ,'$after_wather', '$after_electricity','$Price_t','$value_electricity','$value_wather_price',' $all_price','1')";
        $result=mysqli_query($conn,$sql); 

        $newbib = mysqli_insert_id($conn);
        // echo "รหัสห้อง" .$id_r ."<br>";
        // echo "รหัสบิล=".$newbib ."<br>";

           $outstandingsql ="SELECT * FROM `room` WHERE id_r = $id_r";
           $re_out=mysqli_query($conn,$outstandingsql);
           $row_out=mysqli_fetch_assoc($re_out);
           
           $befor = $row_out['outstanding'];
        //    echo "ยอดค้าง =".$befor."<br>";
        //    echo "ยอดค้าง = ยอดบิล + ยอดค้าง <br>";
        //    echo "ยอดค้าง = ".$all_price." + ".$befor."<br>";
           $outs=$all_price + $befor;
        //    echo "ยอดค้างใหม่ = ".$outs."<br>";

           
           $sql2="UPDATE `room` SET `outstanding`='$outs' WHERE id_r= $id_r";
           $result2=mysqli_query($conn,$sql2);

        
        

        

        $bib_bill = '000'.$id_r.$newbib;
        

        $updateSql = "UPDATE bill SET `bib_b` = '$bib_bill' WHERE id_b = $newbib";
        $updateResult = mysqli_query($conn, $updateSql);
        
    }
    if ($updateResult&&$result&&$result2) {
        echo "<script>alert('ออกบิลค่าห้องสำเร็จ');</script>";
        header('refresh:1;show_bill.php');
        exit(0);
    } else {
        mysqli_error($conn);
    }
    
    
    }
?>