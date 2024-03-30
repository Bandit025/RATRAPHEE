<?php
require('connect.php');

session_start();

if (!$_SESSION['userid']) {
    header("Location: index.php");
} else {

    $sql = "SELECT * FROM room a 
    INNER JOIN type_room b ON a.type_r = b.id_t
    INNER JOIN status_room c ON a.status_r = c.id_s
    INNER JOIN users d ON a.live_r=d.id
    WHERE status_r = 3 AND status_out = 3";
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
    <?php require('style.php');?>
    <body>
    <div class="navbar">
            <h3>RATRAPHEE</h3>
            <a></a>
            <a></a>
            <h6><?php echo $_SESSION['user'] ?></้>
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
            <main class="col-10">
                <div class="container">
                    <div class="row">
                    </div>
                </div>
                <div class="container">
                </br></br>
                            <div class="row" style="display: grid; grid-template-columns: auto 1fr;">
                                <div class="col-20">
                                    <h2>แจ้งย้ายออก</h2>
                                </div>
                                <div class="col-3">
                                <label for="rowsPerPageSelect">แสดงจำนวนข้อมูลต่อหน้า:</label>
                                <select id="rowsPerPageSelect" onchange="changeRowsPerPage(this.value)">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10"selected>10</option>
                                    <option value="11">11</option>
                                </select>
                                </div>
                                <div class="col"></div>
                            </div>
                        </div>
                <div class="col-7">   
                    <table class="table table-bordered">
                        <thead style="background-color: #7c597e;">
                            <th>หมายเลขห้อง</th>
                            <th>ประเภทห้อง</th>
                            <th>ชื่อผู้เช่า</th>
                            <th>ยอดค้าชำระ</th>
                            <th>แก้ไข</th>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr style="background-color: #fff;">
                                    <td style="text-align: center"><?php echo $row['bib_r'] ?></td>
                                    <td style="text-align: center"><?php echo $row['name_t'] ?></td>
                                    <td><?php echo $row['fname']." ".$row['lname'] ?></td>
                                    <?php if($row['outstanding']==0){?>
                                        <td style="text-align: center">ไม่มียอดค้างชำระ</td>
                                        <td style="text-align: center"><a href="checkout_form.php?id_r=<?php echo $row["id_r"] ?>" class="btn btn-danger">แจ้งย้ายออก</a>
                                        <?php }else{ ?>
                                    <td style="text-align: right"><?php echo number_format($row['outstanding']);?></td>
                                    <?php }?>

                                    

                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div id="pagination" style="margin-top: 20px;">
                        <button class="btn btn-primary" id="prevBtn" onclick="prevPage()">ก่อนหน้า</button>
                        <button class="btn btn-primary" id="nextBtn" onclick="nextPage()">ถัดไป</button>
                    </div>
                </div>
            </main>
        </section>

       <!-- End Footer -->

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
                    window.location.href = "delete_user.php?id=" + id;
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