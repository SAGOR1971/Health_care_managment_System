<?php include 'connect.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
    <!-- CSS File -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        .display_product {
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        .delete_product_btn, .update_product_btn {
            display: inline-block;
            padding: 8px 12px;
            margin: 4px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        .delete_product_btn {
            color: white;
            background-color: red;
        }
        .update_product_btn {
            color: white;
            background-color: green;
        }
        .delete_product_btn:hover {
            background-color: darkred;
        }
        .update_product_btn:hover {
            background-color: darkgreen;
        }
        img {
            width: 50px;
            height: 50px;
            border-radius: 5px;
        }
        .empty_text {
            text-align: center;
            color: red;
            font-size: 18px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <!-- Include header -->
    <?php include('header.php') ?>
    <div class="container">
        <section class="display_product">
            <table>
                <tbody>
                    <?php
                    $display_product = mysqli_query($conn, "SELECT * FROM `products`");
                    $num = 1;
                    if (mysqli_num_rows($display_product) > 0) {
                        echo "<thead>
                        <th>Sl No</th>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Action</th>
                        </thead>";
                        while ($row = mysqli_fetch_assoc($display_product)) {
                    ?>
                            <tr>
                                <td><?php echo $num; ?></td>
                                <td><img src="images/<?php echo $row['image'] ?>" alt="<?php echo $row['name']; ?>"></td>
                                <td><?php echo $row['name']; ?></td>
                                <td>$<?php echo number_format($row['price'], 2); ?></td>
                                <td>
                                    <a href="delete.php?delete=<?php echo $row['id']; ?>" class="delete_product_btn" onclick="return confirm('Are you sure?');">
                                        <i class="fas fa-trash"></i> Delete</a>
                                    <a href="update.php?edit=<?php echo $row['id']; ?>" class="update_product_btn">
                                        <i class="fas fa-edit"></i> Edit</a>
                                </td>
                            </tr>
                    <?php
                            $num++;
                        }
                    } else {
                        echo "<div class='empty_text'>No Products Available</div>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </div>
</body>

</html>
