<?php
require('connect.php');

session_start();

if (!$_SESSION['userid']) {
    header("Location: index.php");
} else {

    $sql = "SELECT month_income, value_income FROM income";
    $result = mysqli_query($conn, $sql);

    // ตรวจสอบว่ามีข้อมูลหรือไม่
    if (mysqli_num_rows($result) > 0) {
        // สร้างตัวแปร JavaScript สำหรับเก็บข้อมูลรายได้ในแต่ละเดือน
        $data = "['Month', 'Income'],";

        // เริ่มต้นวนลูปเพื่อดึงข้อมูลและสร้างข้อมูล JavaScript
        while ($row = mysqli_fetch_assoc($result)) {
            $data .= "['" . $row['month_income'] . "', " . $row['value_income'] . "],";
        }

        // ลบเครื่องหมาย comma สุดท้าย
        $data = rtrim($data, " ");

        $sqldata = "SELECT * FROM income a INNER JOIN menstrual b ON a.month_income=b.id_m";
        $resultdata = mysqli_query($conn, $sqldata);
    } else {
        echo "ไม่พบข้อมูลรายได้";
    }
    $sql2 = "SELECT status_b, COUNT(*) as count FROM bill GROUP BY status_b";
    $result2 = mysqli_query($conn, $sql2);

    // Initialize an array to store the counts
    $status_counts = array('1' => 0, '2' => 0, '3' => 0);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row2 = mysqli_fetch_assoc($result2)) {
            $status_counts[$row2["status_b"]] = $row2["count"];
        }
    } else {
        echo "0 results";
    }


    // Calculate the total counts
    $total_count = array_sum($status_counts);

    // Calculate the percentages
    $status_percentages = array_map(function ($count) use ($total_count) {
        return ($count / $total_count) * 100;
    }, $status_counts);

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
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


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

                        <div class="container-md text-center">
                            <br><br><br>
                            <div class="row">
                                <div class="col-6">
                                    <h4>ตารางแสดงรายได้ของแต่ละเดือน</h4>
                                </div>


                                <div class="col-6 ">
                                    <h4>กราฟแสดงรายได้ของแต่ละเดือน</h4>
                                </div>
                            </div>
                        </div>
                        <div class="container-md">
                            <div class="row">
                                <div class="col-6">
                                    <table class="table table-bordered">
                                        <thead style="background-color: #B198B4">
                                            <th style="width: 400px;">เดือน</th>
                                            <th>รายได้</th>

                                        </thead>
                                        <tbody>
                                            <?php
                                            $total_income = 0;
                                            while ($rowdata = mysqli_fetch_assoc($resultdata)) {
                                                $total_income += $rowdata['value_income'];
                                            ?>
                                                <tr style="background-color: #fff;">
                                                    <td><?php echo $rowdata['name_m'] ?></td>
                                                    <td style="text-align: right"><?php echo number_format($rowdata['value_income']) ?></td>

                                                </tr>
                                            <?php } ?>
                                            <tr style="background-color: #fff;">
                                                <td><strong>ยอดรวม</strong></td>
                                                <td style="text-align: right"><strong><?php echo number_format($total_income); ?></strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-6">

                                    <div class="container">
                                        <div id="curve_chart" style="width: 100%; height: 500px; margin-top: 20px;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-4"></div>
                                <div class="col-4">
                                    <canvas id="myPieChart" width="400" height="400"></canvas>
                                    <br><br>
                                    <h4>แสดงสัดส่วนการจ่ายค่าที่พัก</h4>
                                </div>

                                <div class="col-4"></div>

                            </div>


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
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script src="../assets/js/main.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
                // โหลด Google Charts
                google.charts.load('current', {
                    'packages': ['corechart']
                });
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    // สร้างข้อมูลกราฟโดยใช้ข้อมูลที่ดึงมาจาก PHP
                    var data = google.visualization.arrayToDataTable([
                        <?php echo $data; ?>
                    ]);

                    // กำหนดตัวเลือกของกราฟ
                    var options = {
                        title: 'รายได้ในแต่ละเดือน',
                        curveType: 'function',
                        legend: {
                            position: 'bottom'
                        },
                        chartArea: {
                            width: '80%',
                            height: '70%'
                        }, // Adjust as needed
                        height: 500,
                    };

                    // สร้างกราฟและแสดงบนหน้าเว็บ
                    var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
                    chart.draw(data, options);

                    window.addEventListener('resize', function() {
                        chart.draw(data, options);
                    });
                }
                // แผนภูมิวงกลม

                var ctx = document.getElementById('myPieChart').getContext('2d');
                var myPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['ยังไม่ชำระ', 'ชำระแล้ว', 'เลยกำหนดชำระ'],
                        datasets: [{
                            data: [<?php echo $status_percentages['1']; ?>, <?php echo $status_percentages['2']; ?>, <?php echo $status_percentages['3']; ?>],
                            backgroundColor: ['#D3D3D3', '#7C597E ', '#B198B4']
                        }]
                    }
                });

                function confirmLogout() {
                    return confirm('ต้องการออกจากระบบใช่หรือไม่');
                }
            </script>

    </body>

    </html>

<?php } ?>