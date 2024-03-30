<?php
require('connect.php');

session_start();

if (!$_SESSION['userid']) {
    header("Location: index.php");
} else {

    $sql = "SELECT * FROM value_rate";
    $result = mysqli_query($conn, $sql);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>RATRAPHEE</title>
        <meta content="" name="description">
        <meta content="" name="keywords">

        <!-- Favicons -->
        <link href="../assets/img/favicon.png" rel="icon">
        <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


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
                <h6><?php echo $_SESSION['user'] ?></6>
            </div>
            <div class="row">
                <div class="col-2">
                    <div class="sidebar">
                        <ul>
                            <li><a href="admin_page.php"><i class="fa-solid fa-house"></i> หน้าแรก</a></li>
                            <li><a href="userlist.php"><i class="fa-solid fa-user-pen"></i> ข้อมูลผู้เช่า</a></li>
                            <li><a href="pay_bill.php"><i class="fa-solid fa-file-invoice-dollar"></i> ออกบิลค่าห้อง</a></li>
                            <li><a href="show_bill.php"><i class="fa-solid fa-file-invoice"></i> บิลค่าห้อง</a></li>
                            <li><a href="pay_value.php"><i class="fa-solid fa-file-invoice"></i> แนบบิลค่าห้อง</a></li>
                            <li><a href="pay_complead.php"><i class="fa-solid fa-money-bill"></i> รายการชำระเงินแล้ว</a></li>
                            <li><a href="checkout.php"><i class="fa-solid fa-person-circle-minus"></i> แจ้งย้ายออก</a></li>
                            <li><a href="waitingout.php"><i class="fa-solid fa-person-circle-exclamation"></i> รอย้ายออก</a></li>
                            <li><a href="checkoutsucceed.php"><i class="fa-solid fa-person-circle-check"></i> ย้ายออกแล้ว</a></li>
                            <li><a href="adminlist.php"><i class="fa-solid fa-gear"></i> จัดการข้อมูลแอดมิน</a></li>
                            <li><a href="roomstatus.php"><i class="fa-solid fa-gear"></i> จัดการข้อมูลห้องพัก</a></li>
                            <li><a href="room_type.php"><i class="fa-solid fa-gear"></i> จัดการประเภทห้องพัก</a></li>
                            <li><a href="rate_current.php"><i class="fa-solid fa-gear"></i> จัดการเรทค่าน้ำ ค่าไฟ</a></li>
                            <li><a href="logout.php" onclick="return confirmLogout()"><i class="fa-solid fa-right-from-bracket"></i> ออกจากระบบ</a></li>
                        </ul>
                    </div>
                </div>
                </sidebar>
                <main class="col-10">
                    <div class="container">
                    </br></br>
                    <div class="row" style="display: grid; grid-template-columns: auto 1fr;">
                        <div class="col">
                            <h2 style="margin-right: auto;">จัดการเรทค่าน้ำค่าไฟ</h2>
                        </div>
                        <div class="col col-lg-2">
                        </div>
                        <div class="col"></div>
                    </div>
                </div>
                    <div class="col-3">
                        
                        <table class="table table-bordered">
                            <thead>
                                <th>ค่าน้ำ</th>
                                <th>ค่าไฟ</th>
                                <th>แก้ไข</th>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td style="text-align: center"><?php echo $row['wather_value_rate'] ?></td>
                                        <td style="text-align: center"><?php echo $row['electricity_value_rate'] ?></td>
                                        <td style="text-align: center"><a href="edit_rate.php?id_rate=<?php echo $row["id_rate"] ?>" class="btn btn-warning">แก้ไข</a></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                    </div>
                </main>
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