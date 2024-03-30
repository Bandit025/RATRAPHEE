<?php
 require_once 'connect.php';
 
 $fname= $_POST["fname"];
 $lname= $_POST["lname"];
 $id_card= $_POST["id_card"];
 $email= $_POST["email"];
 $password= $_POST["pass"];
 $tel= $_POST["tel"];
 $urole= 2;
 


//  echo $fname."<br/>"; 
//  echo $lname."<br/>";
//  echo $email."<br/>";
//  echo $password."<br/>";
//  echo $urole."<br/>";

  $sql="INSERT INTO `users`(`fname`, `lname`, `email`, `password`, `urole`, `id_card`,`tel`) 
                      VALUES ('$fname','$lname','$email','$password','$urole','$id_card','$tel')";
$result=mysqli_query($conn,$sql); 



if ($result) {
        header("location:userlist.php");
        exit(0);
} else {
    echo mysqli_error($conn);
}
?>