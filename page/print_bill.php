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
    INNER JOIN menstrual f ON a.menstrual_cycle=f.id_m  
    WHERE id_b= $id_bill";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $sqluser = "SELECT * FROM users";
    $resultu = mysqli_query($conn, $sqluser);
    $rowuser = mysqli_fetch_assoc($resultu);

    $sqlvalue = "SELECT * FROM `value_rate`";
    $resultvalue = mysqli_query($conn, $sqlvalue);
    $rowvalue = mysqli_fetch_assoc($resultvalue);

    $value_wather_user = $row['after_wather'] - $row['befor_wather'];
    $wather_price = $value_wather_user * $rowvalue['wather_value_rate'];
    $value_electricity_use = $row['after_electricity'] - $row['befor_electricity'];
    $electricity_price = $value_electricity_use * $rowvalue['electricity_value_rate'];


?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>รายการขำระเงิน</title>
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
    <style>
        /* Default styles here */

        /* This will only apply when printing */
        @media print {

            /* Hide every element you don't want to print */
            header,
            nav,
            footer,
            aside,
            sidebar,
            .print-button,
            .no-print {
                display: none;
            }

            /* Ensure the main content stretches to full width */
            .main-content {
                width: 100%;
                margin: 0;
            }
        }
    </style>
    <?php require('style.php'); ?>

    <body>
        <nav>
            <div class="navbar">
                <h3>RATRAPHEE</h3>
                <a></a>
                <a></a>
                <h6><?php echo $_SESSION['user'] ?></h6>
            </div>
        </nav>
        <div class="row">
            <div class="col-2">
                <sidebar>
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
            </sidebar>
            <main class="col-10">
                <div class="container">
                    <div class="row">

                        <div class="container text-center">
                            <br><br>
                            <div class="row">
                                <div class="col-10">
                                    <h3>รายการชำระเงิน</h3>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <a>เลขที่บิล <?php echo $row['bib_b'] ?> <br />ห้อง <?php echo $row['bib_r'] ?> เดือน <?php echo $row['name_m'] ?><br />ผู้เช่า <?php echo $row['fname'] ?> <?php echo $row['lname'] ?></a>
                            <br>
                            <div class="col-10">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">เลขครั้งนี้</th>
                                            <th scope="col">เลขครั้งก่อน</th>
                                            <th scope="col">หน่วยที่ใช้</th>
                                            <th scope="col">หน่วย</th>
                                            <th scope="col">จำนวนเงิน</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1.ค่าน้ำ</td>
                                            <td style="text-align: center"><?php echo $row['after_wather'] ?></td>
                                            <td style="text-align: center"><?php echo $row['befor_wather'] ?></td>
                                            <td style="text-align: center"><?php echo $value_wather_user ?></td>
                                            <td style="text-align: center"><?php echo $rowvalue['wather_value_rate'] ?></td>
                                            <td style="text-align: right"><?php echo number_format($wather_price) ?></td>

                                        </tr>
                                        <tr>
                                            <td>2.ค่าไฟ</td>
                                            <td style="text-align: center"><?php echo $row['after_electricity'] ?></td>
                                            <td style="text-align: center"><?php echo $row['befor_electricity'] ?></td>
                                            <td style="text-align: center"><?php echo $value_electricity_use ?></td>
                                            <td style="text-align: center"><?php echo $rowvalue['electricity_value_rate'] ?></td>
                                            <td style="text-align: right"><?php echo number_format($electricity_price) ?></td>
                                        </tr>
                                        <tr>
                                            <td>3.ค่าห้อง</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td style="text-align: right"><?php echo number_format($row['price_b']) ?></td>
                                        </tr>
                                        <tr>
                                        <td colspan="5" style="text-align: center; font-weight: bold;">รวม</td>
                                            <td style="text-align: right"><?php echo number_format($row['price_all']) ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-9 text-center">
                                <div class="row">
                                    <div class="col">
                                        <a>ผู้รับเงิน<br><br>........................<br>(<?php echo $_SESSION['user'] ?>)</a>
                                    </div>
                                    <div class="col">
                                        <a>ผู้จ่ายเงิน<br><br>........................<br>(<?php echo $row['fname'] ?> <?php echo $row['lname'] ?>)</a>
                                    </div>
                                </div>
                            </div>
                            <button onclick="window.print()" class="btn btn-primary print-button">พิมพ์</button>

                        </div>

                        <div class="col-">
                            <br>

                        </div>
                    </div>
                </div>
                </maim>
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