<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("location:form/login.php");
    exit();
}

// Database Connection
include('product/config.php');

// Fetch Records
$Record = mysqli_query($con, "SELECT * FROM `tbluser`");
$row_count = mysqli_num_rows($Record);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
<nav class="navbar navbar-light bg-primary">
    <div class="container-fluid text-white">
        <a href="mystore.php" class="navbar-brand text-white">
            <h1>Medical Store</h1>
        </a>
        <span>
            <i class="fa-solid fa-user-tie"></i> Hello, <?php echo $_SESSION['admin']; ?> |
            <i class="fa-solid fa-right-from-bracket"></i>
            <a href="form/logout.php" class="text-decoration-none text-white">Logout</a> |
            <a href="../user/index.php" class="text-decoration-none text-white">Users Panel</a>
        </span>
    </div>
</nav>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-10">
                <table class="table table-secondary table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>SL NO</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Number</th>
                            <th>Delete</th>
                        </tr>
                    </thead>

                    <tbody class="text-center text-danger">
                        <?php
                        while ($row = mysqli_fetch_array($Record)) {
                            echo "
                                <tr>
                                    <td>{$row['Id']}</td>
                                    <td>{$row['username']}</td>
                                    <td>{$row['Email']}</td>
                                    <td>{$row['Number']}</td>
                                    <td><a href='delete.php?ID={$row['Id']}' class='btn btn-outline-danger'>Delete</a></td>
                                </tr>
                            ";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-2 pr-5 text-center">
                <h3 class="text-danger">Total</h3>
                <h1 class="bg-danger text-white"><?php echo $row_count; ?></h1>
            </div>
        </div>
    </div>
</body>
</html>
