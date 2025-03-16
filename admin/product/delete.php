<?php
include '../../connect/config.php';

$id = $_GET['id'];

// First get the product name
$query = "SELECT Pname FROM tblproduct WHERE Id='$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
$product_name = $row['Pname'];

// Delete all entries of this product (both Home and original category)
$delete_query = "DELETE FROM tblproduct WHERE Pname='$product_name'";

if (mysqli_query($con, $delete_query)) {
    echo "<script>
        alert('Product deleted successfully from all categories!');
        window.location.href='view_products.php';
    </script>";
} else {
    echo "<script>
        alert('Error deleting product: " . mysqli_error($con) . "');
        window.location.href='view_products.php';
    </script>";
}
?>
