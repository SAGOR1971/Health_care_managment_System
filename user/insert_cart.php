<?php
session_start();
include 'config.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $product_name = $_POST['Pname'];
    $product_price = $_POST['Pprice'];
    $product_quantity = $_POST['Pquantity'];

    // Check if the product is already in the cart
    $check_query = mysqli_query($con, "SELECT * FROM tblcart WHERE user_id = '$user_id' AND product_name = '$product_name'");
    if (mysqli_num_rows($check_query) > 0) {
        echo "<script>
        alert('Product Already Added');
        window.location.href='index.php';
        </script>";
    } else {
        // Insert the product into the database
        mysqli_query($con, "INSERT INTO tblcart (user_id, product_name, product_price, product_quantity) VALUES ('$user_id', '$product_name', '$product_price', '$product_quantity')");

        // Update the cart count in session immediately
        $cart_result = mysqli_query($con, "SELECT COUNT(*) AS count FROM tblcart WHERE user_id = '$user_id'");
        $cart_row = mysqli_fetch_assoc($cart_result);
        $_SESSION['cart_count'] = $cart_row['count'];

        header("location:view_cart.php");
    }
} else {
    header("location:form/login.php");
}
?>
