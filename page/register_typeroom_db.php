<?php
 require_once 'connect.php';
 session_start();

 if (!$_SESSION['userid']) {
     header("Location: index.php");
 } else {


 
 $name_t= $_POST["name_t"];
 $in_advance= $_POST["in_advance"];
 $type_t= $_POST["type_t"];
 $Deposit= $_POST["Deposit"];
 $Price_t= $_POST["Price_t"];

  
//   echo "name_t: " . $name_t . "<br>";
//   echo "in_advance: " . $in_advance . "<br>";
//   echo "type_t: " . $type_t . "<br>";
//   echo "Deposit: " . $Deposit . "<br>";
//   echo "in_advance: " . $Price_t . "<br>";
  
  $sql="INSERT INTO `type_room`(`name_t`, `Price_t`, `type_t`, `Deposit`, `in_advance`) 
                        VALUES ('$name_t','$Price_t','$type_t','$Deposit','$in_advance')";
$result=mysqli_query($conn,$sql); 

if($result ){
    echo '<script>alert("เพิ่มประเภทห้องสำเร็จ")</script>';
        header('refresh:1;room_type.php');
        exit(0);
}else{
    echo mysqli_error($conn);
}

 }
 ?>
 