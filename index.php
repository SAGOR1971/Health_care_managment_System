<?php
include 'connect.php'; // Include the database connection

if (isset($_POST['add_product'])) {
    // Retrieve product details from the form
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_FILES['product_image']['name'];
    $product_image_temp_name = $_FILES['product_image']['tmp_name'];

    // Define the folder where the uploaded image will be stored
    $product_image_folder = 'images/' . $product_image;

    // Insert product details into the database
    $insert_query = mysqli_query($conn, "INSERT INTO `products` (name, price, image) VALUES ('$product_name', '$product_price', '$product_image')") or die("Insert query Failed");

    if ($insert_query) {
        // Move the uploaded image to the folder
        move_uploaded_file($product_image_temp_name, $product_image_folder);
        $display_message = "Product Inserted Successfully";
    } else {
        $display_message ="There is some error inserting product";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 700px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
            border-radius: 5px;
        }
        .heading {
            text-align: center;
            color: #333;
        }
        .input_fields {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .submit_btn {
            width: 100%;
            padding: 10px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .submit_btn:hover {
            background: #218838;
        }
        .display_message {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            margin-bottom: 10px;
            border-left: 5px solid #28a745;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .display_message i {
            cursor: pointer;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<?php include('header.php') ?>

<div class="container">
    <?php
    if(isset($display_message)){
        echo "<div class='display_message'>
        <span>$display_message</span>
        <i class='fas fa-times' onclick='this.parentElement.style.display=`none`';></i>
        </div>";
    }
    ?>
    
    <section>
        <h3 class="heading">Add Products</h3>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="text" name="product_name" placeholder="Enter Product Name" class="input_fields" required>
            <input type="number" name="product_price" min="0" placeholder="Enter Product Price" class="input_fields" required>
            <input type="file" name="product_image" class="input_fields" required accept="image/png,image/jpg,image/jpeg">
            <input type="submit" name="add_product" class="submit_btn" value="Add Product">
        </form>
    </section>
</div>

</body>
</html>
