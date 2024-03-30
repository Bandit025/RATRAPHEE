<style>
    .navbar h3 {
        float: left;
        display: block;
        color: white;
        /* Text color for links */
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    .navbar h6 {
        float: left;
        display: block;
        color: white;
        /* Text color for links */
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        color: white;
    }

    .navbar a:hover {
        background-color: #ddd;
        /* Background color for links when hovered */
        color: black;
        /* Text color for links when hovered */
    }

    .navbar {

        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
        overflow: hidden;
        background-color: #7C597E;
        transition: top 0.3s;
        top: 0;
        width: 100%;

    }

    /* Navbar links */
    .navbar a {
        float: left;
        font-size: 16px;
        color: white;
        text-align: center;
        padding: 14px 20px;
        text-decoration: none;
    }

    body,
    html {
        height: 100%;
        margin: 0;
        font-family: Arial, sans-serif;
        font-size: 13px;
    }

    .sidebar {
        height:  1100px;
        width: 180px;
        /* Adjust width as required */
        z-index: 1;
        top: 0;
        left: 0;
        background-color: #B198B4;
        /* Shade of purple */
        overflow-x: hidden;
        padding-top: 20px;
    }

    .sidebar h1 {
        color: white;
        padding: 6px 16px;
    }

    .sidebar ul {
        list-style-type: none;
        padding: 0;
    }

    .sidebar a {
        padding: 10px 15px;
        text-decoration: none;
        font-size: 15px;
        color: white;
        display: block;
    }

    .sidebar a:hover {
        background-color: #7C597E;
        /* Lighter purple for hover effect */
    }

    .main-content {
        margin-left: 250px;
        /* Same as sidebar width */
        padding: 0px 10px;
    }

    .login-button {
        text-align: right;
        padding: 20px;
    }

    .login-button a {
        text-decoration: none;
        color: #9575CD;
        /* Same as sidebar color */
        font-size: 18px;
    }

    .il {
        list-style: none;
        text-decoration: none;
        padding: 0.5rem;
        font-size: 1.2rem;
        border-radius: 0.5rem;
        margin-bottom: 0.5rem;

    }

    .chart-container {
        overflow: hidden;
        /* This will hide any content that overflows */
        /* or */
        overflow: auto;
        /* This will add scrollbars to the container */
    }

    .content {
        margin-top: 50px;
        /* สำหรับความสูงของ Navbar */
        height: 1000px;
        /* ตัวอย่างเท่านั้น */
    }

    .content div {
        height: 500px;
        padding: 20px;
        margin-bottom: 20px;
        border: 1px;
    }

    th {
        text-align: center;
    }

    .table-bordered {
        border: 1px solid #ddd;
        /* เส้นขอบสีเทา */
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #ddd;
        /* เส้นขอบสีเทา */
        padding: 8px;
        /* ระยะห่างของข้อความจากขอบ */
    }

    .table-bordered thead th {
        border-top: 2px solid #ddd;
        background-color: #B198B4;
        color: white;
        /* สีข้อความเป็นขาว */
    }
    .btn-warning-none {
        background-color: #f0ad4e; /* เปลี่ยนสีพื้นหลังเป็นสีเหลืองเข้ม */
        opacity: 0.5; /* ลดความโปร่งใสของปุ่ม */
    }
    .btn-success-none {
        background-color: #f0f0f0; /* เปลี่ยนสีพื้นหลังของปุ่มเป็นสีเทาอ่อนหรือสีใดก็ได้ที่คุณต้องการ */
        color: #000; /* เปลี่ยนสีตัวอักษรของปุ่ม */
        border-color: #f0f0f0; /* เปลี่ยนสีเส้นขอบของปุ่มเป็นสีเท่าเดิม */
    }
</style>