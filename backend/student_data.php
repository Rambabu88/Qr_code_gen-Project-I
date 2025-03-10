<?php
$con = mysqli_connect("localhost", "root", "", "qr_ats");

$name = $_POST['name'];
$email = $_POST['email'];
$roll_no = $_POST['roll_no'];
$section = $_POST['section'];
$password = $_POST['password'];


// $query = "insert into student(name, email, roll_no, section, password) values('$name','$email','$roll_no','$section','$password')";

// try{
//     $result = mysqli_query($con,$query);
// }
// catch(mysqli_sql_exception $e){
//     echo "<script>
//     alert('Something went wrong!')
// </script>";
// }
$sql = "SELECT * FROM student where email = '$email' OR roll_no = '$roll_no'";
$checkemail = $con->query($sql);
// if()
if($checkemail->num_rows >0){
   echo' <script>
        alert("Email or roll_no Already Registered!")
        history.back()
    </script>';
// }elseif($result) {
  }  else{
    $query = "INSERT into student(name, email, roll_no, section, password) VALUES('$name','$email','$roll_no','$section','$password')";
if($con->query($query) === TRUE) {
// try{
//     $result = mysqli_query($con,$query);
// }
// catch(mysqli_sql_exception $e){
//     echo "<script>
//     alert('Something went wrong!')
// </script>";
// }
    echo '
    <script>
        alert("Registration successfull!")
        // history.back()
        window.location.href = "../index.php";
    </script>
';
}else{
    echo '
        <script>
            alert("Email & Combination of Roll No & Section Must Unique!")
            history.back()
        </script>
    ';
}
  }

?>