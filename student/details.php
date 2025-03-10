<?php
session_start();

// Database connection
$con = mysqli_connect("localhost", "root", "", "qr_ats");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if a student is logged in
if (!isset($_SESSION["student_name"])) {
    header("location:../index.php");
    exit();
}

// Get student roll number
$student_rollno = $_SESSION["rollno"];

// Fetch student attendance records
$query = "SELECT id, s_id, s_name, subject, section, rollno, date FROM attendance WHERE rollno='$student_rollno'";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/style.css" />
    <style>
        .h {
            position: absolute;
            left: 0px;
            z-index: -10;
        }
    </style>
</head>

<body>
    <?php 
    $title = 'Attendance System';
    $username = $_SESSION['student_name'];
    include "../componets/header.php";
    ?>
    
    <div id="box">
        <a href="../logout.php">Logout</a>
    </div>
    
    <div class="container">
        <table class="h">
            <tr>
                <th>ID</th>
                <th>Student ID</th>
                <th>Name</th>
                <th>Subject</th>
                <th>Section</th>
                <th>Roll No</th>
                <th>Date</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                    <td>{$row["id"]}</td>
                    <td>{$row["s_id"]}</td>
                    <td>{$row["s_name"]}</td>
                    <td>{$row["subject"]}</td>
                    <td>{$row["section"]}</td>
                    <td>{$row["rollno"]}</td>
                    <td>{$row["date"]}</td>
                </tr>";
            }
            ?>
        </table>
    </div>
    
    <script src="../js/qrcode.js"></script>
    <script>
        var show = 0;
        function showBox() {
            var box = document.getElementById('box');
            if (show == 0) {
                box.style.height = "100px";
                show = 1;
            } else {
                box.style.height = "0px";
                show = 0;
            }
        }
    </script>
</body>
</html>