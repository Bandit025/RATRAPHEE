<?php
 require_once 'connect.php';
 session_start();

 if (!$_SESSION['userid']) {
     header("Location: index.php");
 } else {


$id_t=$_POST["id_t"];
 
 $name_t= $_POST["name_t"];
 $in_advance= $_POST["in_advance"];
 $type_t= $_POST["type_t"];
 $Deposit= $_POST["Deposit"];
 $Price_t= $_POST["Price_t"];

//   echo "id: " . $id_t . "<br>";
//   echo "name_t: " . $name_t . "<br>";
//   echo "in_advance: " . $in_advance . "<br>";
//   echo "type_t: " . $type_t . "<br>";
//   echo "Deposit: " . $Deposit . "<br>";
//   echo "in_advance: " . $Price_t . "<br>";
  
  $sql="UPDATE `type_room` SET  `name_t`='$name_t',
                                `Price_t`='$Price_t',
                                `type_t`='$type_t',
                                `Deposit`='$Deposit',
                                `in_advance`='$in_advance' WHERE id_t = '$id_t' ";
$result=mysqli_query($conn,$sql); 

if($result ){
    echo '<script>alert("แก้ไขข้อมูลห้องสำเร็จ")</script>';
        header('refresh:1;room_type.php');
       
}else{
    echo mysqli_error($conn);
}

 }
 ?>
 