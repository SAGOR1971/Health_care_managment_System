<?php
session_start();
if(!$_SESSION['admin']){
    header("location:../form/login.php");
}
include('config.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Get the image name before deleting
    $select_query = "SELECT image FROM doctors WHERE id = $id";
    $result = mysqli_query($con, $select_query);
    $doctor = mysqli_fetch_assoc($result);
    
    // Delete the doctor record
    $delete_query = "DELETE FROM doctors WHERE id = $id";
    
    if(mysqli_query($con, $delete_query)) {
        // Delete the image file if it exists
        if($doctor['image'] && file_exists("upload/" . $doctor['image'])) {
            unlink("upload/" . $doctor['image']);
        }
        
        echo "<script>
            alert('Doctor deleted successfully!');
            window.location.href='view_doctors.php';
        </script>";
    } else {
        echo "<script>
            alert('Failed to delete doctor!');
            window.location.href='view_doctors.php';
        </script>";
    }
} else {
    header("location:view_doctors.php");
} 