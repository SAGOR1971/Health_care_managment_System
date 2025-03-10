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
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
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
<div class="container">
    <div class="row">
        <div class="col-md-8 mt-4 m-auto">
            <div class="border border-primary p-3 rounded">
                <form action="insert.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <p class="text-center fw-bold fs-3 text-warning">Product Details</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" name="Pname" class="form-control" placeholder="Enter Product Name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product Price</label>
                        <input type="text" name="Pprice" class="form-control" placeholder="Enter Product Price" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Add Product Image</label>
                        <input type="file" name="Pimage" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Select Page Category</label>
                        <select class="form-select" name="Pages" required>
                            <option value="Medecine">Medicine</option>
                            <option value="Syrup">Syrup</option>
                            <option value="Equipment">Equipment</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product Description</label>
                        <textarea name="Pdescription" class="form-control" rows="4" placeholder="Enter Product Description" required></textarea>
                    </div>
                    <button name="submit" class="bg-danger fs-4 fw-bold my-3 form-control text-white">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html> 