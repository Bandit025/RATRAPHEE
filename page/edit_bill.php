<?php
require('connect.php');

session_start();

if (!$_SESSION['userid']) {
    header("Location: index.php");
} else {
    $id_bill = $_GET["id_b"];
    $sql = "SELECT * FROM bill a 
    INNER JOIN room b ON a.room_b=b.id_r
    INNER JOIN type_room c ON b.type_r = c.id_t
    INNER JOIN status_room d ON b.status_r = d.id_s
    INNER JOIN users e ON a.live_r_b=e.id  
    WHERE id_b= $id_bill";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $sqluser = "SELECT * FROM users";
    $resultu = mysqli_query($conn, $sqluser);
    $rowuser = mysqli_fetch_assoc($resultu);



?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>แก้ไขบิลค่าห้อง</title>
        <meta content="" name="description">
        <meta content="" name="keywords">

        <!-- Favicons -->
        <link href="../assets/img/favicon.png" rel="icon">
        <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">
        <link href="style.css" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
        <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
        <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
        <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href="../assets/css/style.css" rel="stylesheet">


    </head>
    <?php require('style.php'); ?>

    <body>
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
                        <li><a href="logout.php" onclick="return confirmLogout()">ออกจากระบบ</a></li>
                    </ul>
                </div>
            </div>
            <main class="col-10">
                <div class="container">
                    <div class="row">
                        <form action="edit_bill_db.php" method="post">
                            <div class="container text-center">
                                <div class="row">
                                    <div class="col"></div>
                                    <div class="col">
                                        <h1>แก้ไขบิลค่าห้อง</h1>
                                    </div>
                                    <div class="col"></div>
                                </div>
                            </div>
                            <div class="container text-center">
                                <div class="row">
                                    <div class="col">
                                        <input type="hidden" class="form-control" name="id_b" value="<?php echo $row['id_b'] ?>">
                                        <input type="hidden" class="form-control" name="id_r" value="<?php echo $row['id_r'] ?>">
                                        <input type="hidden" class="form-control" name="status_r" value="<?php echo $row['status_r'] ?>">
                                        
                                        <input type="hidden" name="live_r2" value="<?php echo $row['live_r']; ?>">
                                        <div class="mb-3">
                                            <label for="fname" class="form-label">หมายเลขห้อง</label>
                                            <input type="text" class="form-control" name="bib_r" value="<?php echo $row['bib_r'] ?>" >
                                        </div>
                                        <div class="mb-3">
                                            <label for="fname" class="form-label">ชื่อผู้ทำสัญญา</label>
                                            <?php
                                            if ($row['live_r'] == 0) { ?>
                                                <input type="text" class="form-control" value="ไม่มี" >
                                            <?php } else { ?>
                                                <input type="text" class="form-control" name="live_r" value="<?php echo $row['fname'] ?> <?php echo $row['lname'] ?>">
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="fname" class="form-label">ประเภทห้อง</label>
                                            <input type="text" class="form-control" name="type_r" value="<?php echo $row['name_t'] ?>" >
                                        </div>
                                        <div class="mb-3">
                                            <label for="fname" class="form-label">เลขมิเตอร์น้ำ</label>
                                            <input type="text" class="form-control" name="wather" value="<?php echo $row['wather'] ?>">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="fname" class="form-label">ราคา</label>
                                            <input type="text" class="form-control" name="Price_t" value="<?php echo $row['Price_t'] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="fname" class="form-label">เลขมาตรวัดไฟ</label>
                                            <input type="text" class="form-control" name="electricity" value="<?php echo $row['electricity'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="fname" class="form-label">รอบบิล</label>
                                        <select class="form-select" aria-label="Default select example" name="menstrual_cycle">
                                            <?php if ($row['menstrual_cycle'] == 1) { ?>
                                                <option selected value="1">มกราคม</option>
                                                <option value="2">กุมภาพันธ์</option>
                                                <option value="3">มีนาคม</option>
                                                <option value="4">เมษายน</option>
                                                <option value="5">พฤษภาคม</option>
                                                <option value="6">มิถุนายน</option>
                                                <option value="7">กรกฏาคม</option>
                                                <option value="8">สิงหาคม</option>
                                                <option value="9">กันยายน</option>
                                                <option value="10">ตุลาคม</option>
                                                <option value="11">พฤษจิกายน</option>
                                                <option value="12">ธันวาคม</option>
                                            <?php } else if ($row['menstrual_cycle'] == 2) { ?>
                                                <option value="1">มกราคม 2567</option>
                                                <option selected value="2">กุมภาพันธ์</option>
                                                <option value="3">มีนาคม</option>
                                                <option value="4">เมษายน</option>
                                                <option value="5">พฤษภาคม</option>
                                                <option value="6">มิถุนายน</option>
                                                <option value="7">กรกฏาคม</option>
                                                <option value="8">สิงหาคม</option>
                                                <option value="9">กันยายน</option>
                                                <option value="10">ตุลาคม</option>
                                                <option value="11">พฤษจิกายน</option>
                                                <option value="12">ธันวาคม</option>
                                            <?php } else if ($row['menstrual_cycle'] == 3) { ?>
                                                <option value="1">มกราคม </option>
                                                <option value="2">กุมภาพันธ์</option>
                                                <option selected value="3">มีนาคม</option>
                                                <option value="4">เมษายน</option>
                                                <option value="5">พฤษภาคม</option>
                                                <option value="6">มิถุนายน</option>
                                                <option value="7">กรกฏาคม</option>
                                                <option value="8">สิงหาคม</option>
                                                <option value="9">กันยายน</option>
                                                <option value="10">ตุลาคม</option>
                                                <option value="11">พฤษจิกายน</option>
                                                <option value="12">ธันวาคม</option>
                                            <?php } else if ($row['menstrual_cycle'] == 4) { ?>
                                                <option value="1">มกราคม</option>
                                                <option value="2">กุมภาพันธ์</option>
                                                <option value="3">มีนาคม</option>
                                                <option selected value="4">เมษายน</option>
                                                <option value="5">พฤษภาคม</option>
                                                <option value="6">มิถุนายน</option>
                                                <option value="7">กรกฏาคม</option>
                                                <option value="8">สิงหาคม</option>
                                                <option value="9">กันยายน</option>
                                                <option value="10">ตุลาคม</option>
                                                <option value="11">พฤษจิกายน</option>
                                                <option value="12">ธันวาคม</option>
                                            <?php } else if ($row['menstrual_cycle'] == 5) { ?>
                                                <option value="1">มกราคม</option>
                                                <option value="2">กุมภาพันธ์</option>
                                                <option value="3">มีนาคม</option>
                                                <option value="4">เมษายน</option>
                                                <option selected value="5">พฤษภาคม</option>
                                                <option value="6">มิถุนายน</option>
                                                <option value="7">กรกฏาคม</option>
                                                <option value="8">สิงหาคม</option>
                                                <option value="9">กันยายน</option>
                                                <option value="10">ตุลาคม</option>
                                                <option value="11">พฤษจิกายน</option>
                                                <option value="12">ธันวาคม</option>
                                            <?php } else if ($row['menstrual_cycle'] == 6) { ?>
                                                <option value="1">มกราคม</option>
                                                <option value="2">กุมภาพันธ์</option>
                                                <option value="3">มีนาคม</option>
                                                <option value="4">เมษายน</option>
                                                <option value="5">พฤษภาคม</option>
                                                <option selected value="6">มิถุนายน</option>
                                                <option value="7">กรกฏาคม</option>
                                                <option value="8">สิงหาคม</option>
                                                <option value="9">กันยายน</option>
                                                <option value="10">ตุลาคม</option>
                                                <option value="11">พฤษจิกายน</option>
                                                <option value="12">ธันวาคม</option>
                                            <?php } else if ($row['menstrual_cycle'] == 7) { ?>
                                                <option value="1">มกราคม</option>
                                                <option value="2">กุมภาพันธ์</option>
                                                <option value="3">มีนาคม</option>
                                                <option value="4">เมษายน</option>
                                                <option value="5">พฤษภาคม</option>
                                                <option value="6">มิถุนายน</option>
                                                <option selected value="7">กรกฏาคม</option>
                                                <option value="8">สิงหาคม</option>
                                                <option value="9">กันยายน</option>
                                                <option value="10">ตุลาคม</option>
                                                <option value="11">พฤษจิกายน</option>
                                                <option value="12">ธันวาคม</option>
                                            <?php } else if ($row['menstrual_cycle'] == 8) { ?>
                                                <option value="1">มกราคม</option>
                                                <option value="2">กุมภาพันธ์</option>
                                                <option value="3">มีนาคม</option>
                                                <option value="4">เมษายน</option>
                                                <option value="5">พฤษภาคม</option>
                                                <option value="6">มิถุนายน</option>
                                                <option value="7">กรกฏาคม</option>
                                                <option selected value="8">สิงหาคม</option>
                                                <option value="9">กันยายน</option>
                                                <option value="10">ตุลาคม</option>
                                                <option value="11">พฤษจิกายน</option>
                                                <option value="12">ธันวาคม</option>
                                            <?php } else if ($row['menstrual_cycle'] == 9) { ?>
                                                <option value="1">มกราคม</option>
                                                <option value="2">กุมภาพันธ์</option>
                                                <option value="3">มีนาคม</option>
                                                <option value="4">เมษายน</option>
                                                <option value="5">พฤษภาคม</option>
                                                <option value="6">มิถุนายน</option>
                                                <option value="7">กรกฏาคม</option>
                                                <option value="8">สิงหาคม</option>
                                                <option selected value="9">กันยายน</option>
                                                <option value="10">ตุลาคม</option>
                                                <option value="11">พฤษจิกายน</option>
                                                <option value="12">ธันวาคม</option>
                                            <?php } else if ($row['menstrual_cycle'] == 10) { ?>
                                                <option value="1">มกราคม</option>
                                                <option value="2">กุมภาพันธ์</option>
                                                <option value="3">มีนาคม</option>
                                                <option value="4">เมษายน</option>
                                                <option value="5">พฤษภาคม</option>
                                                <option value="6">มิถุนายน</option>
                                                <option value="7">กรกฏาคม</option>
                                                <option value="8">สิงหาคม</option>
                                                <option value="9">กันยายน</option>
                                                <option selected value="10">ตุลาคม</option>
                                                <option value="11">พฤษจิกายน</option>
                                                <option value="12">ธันวาคม</option>
                                            <?php } else if ($row['menstrual_cycle'] == 11) { ?>
                                                <option value="1">มกราคม</option>
                                                <option value="2">กุมภาพันธ์</option>
                                                <option value="3">มีนาคม</option>
                                                <option value="4">เมษายน</option>
                                                <option value="5">พฤษภาคม</option>
                                                <option value="6">มิถุนายน</option>
                                                <option value="7">กรกฏาคม</option>
                                                <option value="8">สิงหาคม</option>
                                                <option value="9">กันยายน</option>
                                                <option value="10">ตุลาคม</option>
                                                <option selected value="11">พฤษจิกายน</option>
                                                <option value="12">ธันวาคม</option>
                                            <?php } else if ($row['menstrual_cycle'] == 12) { ?>
                                                <option value="1">มกราคม</option>
                                                <option value="2">กุมภาพันธ์</option>
                                                <option value="3">มีนาคม</option>
                                                <option value="4">เมษายน</option>
                                                <option value="5">พฤษภาคม</option>
                                                <option value="6">มิถุนายน</option>
                                                <option value="7">กรกฏาคม</option>
                                                <option value="8">สิงหาคม</option>
                                                <option value="9">กันยายน</option>
                                                <option value="10">ตุลาคม</option>
                                                <option value="11">พฤษจิกายน</option>
                                                <option selected value="12">ธันวาคม</option>
                                            <?php } ?>
                                        </select>
                                        
                                    </div>
                                    <div class="col">
                                        <label for="fname" class="form-label">เลขมิเตอร์น้ำครั้งนี้</label>
                                        <input type="text" class="form-control" name="after_wather" value="<?php echo $row['after_wather'] ?>">
                                    </div>
                                    <div class="col">
                                        <label for="fname" class="form-label">เลขมิเตอร์ไฟครั้งนี้</label>
                                        <input type="text" class="form-control" name="after_electricity" value="<?php echo $row['after_electricity'] ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        
                                    </div>
                                    <div class="col ">
                                        
                                    </div>
                                    <div class="col ">
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="datePicker">กำหนดจ่าย</label>
                                            <input type="date" id="datePicker" class="form-control" name="dateline" value="<?php echo $row['dateline_pay'] ?>">
                                        </div>

                                    </div>
                                    <div class="col">
                                        <div class="mb-3"></br>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="col">
                                            <label for="fname" class="form-label">สถานะ</label>
                                            <select class="form-select" aria-label="Default select example" name="status_b">
                                                <?php if ($row['status_b'] == 1) { ?>
                                                    <option selected value="1">กำหนดจ่าย</option>
                                                    <option value="2">จ่ายแล้ว</option>
                                                    <option value="3">ค้างค่าชำระ</option>
                                                <?php } else if ($row['status_b'] == 2) { ?>
                                                    <option value="1">กำหนดจ่าย</option>
                                                    <option selected value="2">จ่ายแล้ว</option>
                                                    <option value="3">ค้างค่าชำระ</option>
                                                <?php } else if ($row['status_b'] == 3) { ?>
                                                    <option value="1">กำหนดจ่าย</option>
                                                    <option value="2">จ่ายแล้ว</option>
                                                    <option selected value="3">ค้างค่าชำระ</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <form>
                    </div>
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