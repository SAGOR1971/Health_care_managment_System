<?php
include 'connect.php';
if(isset($_POST['add_to_cart'])){
    $products_name=$_POST['product_name'];
    $products_name=$_POST['product_price'];
    $products_name=$_POST['product_image'];
    $product_quantity=1;
    $insert_products=mysqli_query($conn,"insert into `cart`(name,price,image,quantity) values ('$products')");

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        /* HEADER STYLES */
        .header {
            background: #2c3e50;
            padding: 15px 20px;
            width: 100%;
            display: flex;
            justify-content: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header_body {
            width: 90%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
        }

        .company_Name {
            font-size: 24px;
            font-weight: bold;
            text-decoration: none;
            color: #ecf0f1;
        }

        .navbar {
            display: flex;
            gap: 20px;
        }

        .navbar a {
            text-decoration: none;
            color: #ecf0f1;
            font-size: 18px;
            transition: color 0.3s ease-in-out;
        }

        .navbar a:hover {
            color: #f39c12;
        }

        .cart {
            text-decoration: none;
            color: #ecf0f1;
            font-size: 22px;
            position: relative;
        }

        .cart-badge {
            background: red;
            color: white;
            font-size: 12px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            position: absolute;
            top: -5px;
            right: -10px;
        }

        /* CONTAINER AND PRODUCT SECTION */
        body {
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin-top: 20px;
            padding: 20px;
            background: white;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }

        .heading {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .product_container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .product_card {
            background: #ffffff;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
            width: 250px;
            height: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .product_card:hover {
            transform: scale(1.05);
        }

        .product_card img {
            width: 100%;
            height: 150px;
            object-fit: contain;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .product_card h3 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #2c3e50;
        }

        .price {
            font-size: 16px;
            font-weight: bold;
            color: #e74c3c;
            margin-bottom: 10px;
        }

        .submit_btn {
            display: inline-block;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            background: #27ae60;
            color: white;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.3s ease-in-out;
        }

        .submit_btn:hover {
            background: #219150;
        }

        /* RESPONSIVE DESIGN */
        @media (max-width: 768px) {
            .header_body {
                flex-direction: column;
                text-align: center;
            }

            .navbar {
                flex-direction: column;
                gap: 10px;
            }

            .product_container {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <header class="header">
        <div class="header_body">
            <a href="index.php" class="company_Name">Medical Store</a>
            <nav class="navbar">
                <a href="index.php">Add Products</a>
                <a href="view_products.php">View Products</a>
                <a href="">Shopit</a>
            </nav>
            <a href="" class="cart">
                <i class="fa-solid fa-cart-shopping"></i>
                <span class="cart-badge">4</span>
            </a>
        </div>
    </header>

    <div class="container">
        <section class="products">
            <h1 class="heading">Let's Shop</h1>
            <div class="product_container">
                <form method="post" action="">
                    <div class="product_card">
                        <img src="images/napa_1.jpeg" alt="Napa 1">
                        <h3>Napa 1</h3>
                        <div class="price">Price: $2/-</div>
                        <input type="hidden" name="product_name">
                        <input type="hidden" name="product_price">
                        <input type="hidden" name="product_image">
                        <input type="submit" class="submit_btn cart_btn" value="Add to Cart">
                    </div>
                </form>
            </div>
        </section>
    </div>

</body>

</html>