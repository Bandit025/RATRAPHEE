<?php
require('connect.php');

session_start();

if (!$_SESSION['userid']) {
    header("Location: index.php");
} else {
    $id_r = $_GET["id_r"];
    $sql = "SELECT * FROM room a 
    INNER JOIN type_room b ON a.type_r = b.id_t
    INNER JOIN status_room c ON a.status_r = c.id_s
    INNER JOIN users d ON a.live_r=d.id 
    WHERE id_r= $id_r";
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

        <title>รายละเอียดห้อง</title>
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
                        <form id="myForm" action="pay_bill_form_db.php" method="post">
                            <div class="container text-center">
                                <br><br>
                                <div class="row">
                                    <div class="col"></div>
                                    <div class="col">
                                        <h1>รายละเอียดห้องพัก</h1>
                                    </div>
                                    <div class="col"></div>
                                </div>
                            </div>
                            <div class="container text-center">
                                <div class="row">
                                    <div class="col">
                                        <input type="hidden" class="form-control" name="id_r" value="<?php echo $id_r ?>">
                                        <input type="hidden" class="form-control" name="live_r" value="<?php echo $row['live_r']; ?>">
                                        <div class="mb-3">
                                            <label for="fname" class="form-label">หมายเลขห้อง</label>
                                            <input type="text" class="form-control" name="bib_r" value="<?php echo $row['bib_r'] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="fname" class="form-label">ชื่อผู้ทำสัญญา</label>
                                            <?php
                                            if ($row['live_r'] == 0) { ?>
                                                <input type="text" class="form-control" name="live_r" value="ไม่มี">
                                            <?php } else { ?>
                                                <input type="text" class="form-control" name="live_r" value="<?php echo $row['fname'] ?> <?php echo $row['lname'] ?>" disabled>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="fname" class="form-label">ประเภทห้อง</label>
                                            <input type="text" class="form-control" name="type_r" value="<?php echo $row['name_t'] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="fname" class="form-label">เลขมิเตอร์น้ำครั้งก่อน</label>
                                            <input type="text" class="form-control" name="wather" value="<?php echo $row['wather'] ?>">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="fname" class="form-label">ราคา</label>
                                            <input type="text" class="form-control" name="Price_t" value="<?php echo $row['Price_t'] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="fname" class="form-label">เลขมิเตอร์ไฟครั้งก่อน</label>
                                            <input type="text" class="form-control" name="electricity" value="<?php echo $row['electricity'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="fname" class="form-label">รอบบิล</label>
                                        <select class="form-select" aria-label="Default select example" name="menstrual_cycle">
                                            <option selected value="0">เลือกรอบบิล</option>
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
                                            <option value="12">ธันวาคม</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="fname" class="form-label">เลขมิเตอร์น้ำครั้งนี้</label>
                                        <input type="text" class="form-control" name="after_wather">
                                    </div>
                                    <div class="col">
                                        <label for="fname" class="form-label">เลขมิเตอร์ไฟครั้งนี้</label>
                                        <input type="text" class="form-control" name="after_electricity">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="datePicker">กำหนดจ่าย</label>
                                            <input type="date" id="datePicker" class="form-control" name="dateline">
                                        </div>

                                    </div>
                                    <div class="col">
                                        <div class="mb-3"></br>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                    <div class="col">

                                    </div>
                                </div>
                            </div>

                        </form>
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
    document.getElementById('myForm').addEventListener('submit', function(event) {
        var bib_rInput = document.getElementsByName('bib_r')[0].value;
        var watherInput = document.getElementsByName('wather')[0].value;
        var Price_tInput = document.getElementsByName('Price_t')[0].value;
        var electricityInput = document.getElementsByName('electricity')[0].value;
        var menstrual_cycleInput = document.getElementsByName('menstrual_cycle')[0].value;
        var after_watherInput = document.getElementsByName('after_wather')[0].value;
        var after_electricityInput = document.getElementsByName('after_electricity')[0].value;
        var datelineInput = document.getElementsByName('dateline')[0].value;
        
        if (!bib_rInput || !watherInput || !Price_tInput || !electricityInput || menstrual_cycleInput === '0' || !after_watherInput || !after_electricityInput || !datelineInput) {
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