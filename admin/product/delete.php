<?php
include 'config.php';

$id = $_GET['id'];

// Delete the product from the selected category
$query = "DELETE FROM tblproduct WHERE Id='$id'";

// Also delete the product from the "Home" category
$query_home = "DELETE FROM tblproduct WHERE Id='$id' AND Pcategory='Home'";

if (mysqli_query($con, $query) && mysqli_query($con, $query_home)) {
    header("Location: index.php");
} else {
    echo "Error deleting record: " . mysqli_error($con);
}
?>
