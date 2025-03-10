<?php
$con = mysqli_connect('localhost', 'root', 'Vishal123', 'medical_store');

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['ID'])) {
    $id = $_GET['ID'];

    // Prevent SQL injection
    $id = mysqli_real_escape_string($con, $id);

    // Delete query
    $query = "DELETE FROM `tbluser` WHERE Id = '$id'";

    if (mysqli_query($con, $query)) {
        echo "<script>
                alert('Record deleted successfully');
                window.location.href = 'mystore.php';
              </script>";
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }
} else {
    echo "Invalid request.";
}

// Close connection
mysqli_close($con);
?>
