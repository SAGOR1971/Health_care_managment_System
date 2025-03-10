<?php
include 'config.php';
session_start();
if (!isset($_SESSION['admin'])) {
    header("location:../form/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        .table-container {
            padding: 15px;
            border-radius: 8px;
        }
        .table img {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 3px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-light bg-primary">
  <div class="container-fluid text-white">
    <a href="../mystore.php" class="navbar-brand text-white"><h1>Medical Store</h1></a>
    <span>
    <i class="fa-solid fa-user-tie"></i>
    Hello, <?php echo $_SESSION['admin']; ?> |
    <i class="fa-solid fa-right-from-bracket"></i>
    <a href="../form/login.php" class="text-decoration-none text-white">Logout</a> |
    <a href="../../user/index.php" class="text-decoration-none text-white">Users Panel</a>
    </span>
  </div>
</nav>
<div class="container mt-4">
    <div class="table-container">
        <table class="table table-hover table-bordered">
            <thead class="bg-dark text-white fs-5 font-monospace text-center">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php
                $Record = mysqli_query($con, "SELECT * FROM `tblproduct`");
                $no = 1;
                while ($row = mysqli_fetch_array($Record)) {
                    echo "  
                        <tr>
                            <td>$no</td>
                            <td>$row[Pname]</td>
                            <td>$row[Pprice]</td>
                            <td><img src='$row[Pimage]' height='90px' width='100px'></td>
                            <td>$row[Pcategory]</td>
                            <td><a href='update.php?id=$row[Id]' class='btn btn-warning'>Update</a></td>
                            <td><a href='delete.php?id=$row[Id]' class='btn btn-danger' onclick='return confirm(\"Are you sure?\")'>Delete</a></td>
                        </tr>
                    ";
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html> 