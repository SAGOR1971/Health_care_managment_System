<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['admin'])) {
    header("location:form/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home-Page</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        .dashboard-container {
            max-width: 900px;
            margin: 40px auto;
        }
        .dashboard-card {
            min-height: 100px;
        }
    </style>
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
<div class="dashboard-container text-center">
    <h2 class="mb-4">Dashboard</h2>
    <div class="row g-3">
        <div class="col-md-6">
            <a href="product/index.php" class="text-decoration-none">
                <div class="card bg-danger text-white dashboard-card d-flex align-items-center justify-content-center">
                    <h4 class="fw-bold">Add Product</h4>
                </div>
            </a>
        </div>
        <div class="col-md-6">
            <a href="product/view_products.php" class="text-decoration-none">
                <div class="card bg-danger text-white dashboard-card d-flex align-items-center justify-content-center">
                    <h4 class="fw-bold">View Products</h4>
                </div>
            </a>
        </div>
        <div class="col-md-6">
            <a href="doctors/add_doctors.php" class="text-decoration-none">
                <div class="card bg-success text-white dashboard-card d-flex align-items-center justify-content-center">
                    <h4 class="fw-bold">Add Doctors</h4>
                </div>
            </a>
        </div>
        <div class="col-md-6">
            <a href="doctors/view_doctors.php" class="text-decoration-none">
                <div class="card bg-success text-white dashboard-card d-flex align-items-center justify-content-center">
                    <h4 class="fw-bold">ViewDoctors</h4>
                </div>
            </a>
        </div>
        <div class="col-md-6">
            <a href="user.php" class="text-decoration-none">
                <div class="card bg-warning text-white dashboard-card d-flex align-items-center justify-content-center">
                    <h4 class="fw-bold">Users</h4>
                </div>
            </a>
        </div>
        <div class="col-md-6">
            <a href="doctors/user_appointments.php" class="text-decoration-none">
                <div class="card bg-info text-white dashboard-card d-flex align-items-center justify-content-center">
                    <h4 class="fw-bold">Users Appointments</h4>
                </div>
            </a>
        </div>
        <div class="col-md-6">
            <a href="manage_about.php" class="text-decoration-none">
                <div class="card bg-info text-white dashboard-card d-flex align-items-center justify-content-center">
                    <h4 class="fw-bold">Manage About Us</h4>
                </div>
            </a>
        </div>
        <div class="col-md-6">
            <a href="view_messages.php" class="text-decoration-none">
                <div class="card bg-info text-white dashboard-card d-flex align-items-center justify-content-center">
                    <h4 class="fw-bold">View Message</h4>
                </div>
            </a>
        </div>
    </div>
</div>
</body>
</html>
