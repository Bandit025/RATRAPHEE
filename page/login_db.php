<?php

session_start();

if (isset($_POST['email'])) {

    include('connect.php');

    $email = $_POST['email'];
    $password = $_POST['pass'];

    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_array($result);

        $_SESSION['userid'] = $row['id'];
        $_SESSION['user'] = $row['fname'] . " " . $row['lname'];
        $_SESSION['userlevel'] = $row['urole'];

        if ($_SESSION['userlevel'] == '1') {
            echo "<script>alert('loginสำเร็จ');</script>";
            header('refresh:1;url=admin_page.php'); // ต้องใส่ exit() เพื่อให้โปรแกรมหยุดทำงานทันทีหลังจากใช้งาน header
        } else {
            header('Location: user_page.php');
            exit(); // เช่นกันต้องใส่ exit() เพื่อให้โปรแกรมหยุดทำงานทันทีหลังจากใช้งาน header
        }
    } else {
        echo "<script>alert('User หรือ Password ไม่ถูกต้อง');</script>";
        header('refresh:1;url=login.php'); // ใช้ url=login.php แทน login.php
        exit(); // ใส่ exit() เพื่อให้โปรแกรมหยุดทำงานหลังจาก echo คำเตือนแล้ว
    }
} else {
    header("Location: index.php");
    exit(); // ใส่ exit() เพื่อให้โปรแกรมหยุดทำงานหลังจากใช้งาน header
}
