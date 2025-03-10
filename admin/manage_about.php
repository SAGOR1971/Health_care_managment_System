<?php
session_start();
include('../user/config.php');

// Check if admin is logged in
if(!isset($_SESSION['admin'])) {
    echo "<script>
        alert('Please login first!');
        window.location.href='form/login.php';
    </script>";
    exit();
}

// Handle form submission
if(isset($_POST['update_about'])) {
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $mission = mysqli_real_escape_string($con, $_POST['mission']);
    $vision = mysqli_real_escape_string($con, $_POST['vision']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $working_hours = mysqli_real_escape_string($con, $_POST['working_hours']);

    // Check if record exists
    $check_query = "SELECT id FROM about_us LIMIT 1";
    $check_result = mysqli_query($con, $check_query);

    if(mysqli_num_rows($check_result) > 0) {
        // Update existing record
        $update_query = "UPDATE about_us SET 
            title = '$title',
            description = '$description',
            mission = '$mission',
            vision = '$vision',
            address = '$address',
            phone = '$phone',
            email = '$email',
            working_hours = '$working_hours'
            WHERE id = 1";
        
        if(mysqli_query($con, $update_query)) {
            echo "<script>alert('About Us content updated successfully!');</script>";
        } else {
            echo "<script>alert('Error updating content: " . mysqli_error($con) . "');</script>";
        }
    } else {
        // Insert new record
        $insert_query = "INSERT INTO about_us (title, description, mission, vision, address, phone, email, working_hours) 
            VALUES ('$title', '$description', '$mission', '$vision', '$address', '$phone', '$email', '$working_hours')";
        
        if(mysqli_query($con, $insert_query)) {
            echo "<script>alert('About Us content added successfully!');</script>";
        } else {
            echo "<script>alert('Error adding content: " . mysqli_error($con) . "');</script>";
        }
    }
}

// Fetch existing content
$fetch_query = "SELECT * FROM about_us LIMIT 1";
$result = mysqli_query($con, $fetch_query);
$about = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage About Us</title>
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
    <div class="container mt-4">
        <h2 class="text-center mb-4">Manage About Us Content</h2>
        
        <div class="card">
            <div class="card-body">
                <form method="POST" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" value="<?php echo $about['title'] ?? ''; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="4" required><?php echo $about['description'] ?? ''; ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mission</label>
                        <textarea name="mission" class="form-control" rows="3" required><?php echo $about['mission'] ?? ''; ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Vision</label>
                        <textarea name="vision" class="form-control" rows="3" required><?php echo $about['vision'] ?? ''; ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control" rows="2" required><?php echo $about['address'] ?? ''; ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" value="<?php echo $about['phone'] ?? ''; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $about['email'] ?? ''; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Working Hours</label>
                        <textarea name="working_hours" class="form-control" rows="2" required><?php echo $about['working_hours'] ?? ''; ?></textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" name="update_about" class="btn btn-primary">Update Content</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 