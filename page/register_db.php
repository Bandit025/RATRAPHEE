<?php
 require_once 'connect.php';
 
 $fname= $_POST["fname"];
 $lname= $_POST["lname"];
 $lname= $_POST["lname"];
 $id_card= $_POST["id_card"];
 $tel= $_POST["tel"];
 $email= $_POST["email"];
 $password= $_POST["password"];
 $urole= 1;
 


//  echo $fname."<br/>"; 
//  echo $lname."<br/>";
//  echo $email."<br/>";
//  echo $password."<br/>";
//  echo $urole."<br/>";

  $sql="INSERT INTO `users`(`fname`, `lname`, `email`, `password`, `urole`,`id_card`,`tel`) 
                      VALUES ('$fname','$lname','$email','$password','$urole','$id_card','$tel')";
$result=mysqli_query($conn,$sql); 



if ($result) {
  echo '<script>alert("เพิ่มข้อมูลadminสำเร็จ")</script>';
  header('refresh:1;adminlist.php');
} else {
    echo mysqli_error($conn);
}
?>