<?php
require('connect.php');

session_start();

if (!$_SESSION['userid']) {
    header("Location: index.php");
} else {
    // $id = $_GET["id"];
    // $sql = "SELECT * FROM users WHERE urole = 1";
    // $result = mysqli_query($conn, $sql);
    // $row = mysqli_fetch_assoc($result);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>เพิ่มผู้เช่า</title>
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
                        <li><a href="pay_value.php">แนบบิลค่าห้อง</a></li>
                        <li><a href="show_bill.php">บิลค่าห้อง</a></li>
                        <li><a href="pay_complead.php">รายการชำระเงินแล้ว</a></li>
                        <li><a href="rate_current.php">จัดการเรคค่าน้ำค่าไฟ</a></li>
                        <li><a href="logout.php" onclick="return confirmLogout()">ออกจากระบบ</a></li>
                    </ul>
                </div>
            </div>
            <main class="col-10">
                <div class="container">
                    <div class="row">
                        <form id="myForm" action="register_user_db.php" method="post">
                            <div class="container text-center">
                                <br><br>
                                <div class="row">
                                    <div class="col">
                                    </div>
                                    <div class="col">
                                        <h1>เพิ่มข้อมูลผู้เช่า</h1>
                                        <br><br>
                                        <input type="hidden" class="form-control" name="id" ">
                                        <div class=" mb-3">
                                        <label for="fname" class="form-label">ชื่อจริง</label>

                                        <input type="text" class="form-control" name="fname">
                                    </div>
                                    <div class="mb-3">
                                        <label for="lname" class="form-label">นามสกุล</label>
                                        <input type="text" class="form-control" name="lname">
                                    </div>
                                    <div class="mb-3">
                                        <label for="lname" class="form-label">รหัสบัตรประชาชน13หลัก</label>
                                        <input type="text" class="form-control" name="id_card">
                                    </div>
                                    <div class="mb-3">
                                        <label for="lname" class="form-label">เบอร์โทรศัพท์</label>
                                        <input type="text" class="form-control" name="tel">
                                    </div>
                                    <div class="mb-3">
                                        <label for="Email" class="form-label">Email address</label>
                                        <input type="email" class="form-control" name="email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="Password" class="form-label">Password</label>
                                        <input type="password" class="form-control" name="pass">
                                    </div>
                                    <button type="submit" class="btn btn-primary">เพิ่มข้อมูล</button>
                                </div>
                                <div class="col">
                                </div>
                            </div>
                    </div>
                    <form>
                </div>
        </div>
        </div>
        </div><!-- End Frequently Asked Questions Section -->
        <!-- ======= Footer ======= -->
        <footer id="footer">

            <div class="footer-top">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-3 col-md-6 footer-contact">
                            <h3>RATRAPHEE</h3>
                            <p>
                                รัชรพี อพาร์ทเม้นท์ <br>
                                130/24 ซอยพูนสิน ตำบลรังสิต <br>
                                อำเภอธัญบุรี จังหวัดปทุมธานี 12110 <br><br>
                                <strong>เบอร์ติดต่อ:</strong> 06 4987 6532, 06 4987 6534 <br>
                                <strong>อีเมล:</strong> rp99apartment@gmail.com<br>
                            </p>
                        </div>

                        <div class="col-lg-3 col-md-6 footer-contact">
                            <h4>เวลาเปิด-ปิดทำการ</h4>
                            <p>
                                <strong>วันจันทร์ - วันศุกร์: </strong> เวลาทำการ 08.30 - 17.00 น. <br>
                                <strong>วันเสาร์: </strong> เวลาทำการ 09.00 - 15.00 น. <br>
                                <strong>วันอาทิตย์: </strong> ปิดทำการ <br><br>
                            </p>
                        </div>

                        <div class="col-lg-3 col-md-6 footer-links">
                            <h4>ช่องทางการติดต่อ</h4>
                            <div class="social-links mt-3">
                                <a href="https://www.facebook.com/RUW5052U/?locale=th_TH" target="_blank" class="facebook"><i class="bx bxl-facebook"></i></a>
                                <a href="mailto:rp99apartment@gmail.com" class="instagram"><i class="bx bxl-gmail"></i></a>
                                <a href="https://line.me/R/ti/p/@ruw5052u" target="_blank" class="google-plus"><i class="bi bi-line"></i></a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="container footer-bottom clearfix">
                <div class="copyright">
                    &copy; Copyright <strong><span>RATRAPHEE</span></strong>. Nook And Mo
                </div>
                <div class="credits">
                    <!-- All the links in the footer should remain intact. -->
                    <!-- You can delete the links only if you purchased the pro version. -->
                    <!-- Licensing information: https://bootstrapmade.com/license/ -->
                    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/ -->
                    Designed by <a href="">Nook And Mo</a>
                </div>
            </div>
        </footer><!-- End Footer -->

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
            document.getElementById('myForm').addEventListener('submit', function(event) {
                var fnameInput = document.getElementsByName('fname')[0].value;
                var lnameInput = document.getElementsByName('lname')[0].value;
                var idCardInput = document.getElementsByName('id_card')[0].value;
                var telInput = document.getElementsByName('tel')[0].value;
                var emailInput = document.getElementsByName('email')[0].value;
                var passInput = document.getElementsByName('pass')[0].value;

                if (!fnameInput || !lnameInput || !idCardInput || !telInput || !emailInput || !passInput) {
                    alert('กรุณากรอกข้อมูลให้ครบทุกช่อง');
                    event.preventDefault(); // หยุดการส่งฟอร์ม
                }
            });
            function confirmLogout() {
                    return confirm('ต้องการออกจากระบบใช่หรือไม่');
                }
        </script>

    </body>

    </html>

<?php } ?>