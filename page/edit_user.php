<?php
require('connect.php');

session_start();

if (!$_SESSION['userid']) {
    header("Location: index.php");
} else {
    $id = $_GET["id"];
    $sql = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>แก้ไขข้อมูล</title>
        <meta content="" name="description">
        <meta content="" name="keywords">

        <!-- Favicons -->
        <link href="../assets/img/favicon.png" rel="icon">
        <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">


        <!-- Vendor CSS Files -->
        <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
        <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
        <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
        <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
        <link href="style.css" rel="stylesheet">
        <!-- Template Main CSS File -->
        <link href="../assets/css/style.css" rel="stylesheet">


    </head>
    <?php require('style.php');?>
    <body>
        
    <div class="navbar">
            <h3>RATRAPHEE</h3>
            <a></a>
            <a></a>
            <h6><?php echo $_SESSION['user'] ?></6>
        </div>
        <div class="row">
            <div class="col-2">
                <div class="sidebar">
                    <ul>
                    <li><a href="admin_page.php">หน้าแรก</a></li>
                        <li><a href="adminlist.php">จัดการadmin</a></li>
                        <li><a href="userlist.php">ข้อมูลผู้เช่า</a></li>
                        <li><a href="checkout.php">แจ้งย้ายออก</a></li>
                        <li><a href="waitingout.php">รอย้ายออก</a></li>
                        <li><a href="checkoutsucceed.php">ย้ายออกแล้ว</a></li>
                        <li><a href="roomstatus.php">ข้อมูลห้องพัก</a></li>
                        <li><a href="room_type.php">ประเภทห้องพัก</a></li>
                        <li><a href="pay_bill.php">ออกบิลค่าห้อง</a></li>
                        <li><a href="show_bill.php">บิลค่าห้อง</a></li>
                        <li><a href="pay_value.php">แนบบิลค่าห้อง</a></li> 
                        <li><a href="pay_complead.php">รายการชำระเงินแล้ว</a></li>
                        <li><a href="rate_current.php">จัดการเรทค่าน้ำค่าไฟ</a></li>
                        <li><a href="logout.php" onclick="return confirmLogout()">ออกจากระบบ</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-10">
                <div class="container">
                 <div class="row">
                    <br>
                        <form action="edit_user_db.php" method="post">
                            <div class="container text-center">
                            <br><br>
                                <div class="row">
                                    <div class="col">
                                    </div>
                                    <div class="col">
                                        <h1>แก้ไขข้อมูล</h1>
                                        <input type="hidden" class="form-control" name="id" value="<?php echo $row['id'] ?>">
                                        <input type="hidden" class="form-control" name="urole" value="<?php echo $row['urole'] ?>">
                                        <div class="mb-3">
                                            <label for="fname" class="form-label">ชื่อจริง</label>

                                            <input type="text" class="form-control" name="fname" value="<?php echo $row['fname'] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="lname" class="form-label">นามสกุล</label>
                                            <input type="text" class="form-control" name="lname" value="<?php echo $row['lname'] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="lname" class="form-label">รหัสบัตรประชาชน13หลัก</label>
                                            <input type="text" class="form-control" name="id_card" value="<?php echo $row['id_card'] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="lname" class="form-label">เบอร์โทรศัพท์</label>
                                            <input type="text" class="form-control" name="tel" value="<?php echo $row['tel'] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="Email" class="form-label">Email address</label>
                                            <input type="email" class="form-control" name="email" value="<?php echo $row['email'] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="Password" class="form-label">Password</label>
                                            <input type="password" class="form-control" name="pass" value="<?php echo $row['password'] ?>">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                    <div class="col">
                                    </div>
                                </div>
                            </div>
                            <form>
                    </div>
                </div>
             </div>

        <div id="preloader"></div>
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <!-- Vendor JS Files -->
        <script src="../assets/vendor/aos/aos.js"></script>
        <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
        <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
        <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
        <script src="../assets/vendor/waypoints/noframework.waypoints.js"></script>
        <script src="../assets/vendor/php-email-form/validate.js"></script>

        <!-- Template Main JS File -->
        <script src="../assets/js/main.js"></script>
        <script>
            function confirmLogout() {
                    return confirm('ต้องการออกจากระบบใช่หรือไม่');
                }
        </script>

    </body>

    </html>

<?php } ?>