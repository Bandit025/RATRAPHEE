<?php
require('connect.php');

session_start();

if (!$_SESSION['userid']) {
    header("Location: index.php");
} else {

    $sql = "SELECT * FROM users WHERE urole = 1";
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
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&family=Prompt:wght@300&display=swap" rel="stylesheet">


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
            <div class="col-10  ">
                <div class="container">
                    <div class="row">
                    </div>
                </div>
                <div class="containor-md">
                    <div class="table-responsive">
                        <br><br>
                        <div class="container">
                            <div class="row">
                                <div class="col-2">
                                    <h2 style="text-align: life">ข้อมูลผู้ดูแล</h2>
                                </div>
                                <div class="col-2">
                                    <a   class="btn btn-secondary" href="register.php">เพิ่มผู้ดูแล</a>
                                </div>
                                <div class="col-3">
                                <label for="rowsPerPageSelect">แสดงจำนวนข้อมูลต่อหน้า:</label>
                                <select id="rowsPerPageSelect" onchange="changeRowsPerPage(this.value)">
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10"selected>10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                </select>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-7">
                                    <table class="table table-bordered">
                                        <thead>
                                            <th>id</th>
                                            <th>ชื่อ - สกุล</th>
                                            <th>Email</th>
                                            <th>รหัสผ่าน</th>
                                            <th>แก้ไข</th>
                                            <th>ลบ</th>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                                <tr style="background-color: #fff;">
                                                    <td><?php echo $row['id'] ?></td>
                                                    <td><?php echo $row['fname'] . " " . $row['lname'] ?> </td>
                                                    <td><?php echo $row['email'] ?></td>
                                                    <td><?php echo $row['password'] ?></td>
                                                    <td style="text-align: center"><a href="edit_user.php?id=<?php echo $row["id"] ?>" class="btn btn-warning">แก้ไข</a></td>
                                                    <td style="text-align: center">
                                                        <a href="#" onclick="confirmDelete('<?php echo $row['id']; ?>')" class="btn btn-danger">ลบ</a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <div id="pagination" style="margin-top: 20px;">
                                        <button class="btn btn-primary" id="prevBtn" onclick="prevPage()">ก่อนหน้า</button>
                                        <button class="btn btn-primary" id="nextBtn" onclick="nextPage()">ถัดไป</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div>
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
                var currentPage = 1;
                var rowsPerPage = 10;
                var tableRows = document.querySelectorAll('.table tbody tr');
                var totalPages = Math.ceil(tableRows.length / rowsPerPage);

                function showPage(page) {
                    var start = (page - 1) * rowsPerPage;
                    var end = start + rowsPerPage;

                    for (var i = 0; i < tableRows.length; i++) {
                        if (i >= start && i < end) {
                            tableRows[i].style.display = '';
                        } else {
                            tableRows[i].style.display = 'none';
                        }
                    }
                }

                function prevPage() {
                    if (currentPage > 1) {
                        currentPage--;
                        showPage(currentPage);
                    }
                }

                function nextPage() {
                    if (currentPage < totalPages) {
                        currentPage++;
                        showPage(currentPage);
                    }
                }

                // Show the initial page
                showPage(currentPage);

                function changeRowsPerPage(value) {
                    rowsPerPage = parseInt(value);
                    totalPages = Math.ceil(tableRows.length / rowsPerPage);
                    showPage(currentPage);
                }

                function confirmDelete(id) {
                    var result = confirm("คุณต้องการลบใช่หรือไม่?");
                    if (result) {
                        window.location.href = "delete_admin.php?id=" + id;
                        console.log(window.location.href);
                    } else {

                    }
                }
                function confirmLogout() {
                    return confirm('ต้องการออกจากระบบใช่หรือไม่');
                }
            </script>


    </body>

    </html>

<?php } ?>