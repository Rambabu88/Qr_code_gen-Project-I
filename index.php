<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Based Attendance System</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="resources/img/Attendance System.png" type="image/x-icon">
</head>

<body>
    <main>
        <section class="left">
            <div class="logo">
                <h2>Uni Bytes Attendance System</h2>
            </div>
            <img src="resources/img/img1.jpg" alt="">
        </section>
        <?php
        include("./database/dbconfig.php");
        if (isset($_POST["login"])) {
            $role = $_POST['role'];
            $email = $_POST['email'];
            $pass = $_POST['password'];
            // $con = mysqli_connect("localhost", "root", "", "qr_ats");
        
            if ($role == 'teacher') {
                $query = "select * from teacher where email='$email' AND password='$pass'";
                $result = $conn->query($query);
                // $row = mysqli_fetch_assoc($result);
                if ($result->num_rows > 0) {
                    header("location:./teacher/gen_qr.php");
                    exit;
                } else {
                    // $_SESSION['admin_name'] = $row['name'];
                    // $_SESSION['admin_email'] = $row['email'];
                    echo "<script>
            alert('Enter Valid Credencial')
        </script>";
                }
            }
            if ($role = 'student') {
                $query1 = "select * from student where email='$email' AND password='$pass'";
                $result1 = mysqli_query($conn, $query1);
                $row = mysqli_fetch_assoc($result1);
                if ($result1->num_rows > 0) {
                    header("location:./student/sc_qr.php");
                    exit;
                } else {
                    // $_SESSION['admin_name'] = $row['name'];
                    // $_SESSION['admin_email'] = $row['email'];
                    echo "<script>
            alert('Enter Valid Credencial')
        </script>";
                }
            }
        }
        ?>
        <section class="right">
            <form id="form" method="POST" action="">
                <h2>Select Your Role</h2>
                <input type="radio" name="role" id="teacher_radio" onchange="checkRadio()" value="teacher" required>
                <label for="teacher_radio">Teacher</label>

                <input type="radio" name="role" id="student_radio" onchange="checkRadio()" value="student" required>
                <label for="student_radio">Student</label>

                <div class="input_area">
                    <input type="email" placeholder="Enter Email" name="email" required>
                    <img src="resources/img/mail.png" alt="">
                </div>
                <div class="input_area">
                    <input type="password" placeholder="Enter Password" name="password" required>
                    <img src="resources/img/padlock.png" alt="">
                </div>
                <button class="button_submit" name="login">Login</button>
                <div class="msg">New Student? <a href="register.php">Register here</a></div>
                <!-- <div class="msg">New Teacher? <a href="./admin/add_teacher.php">Register here</a></div> -->
            </form>
        </section>
    </main>
    <script>
        // function checkRadio(){
        //     let form = document.getElementById("form");
        //     if(document.getElementById("teacher_radio").checked){
        //         form.setAttribute("action", "teacher/index.php");
        //     }
        //     if(document.getElementById("student_radio").checked){
        //         form.setAttribute("action", "student/index.php");
        //     }
        // }
    </script>
</body>

</html>