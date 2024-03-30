<?php
require_once 'connect.php';
session_start();

if (!$_SESSION['userid']) {
  header("Location: index.php");
  exit;
} else {
  $id_b = $_POST["id_b"];
  $price_pay = $_POST["price_pay"];
  $id_r = $_POST["id_r"];



  $filename = $_FILES['photo']['name'];
  $ext = pathinfo($filename, PATHINFO_EXTENSION);
  $allowed = array('jpg', 'png', 'jpeg');

  $name = explode(".", $filename);
  $ext = $name[1];
  $millisecond = round(microtime(true) * 10000);
  $newfilename = $millisecond . "." . $ext;

  $tmpname = $_FILES['photo']['tmp_name'];
  $moveto = './uploads/' . $newfilename;
  if (move_uploaded_file($tmpname, $moveto)) {
    chmod('./uploads/' . $newfilename, 0777);


    $sql = "INSERT INTO `pay_bill` (`id_bib_bill`, `price_pay`, `photo`) 
    VALUES ('$id_b','$price_pay','$newfilename')";
  

    // echo "upload success";
  } else {
    echo "upload failure";
  }


  $date = "SELECT * FROM pay_bill a
  INNER JOIN bill_status b";
  $result_date_pay = mysqli_query($conn, $date);
  $row_date = mysqli_fetch_assoc($result_date_pay);

  $date_pay = $row_date['date_pay'];



  $timestamp = strtotime($date_pay);

  // ดึงค่าของวันที่ เดือน และปี
  $day = date('d', $timestamp); // วันที่ (DD)
  $month_datepay = ltrim(date('m', $timestamp), '0'); // เดือน (MM)
  $year = date('Y', $timestamp); // ปี (YYYY)

  // echo "วันที่: $day<br>";
  // echo "เดือน: $month_datepay<br>";
  // echo "ปี: $year<br>";

  $incomesql = "SELECT * FROM income WHERE month_income = $month_datepay";
  // echo "คำสั่ง1= " .$incomesql. "<br>";
  $result_income = mysqli_query($conn, $incomesql);
  $row_income = mysqli_fetch_assoc($result_income);
  $month = $row_income["month_income"];

  // echo "เดือน= " .$month. "<br>";

  $befor_income = $row_income['value_income'];
  // echo "รายได้รวมก่อน = ". $befor_income."<br>";
  $after_income = $befor_income + $price_pay;
  // echo "รายได้รวมใหม่ = รายได้รวมก่อน+ราคาที่จ่าย<br>";
  // echo "รายได้รวมใหม่ = ".$befor_income."+".$price_pay."=". $after_income."<br>";
  // echo "รหัสห้องพัก = $id_r<br>";

  $sqlroom = "SELECT * FROM room WHERE id_r = $id_r";
  $resultroom = mysqli_query($conn, $sqlroom);
  $rowroom = mysqli_fetch_assoc($resultroom);
  $out = $rowroom['outstanding'];

  // echo "ยอดค้างชำระ = ".$out."<br>";
  $all = $out + $after_income;
  // echo "all: $all<br>";
  if ($out != 0) {
    // echo "เช็คบิล=ยอดค้างชำระ-ราคาที่ต้องจ่าย<br>";
    // echo "เช็คบิล=".$out." - ".$price_pay."<br>";
    $check_bill = $out - $price_pay;
    // echo "เช็คบิล: ".$check_bill."<br>";
  } else {
    // echo "เข้าเงื่อนไข2<br>";
    // echo "เช็คบิล=ราคาที่ต้องจ่าย-ยอดค้างชำระ<br>";
    // echo "เช็คบิล=".$price_pay." - ".$out."<br>";
    $check_bill = $price_pay - $out;
  //  echo "เช็คบิล: ".$check_bill."<br>";
  }

 
  

  $sqlout = "UPDATE room SET outstanding = '$check_bill' WHERE id_r = '$id_r'";
  
  // echo $sqlout;


  $sql_in = "UPDATE income SET `value_income`='$after_income' WHERE month_income = $month_datepay";
 




  $sqlstatusbill = "UPDATE `bill` SET `status_b`='2' WHERE id_b=$id_b";
  


  $result = mysqli_query($conn, $sql);
  $result_update = mysqli_query($conn, $sql_in);
  $result_statusbill = mysqli_query($conn, $sqlstatusbill);
  $resultout = mysqli_query($conn, $sqlout);
  if ($result&&$result_update&&$result_statusbill&&$resultout) {
    echo "<script>alert('แนบสลิปค่าห้องสำเร็จ');</script>";
        header('refresh:1;pay_value.php');  
      exit;
  } else {
      echo mysqli_error($conn);
  }


}
