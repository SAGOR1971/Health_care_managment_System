<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        /* Basic styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 0 20px;
        }

        /* Set exactly 4 cards per row */
        .card-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            position: relative;
        }

        .card img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 4px;
        }

        .card h5 {
            margin: 10px 0;
            font-size: 18px;
            color: #333;
        }

        .card p {
            font-size: 14px;
            color: #666;
            margin-bottom: 15px;
        }

        .quantity-input {
            width: 50px;
            text-align: center;
            padding: 5px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .btn {
            display: inline-block;
            padding: 8px 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        /* Make it responsive for smaller screens */
        @media (max-width: 768px) {
            .card-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .card-container {
                grid-template-columns: 1fr;
            }
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            width: 80%;
            max-width: 500px;
            text-align: center;
        }

        .modal-content img {
            width: 100%;
            height: auto;
            max-height: 400px;
        }

        .close-btn {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        .close-btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-warning font-monospace text-center">Home</h1>
        <div class="card-container">
            <?php
            include 'config.php';
            $Record = mysqli_query($con, "SELECT * FROM `tblproduct`");
            while ($row = mysqli_fetch_array($Record)) {
                $check_page = $row['Pcategory'];
                if ($check_page === 'Home') {
                    echo "
                    <form action='insert_cart.php' method='post'>
                        <div class='card'>
                            <div onclick='showProductDetails(\"$row[Pname]\", \"$row[Pprice]\", \"$row[Pimage]\", \"$row[Pdescription]\")'>
                                <img src='../admin/product/$row[Pimage]' alt='$row[Pname]'>
                                <h5>$row[Pname]</h5>
                                <p>Taka: $row[Pprice]</p>
                            </div>
                            <input type='hidden' name='Pname' value='$row[Pname]'>
                            <input type='hidden' name='Pprice' value='$row[Pprice]'>
                            <input type='number' name='Pquantity' min='1' max='20' value='1' class='quantity-input' onclick='stopPopup(event)'>
                            <input type='submit' name='addcart' class='btn btn-danger text-white w-100' value='Add To Cart' onclick='stopPopup(event)'>
                        </div>
                    </form>
                    ";
                }
            }
            ?>
        </div>
    </div>

    <!-- Modal for Product Details -->
    <div id="productModal" class="modal">
        <div class="modal-content">
            <img id="modalImage" src="" alt="">
            <h2 id="modalTitle"></h2>
            <p id="modalPrice"></p>
            <p id="modalDescription"></p>
            <button class="close-btn" onclick="closeModal()">Close</button>
        </div>
    </div>

    <script>
        // Function to display product details in the modal
        function showProductDetails(name, price, image, description) {
            document.getElementById("modalTitle").innerText = name;
            document.getElementById("modalPrice").innerText = "Price: " + price + " Taka";
            document.getElementById("modalImage").src = "../admin/product/" + image;
            document.getElementById("modalDescription").innerText = description;
            document.getElementById("productModal").style.display = "flex";
        }

        // Function to close the modal
        function closeModal() {
            document.getElementById("productModal").style.display = "none";
        }

        // Function to stop popup from showing when 'Add to Cart' button or quantity input is clicked
        function stopPopup(event) {
            event.stopPropagation();
        }
    </script>
    <?php include 'footer.php'; ?>
</body>

</html>
