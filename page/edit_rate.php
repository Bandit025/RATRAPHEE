<?php
require('connect.php');

session_start();

if (!$_SESSION['userid']) {
    header("Location: index.php");
} else {
    $id_rate = $_GET["id_rate"];
    $sql = "SELECT * FROM value_rate WHERE id_rate= $id_rate";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $sqluser = "SELECT * FROM users";
    $resultu = mysqli_query($conn, $sqluser);



?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>แก้ไขหน่วย</title>
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
    <?php require('style.php'); ?>

    <body>
        <nav>
            <div class="navbar">
                <h3>RATRAPHEE</h3>
                <a></a>
                <a></a>
                <h6><?php echo $_SESSION['user'] ?></h6>
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
                            <li><a href="logout.php" onclick="return confirmLogout()">ออกจากระบบ</a></li>                        </ul>
                    </div>
                </div>
                <main class="col-10">
                    <div class="container">
                        <div class="row">
                            <form action="edit_rate_db.php" method="post">
                                <div class="container text-center">
                                    <br>

                                    <div class="row">
                                        <div class="col"></div>
                                        <div class="col">
                                            <h1>แก้ไขเรทค่าน้ำ/ค่าไฟ</h1>
                                        </div>
                                        <div class="col"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <input type="hidden" class="form-control" name="id_rate" value="<?php echo $row['id_rate'] ?>">
                                                <label for="fname" class="form-label">ค่าน้ำ</label>
                                                <input type="text" class="form-control" name="wather_value_rate" value="<?php echo $row['wather_value_rate'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="fname" class="form-label">ค่าไฟ</label>
                                                <input type="text" class="form-control" name="electricity_value_rate" value="<?php echo $row['electricity_value_rate'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div><br>
                                            <button type="submit" class="btn btn-warning">แก้ไขข้อมูล</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-1">


                                    </div>
                                    <div class="col-1">

                                    </div>
                                    <div class="col">
                                    </div>
                                </div>

                                
                                <form>
                        </div>
                    </div>
            </div>
            </div>
            <!-- ======= Footer ======= -->

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