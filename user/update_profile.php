<?php
session_start();
include 'config.php';

if(!isset($_SESSION['user_id'])) {
    header("location: form/login.php");
    exit();
}

if(isset($_POST['update_profile'])) {
    $user_id = $_SESSION['user_id'];
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $number = mysqli_real_escape_string($con, $_POST['number']);
    $password = $_POST['password'];

    // Check if email already exists for other users
    $check_email = mysqli_query($con, "SELECT * FROM tbluser WHERE Email = '$email' AND Id != '$user_id'");
    if(mysqli_num_rows($check_email) > 0) {
        echo "<script>
            alert('Email already exists! Please use a different email.');
            window.location.href = 'index.php';
        </script>";
        exit();
    }

    // Update query based on whether password is being changed
    if(!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $update_query = "UPDATE tbluser SET 
                        username = '$username',
                        Email = '$email',
                        Number = '$number',
                        Password = '$hashed_password'
                        WHERE Id = '$user_id'";
    } else {
        $update_query = "UPDATE tbluser SET 
                        username = '$username',
                        Email = '$email',
                        Number = '$number'
                        WHERE Id = '$user_id'";
    }

    if(mysqli_query($con, $update_query)) {
        $_SESSION['user'] = $username; // Update session with new username
        echo "<script>
            alert('Profile updated successfully!');
            window.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('Failed to update profile. Please try again.');
            window.location.href = 'index.php';
        </script>";
    }
}
?> 