<?php
include('header.php');
include('config.php');

if(!isset($_SESSION['user'])){
    echo "<script>
        alert('Please login first to view doctors!');
        window.location.href='form/login.php';
    </script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Doctors</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <style>
        .doctor-card {
            transition: transform 0.3s;
        }
        .doctor-card:hover {
            transform: translateY(-5px);
        }
        .doctor-image {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center mb-4">Our Doctors</h2>
        <div class="row">
            <?php
            $select_query = "SELECT * FROM doctors ORDER BY name ASC";
            $result = mysqli_query($con, $select_query);
            
            if(mysqli_num_rows($result) > 0) {
                while($doctor = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="col-md-4 mb-4">
                        <div class="card doctor-card shadow">
                            <div class="card-body text-center">
                                <img src="../admin/doctors/upload/<?php echo $doctor['image']; ?>" alt="<?php echo $doctor['name']; ?>" class="doctor-image mb-3">
                                <h4 class="card-title"><?php echo $doctor['name']; ?></h4>
                                <p class="card-text text-muted"><?php echo $doctor['specialty']; ?></p>
                                <p class="card-text">
                                    <strong>Hospital:</strong> <?php echo $doctor['hospital']; ?><br>
                                    <strong>Consultation Fee:</strong> <?php echo $doctor['fee']; ?> Taka
                                </p>
                                <div class="mt-3">
                                    <a href="book_appointment.php?doctor_id=<?php echo $doctor['id']; ?>" class="btn btn-primary">
                                        Book Appointment
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<div class='col-12 text-center'><h3>No doctors available at the moment.</h3></div>";
            }
            ?>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html> 