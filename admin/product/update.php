<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("location:../form/login.php");
    exit();
}

include 'config.php';
$id = $_GET['id'];

if (isset($_POST['update'])) {
    $Pname = $_POST['Pname'];
    $Pprice = $_POST['Pprice'];
    $Pcategory = $_POST['Pages'];
    
    if (!empty($_FILES['Pimage']['name'])) {
        $image = "uploads/" . basename($_FILES['Pimage']['name']);
        move_uploaded_file($_FILES['Pimage']['tmp_name'], $image);
        $query = "UPDATE tblproduct SET Pname='$Pname', Pprice='$Pprice', Pimage='$image', Pcategory='$Pcategory' WHERE Id='$id'";
    } else {
        $query = "UPDATE tblproduct SET Pname='$Pname', Pprice='$Pprice', Pcategory='$Pcategory' WHERE Id='$id'";
    }

    if (mysqli_query($con, $query)) {
        // Also update in "Home" category
        $home_query = "UPDATE tblproduct SET Pname='$Pname', Pprice='$Pprice', Pimage='$image', Pcategory='Home' WHERE Id='$id'";
        mysqli_query($con, $home_query);

        header("Location: index.php");
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
}

$result = mysqli_query($con, "SELECT * FROM tblproduct WHERE Id='$id'");
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <div class="container mt-5">
        <h2 class="text-center text-warning">Update Product</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Product Name</label>
                <input type="text" name="Pname" class="form-control" value="<?= $row['Pname'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Product Price</label>
                <input type="text" name="Pprice" class="form-control" value="<?= $row['Pprice'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Product Image</label>
                <input type="file" name="Pimage" class="form-control">
                <img src="<?= $row['Pimage'] ?>" height="90px" width="100px">
            </div>
            <div class="mb-3">
                <label class="form-label">Select Page Category</label>
                <select class="form-select" name="Pages">
                    <option value="Home" <?= $row['Pcategory'] == 'Home' ? 'selected' : '' ?>>Home</option>
                    <option value="Medecine" <?= $row['Pcategory'] == 'Medecine' ? 'selected' : '' ?>>Medecine</option>
                    <option value="Syrup" <?= $row['Pcategory'] == 'Syrup' ? 'selected' : '' ?>>Syrup</option>
                    <option value="Equipment" <?= $row['Pcategory'] == 'Equipment' ? 'selected' : '' ?>>Equipment</option>
                </select>
            </div>
            <button name="update" class="btn btn-success">Update Product</button>
        </form>
    </div>
</body>
</html>
