<?php
 require_once 'connect.php';
 session_start();

 if (!$_SESSION['userid']) {
     header("Location: index.php");
 } else {


$id=$_POST["id"];
 
 $fname= $_POST["fname"];
 $lname= $_POST["lname"];
 $email= $_POST["email"];
 $password= $_POST["pass"];
 $id_card=$_POST["id_card"];
 $tel=$_POST["tel"];
 $urole=$_POST["urole"];
//   echo "id: " . $id . "<br>";
//   echo "fname: " . $fname . "<br>";
//   echo "lname: " . $lname . "<br>";
//   echo "email: " . $email . "<br>";
//   echo "password: " . $password . "<br>";
 $sql="UPDATE `users` SET  `fname`='$fname',
                           `lname`='$lname',  
                           `id_card`='$id_card',       
                          `email`='$email',
                          `password`='$password',
                          `tel`='$tel'
                          WHERE id = $id";
$result=mysqli_query($conn,$sql); 

if($result ){
    if($urole==1){
        echo '<script>alert("แก้ไขข้อมูลสำเร็จ")</script>';
        header('refresh:1;adminlist.php');
        exit(0);
    }else{
        echo '<script>alert("แก้ไขข้อมูลสำเร็จ")</script>';
        header('refresh:1;userlist.php');
        exit(0);
    }
        
        
   
        
   
    
}else{
    echo mysqli_error($conn);
}

 }
 ?>
 