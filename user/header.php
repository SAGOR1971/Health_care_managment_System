<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'config.php';

$count = 0;
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $result = mysqli_query($con, "SELECT COUNT(*) AS count FROM tblcart WHERE user_id = '$user_id'");
    $row = mysqli_fetch_assoc($result);
    $count = $row['count'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
    <nav class="navbar navbar-light bg-dark text-white">
        <div class="container-fluid">
            <a href="about.php" class="navbar-brand fw-bold"><img src="logo.png" width="90px" alt="logo"></a>
            <div class="d-flex align-items-center">
                <!-- First Dropdown for Products -->
                <div class="dropdown pe-3">
                    <a class="text-warning text-decoration-none dropdown-toggle" href="#" id="productsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-house"></i> Products
                    </a>
                    <ul class="dropdown-menu bg-dark" aria-labelledby="productsDropdown">
                        <li><a class="dropdown-item text-warning" href="index.php">All Products</a></li>
                        <li><a class="dropdown-item text-warning" href="Medicine.php">Medicine</a></li>
                        <li><a class="dropdown-item text-warning" href="Syrup.php">Syrup</a></li>
                        <li><a class="dropdown-item text-warning" href="Equipment.php">Equipment</a></li>
                    </ul>
                </div>

                <!-- Second Dropdown for Doctor Services -->
                <div class="dropdown pe-3">
                    <a class="text-warning text-decoration-none dropdown-toggle" href="#" id="doctorsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user-md"></i> Doctors
                    </a>
                    <ul class="dropdown-menu bg-dark" aria-labelledby="doctorsDropdown">
                        <li><a class="dropdown-item text-warning" href="doctors.php">Doctor List</a></li>
                        <li><a class="dropdown-item text-warning" href="appointment_status.php">Appointment Status</a></li>
                    </ul>
                </div>

                <div class="dropdown pe-3">
                    <a class="text-warning text-decoration-none" href="view_cart.php">
                        <i class="fa-solid fa-cart-shopping"></i> Cart
                        <span class="badge bg-danger"><?php echo $count; ?></span>
                    </a>
                </div>
                
                <!-- Reward Points Display -->
                <div class="pe-3">
                    <div class="rounded-circle bg-warning text-dark d-inline-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <?php
                        $reward_points = 0;
                        if (isset($_SESSION['user_id'])) {
                            $user_id = $_SESSION['user_id'];
                            $result = mysqli_query($con, "SELECT reward_points FROM tbluser WHERE Id = '$user_id'");
                            if ($row = mysqli_fetch_assoc($result)) {
                                $reward_points = $row['reward_points'];
                            }
                        }
                        echo number_format($reward_points, 0);
                        ?>
                    </div>
                </div>

                <span class="text-warning pe-2">
                    <div class="dropdown d-inline-block">
                        <a class="text-warning text-decoration-none dropdown-toggle" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Hello, <?php 
                            if(isset($_SESSION['user_id'])) {
                                $user_id = $_SESSION['user_id'];
                                $name_query = "SELECT username FROM tbluser WHERE Id = '$user_id'";
                                $name_result = mysqli_query($con, $name_query);
                                if($name_data = mysqli_fetch_assoc($name_result)) {
                                    echo $name_data['username'];
                                }
                            }
                            ?>
                        </a>
                        <?php if(isset($_SESSION['user'])): ?>
                            <ul class="dropdown-menu bg-dark" aria-labelledby="userDropdown">
                                <li>
                                    <a class="dropdown-item text-warning" href="#" data-bs-toggle="modal" data-bs-target="#updateProfileModal">
                                        <i class="fas fa-user-edit"></i> Update Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                                        <i class="fas fa-user-times"></i> Delete Account
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider bg-secondary"></li>
                                <li>
                                    <a class="dropdown-item text-warning" href="form/logout.php">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </a>
                                </li>
                            </ul>
                        <?php else: ?>
                            <a href="form/login.php" class="text-warning text-decoration-none">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </a>
                        <?php endif; ?>
                    </div>
                </span>
                <a href="../admin/mystore.php" class="text-warning text-decoration-none"><i class="fa-solid fa-user-tie"></i> Admin</a>
            </div>
        </div>
    </nav>

    <!-- Update Profile Modal -->
    <div class="modal fade" id="updateProfileModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="updateProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateProfileModalLabel">Update Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="update_profile.php" id="updateProfileForm">
                    <div class="modal-body">
                        <?php
                        if(isset($_SESSION['user_id'])) {
                            $user_id = $_SESSION['user_id'];
                            $user_query = "SELECT * FROM tbluser WHERE Id = '$user_id'";
                            $user_result = mysqli_query($con, $user_query);
                            $user_data = mysqli_fetch_assoc($user_result);
                        }
                        ?>
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $user_data['username']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $user_data['Email']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="number" class="form-control" value="<?php echo $user_data['Number']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">New Password (leave blank to keep current)</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="update_profile" class="btn btn-primary">Update Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Account Modal -->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">Delete Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="text-danger">Warning: This action cannot be undone. All your data will be permanently deleted.</p>
                    <form method="POST" action="delete_account.php">
                        <div class="mb-3">
                            <label class="form-label">Enter your password to confirm</label>
                            <input type="password" name="confirm_password" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="delete_account" class="btn btn-danger">Delete My Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle update profile form submission
        var updateProfileForm = document.getElementById('updateProfileForm');
        if (updateProfileForm) {
            updateProfileForm.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent default form submission
                var modal = bootstrap.Modal.getInstance(document.getElementById('updateProfileModal'));
                if (modal) {
                    modal.hide(); // Hide the modal
                }
                this.submit(); // Submit the form
            });
        }

        // Close modal when clicking outside
        var updateProfileModal = document.getElementById('updateProfileModal');
        if (updateProfileModal) {
            updateProfileModal.addEventListener('hidden.bs.modal', function () {
                document.body.classList.remove('modal-open');
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';
            });
        }
    });
    </script>
</body>
</html>