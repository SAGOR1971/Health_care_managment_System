<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Products</title>
    <!-- CSS File -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Fix navbar width */
        .header {
            width: 100%;
            background-color: #1a2b4c;
            padding: 15px 0;
            text-align: center;
        }

        .header_body {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: auto;
            padding: 0 20px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-weight: bold;
        }

        /* Update product form styling */
        .edit_container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }

        .edit_container form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 350px;
        }

        .edit_container img {
            width: 100px;
            height: auto;
            display: block;
            margin: auto;
        }

        .input_fields {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
        }

        .btns {
            display: flex;
            justify-content: space-between;
        }

        .edit_btn {
            background-color: green;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 48%;
        }

        .cancel_btn {
            background-color: red;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 48%;
        }
    </style>
</head>
<body>
    <?php include 'header.php'?>
    
    <section class="edit_container">
        <!-- form -->
        <form action="update_product.php" method="POST" enctype="multipart/form-data">
            <img src="images/default.jpg" alt="Product Image">
            <input type="hidden" name="product_id">
            <input type="text" name="product_name" class="input_fields fields" placeholder="Product Name" required>
            <input type="number" name="product_price" class="input_fields fields" placeholder="Enter Price" required>
            <input type="file" name="product_image" class="input_fields fields" required accept="image/*">
            <div class="btns">
                <input type="submit" class="edit_btn" value="Update Product">
                <input type="reset" id="close-edit" value="Cancel" class="cancel_btn">
            </div>
        </form>
    </section>
</body>
</html>
