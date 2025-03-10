<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Doctor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php
    session_start();
    if(!$_SESSION['admin']){
        header("location:../form/login.php");
    }
    ?>
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
            <div class="col-md-8 mt-4 mb-4 m-auto">
                <h2 class="text-center mb-4">Add New Doctor</h2>
                <form action="insert_doctor.php" method="POST" enctype="multipart/form-data" class="shadow p-4 rounded">
                    <div class="mb-3">
                        <label class="form-label">Doctor Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="number" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Specialty</label>
                        <input type="text" name="specialty" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Hospital Name</label>
                        <input type="text" name="hospital" class="form-control" required>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Morning Schedule</label>
                            <input type="text" name="morning_schedule" class="form-control" placeholder="e.g. 9:00 AM - 1:00 PM" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Evening Schedule</label>
                            <input type="text" name="evening_schedule" class="form-control" placeholder="e.g. 5:00 PM - 9:00 PM" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Age</label>
                        <input type="number" name="age" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-control" required>
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Consultation Fee</label>
                        <input type="number" name="fee" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Doctor's Photo</label>
                        <input type="file" name="image" class="form-control" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="add_doctor" class="btn btn-primary">Add Doctor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html> 