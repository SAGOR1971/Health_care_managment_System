<?php
session_start();
include 'config.php';

if(!isset($_SESSION['user_id'])) {
    header("location: form/login.php");
    exit();
}

if(isset($_POST['delete_account'])) {
    $user_id = $_SESSION['user_id'];
    $confirm_password = $_POST['confirm_password'];

    // Verify password
    $password_query = "SELECT Password FROM tbluser WHERE Id = '$user_id'";
    $password_result = mysqli_query($con, $password_query);
    $user = mysqli_fetch_assoc($password_result);

    if(password_verify($confirm_password, $user['Password'])) {
        // Delete all user related data
        mysqli_query($con, "DELETE FROM tblcart WHERE user_id = '$user_id'");
        mysqli_query($con, "DELETE FROM appointments WHERE user_id = '$user_id'");
        
        // Finally delete the user account
        $delete_query = "DELETE FROM tbluser WHERE Id = '$user_id'";
        if(mysqli_query($con, $delete_query)) {
            // Clear session and redirect to login
            session_destroy();
            echo "<script>
                alert('Your account has been successfully deleted.');
                window.location.href = 'form/login.php';
            </script>";
        } else {
            echo "<script>
                alert('Failed to delete account. Please try again.');
                window.location.href = 'index.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('Incorrect password! Account deletion cancelled.');
            window.location.href = 'index.php';
        </script>";
    }
}
?> 