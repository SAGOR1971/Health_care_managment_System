<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("location:../form/login.php");
    exit();
}
include('config.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $select_query = "SELECT * FROM doctors WHERE id = $id";
    $result = mysqli_query($con, $select_query);
    $doctor = mysqli_fetch_assoc($result);
}

if(isset($_POST['update_doctor'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $specialty = $_POST['specialty'];
    $hospital = $_POST['hospital'];
    $morning_schedule = $_POST['morning_schedule'];
    $evening_schedule = $_POST['evening_schedule'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $description = $_POST['description'];
    $fee = $_POST['fee'];
    $old_image = $_POST['old_image'];

    if($_FILES['image']['name'] != '') {
        $image = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $image_ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        $allowed_types = array('jpg', 'jpeg', 'png');
        
        if(in_array($image_ext, $allowed_types)) {
            $new_image_name = time() . '_' . $image;
            move_uploaded_file($tmp_name, "upload/" . $new_image_name);
            if(file_exists("upload/" . $old_image)) {
                unlink("upload/" . $old_image);
            }
        } else {
            echo "<script>alert('Invalid image format!');</script>";
            $new_image_name = $old_image;
        }
    } else {
        $new_image_name = $old_image;
    }

    $update_query = "UPDATE doctors SET 
        name = '$name',
        number = '$number',
        email = '$email',
        specialty = '$specialty',
        hospital = '$hospital',
        morning_schedule = '$morning_schedule',
        evening_schedule = '$evening_schedule',
        age = $age,
        gender = '$gender',
        description = '$description',
        fee = $fee,
        image = '$new_image_name'
        WHERE id = $id";
    
    if(mysqli_query($con, $update_query)) {
        echo "<script>
            alert('Doctor updated successfully!');
            window.location.href='view_doctors.php';
        </script>";
    } else {
        echo "<script>alert('Failed to update doctor!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Doctor</title>
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
    <div class="container">
        <div class="row">
            <div class="col-md-8 mt-4 mb-4 m-auto">
                <h2 class="text-center mb-4">Update Doctor</h2>
                <form method="POST" enctype="multipart/form-data" class="shadow p-4 rounded">
                    <input type="hidden" name="id" value="<?php echo $doctor['id']; ?>">
                    <input type="hidden" name="old_image" value="<?php echo $doctor['image']; ?>">
                    
                    <div class="mb-3">
                        <label class="form-label">Doctor Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $doctor['name']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="number" class="form-control" value="<?php echo $doctor['number']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $doctor['email']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Specialty</label>
                        <input type="text" name="specialty" class="form-control" value="<?php echo $doctor['specialty']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Hospital Name</label>
                        <input type="text" name="hospital" class="form-control" value="<?php echo $doctor['hospital']; ?>" required>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Morning Schedule</label>
                            <input type="text" name="morning_schedule" class="form-control" value="<?php echo $doctor['morning_schedule']; ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Evening Schedule</label>
                            <input type="text" name="evening_schedule" class="form-control" value="<?php echo $doctor['evening_schedule']; ?>" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Age</label>
                        <input type="number" name="age" class="form-control" value="<?php echo $doctor['age']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-control" required>
                            <option value="Male" <?php echo ($doctor['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                            <option value="Female" <?php echo ($doctor['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                            <option value="Other" <?php echo ($doctor['gender'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3" required><?php echo $doctor['description']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Consultation Fee</label>
                        <input type="number" name="fee" class="form-control" value="<?php echo $doctor['fee']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Current Image</label><br>
                        <img src="upload/<?php echo $doctor['image']; ?>" alt="Doctor Image" width="100"><br>
                        <label class="form-label mt-2">Update Image (leave blank to keep current)</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="update_doctor" class="btn btn-primary">Update Doctor</button>
                        <a href="view_doctors.php" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html> 