<?php 
require_once 'connect.php';
session_start();
if (!$_SESSION['userid']) {
    header("Location: index.php");
} else {

    $id_out=$_GET["id_out"];
    // echo "id_out = ". $id_out ."<br>";

    $sqlcheckout="SELECT* FROM check_out WHERE id_out= $id_out";
    $resultcheckout=mysqli_query($conn,$sqlcheckout);
    $rowcheckout=mysqli_fetch_assoc($resultcheckout);
    $room=$rowcheckout['room_out'];
    $liveout=$rowcheckout['live_out'];
    ;
    // echo "room_out = ". $room ."<br>";
    // echo "live_out = ". $liveout ."<br>";
    
    $updateroom="UPDATE `room` SET `status_r`='1',
                                   `live_r`='1'
                                    WHERE id_r = $room";
    $resultupdateroom=mysqli_query($conn,$updateroom);

    $usersql="SELECT * FROM `users` WHERE id=$liveout";
    $updateuser="UPDATE `users` SET `user_r` = '0' WHERE id = '$liveout' ";
    $resultuser=mysqli_query($conn,$updateuser);
   
    //  echo $updateuser;

    $sqlupdatestatusout="UPDATE `check_out` SET `status_checkout`='2' WHERE id_out = $id_out";
    $resultupdatestatusout=mysqli_query($conn,$sqlupdatestatusout);
   

    if($resultupdatestatusout&&$resultuser&&$resultupdateroom&&$resultcheckout){
        echo "<script>alert('แจ้งย้ายออกสำเร็จ');</script>";
        header('refresh:1;url=checkoutsucceed.php');
        exit(0);
    }else{
        echo mysqli_error($conn);
    }


}
?>
 
 
 


 
    
    
   
    



    
