<?php
session_start();
include('../../connect/config.php');

$A_name = $_POST['username'];
$A_password = $_POST['userpassword'];

$result = mysqli_query($con, "SELECT * FROM `admin` WHERE username ='$A_name' AND userpassword='$A_password'");

if (mysqli_num_rows($result)) {
    $_SESSION['admin'] = $A_name;
    echo "
         <script>
         alert('Login Successful');
         window.location.href = '../mystore.php';
         </script>
    ";
} else {
    echo "
    <script>
    alert('Invalid username/password');
    window.location.href = 'login.php';
    </script>
    ";
}
?>
