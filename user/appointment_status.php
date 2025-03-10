<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start session only if it's not already started
}
include('config.php');

if(!isset($_SESSION['user'])){
    echo "<script>
        alert('Please login first to view appointments!');
        window.location.href='form/login.php';
    </script>";
    exit();
}

$user_id = $_SESSION['user_id'];

// Handle clear all appointments
if(isset($_POST['clear_all_appointments'])) {
    $clear_query = "DELETE FROM appointments WHERE user_id = $user_id";
    if(mysqli_query($con, $clear_query)) {
        echo "<script>alert('All appointments have been cleared successfully!');</script>";
    } else {
        echo "<script>alert('Failed to clear appointments.');</script>";
    }
}

// Handle appointment cancellation
if(isset($_POST['cancel_appointment'])) {
    $appointment_id = $_POST['appointment_id'];
    $delete_query = "DELETE FROM appointments WHERE id = $appointment_id AND user_id = $user_id";
    mysqli_query($con, $delete_query);
}

// Handle appointment update
if(isset($_POST['update_appointment'])) {
    $appointment_id = $_POST['appointment_id'];
    $new_date = $_POST['new_date'];
    $new_time_slot = $_POST['new_time_slot'];
    
    // Check if new slot is available
    $check_query = "SELECT * FROM appointments WHERE doctor_id = (SELECT doctor_id FROM appointments WHERE id = $appointment_id) 
                    AND appointment_date = '$new_date' AND time_slot = '$new_time_slot' 
                    AND status != 'rejected' AND id != $appointment_id";
    $check_result = mysqli_query($con, $check_query);
    
    if(mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('This time slot is already booked. Please choose another.');</script>";
    } else {
        $update_query = "UPDATE appointments SET 
                        appointment_date = '$new_date',
                        time_slot = '$new_time_slot',
                        status = 'pending'
                        WHERE id = $appointment_id AND user_id = $user_id";
        
        if(mysqli_query($con, $update_query)) {
            echo "<script>alert('Appointment updated successfully!');</script>";
        } else {
            echo "<script>alert('Failed to update appointment.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Appointments</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
    <?php
    include('header.php');

    $user_id = $_SESSION['user_id'];

    // Handle clear all appointments
    if(isset($_POST['clear_all_appointments'])) {
        $clear_query = "DELETE FROM appointments WHERE user_id = $user_id";
        if(mysqli_query($con, $clear_query)) {
            echo "<script>alert('All appointments have been cleared successfully!');</script>";
        } else {
            echo "<script>alert('Failed to clear appointments.');</script>";
        }
    }

    // Handle appointment cancellation
    if(isset($_POST['cancel_appointment'])) {
        $appointment_id = $_POST['appointment_id'];
        $delete_query = "DELETE FROM appointments WHERE id = $appointment_id AND user_id = $user_id";
        mysqli_query($con, $delete_query);
    }

    // Handle appointment update
    if(isset($_POST['update_appointment'])) {
        $appointment_id = $_POST['appointment_id'];
        $new_date = $_POST['new_date'];
        $new_time_slot = $_POST['new_time_slot'];
        
        // Check if new slot is available
        $check_query = "SELECT * FROM appointments WHERE doctor_id = (SELECT doctor_id FROM appointments WHERE id = $appointment_id) 
                        AND appointment_date = '$new_date' AND time_slot = '$new_time_slot' 
                        AND status != 'rejected' AND id != $appointment_id";
        $check_result = mysqli_query($con, $check_query);
        
        if(mysqli_num_rows($check_result) > 0) {
            echo "<script>alert('This time slot is already booked. Please choose another.');</script>";
        } else {
            $update_query = "UPDATE appointments SET 
                            appointment_date = '$new_date',
                            time_slot = '$new_time_slot',
                            status = 'pending'
                            WHERE id = $appointment_id AND user_id = $user_id";
            
            if(mysqli_query($con, $update_query)) {
                echo "<script>alert('Appointment updated successfully!');</script>";
            } else {
                echo "<script>alert('Failed to update appointment.');</script>";
            }
        }
    }
    ?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12 text-center bg-light mb-5 rounded">
                <h1 class="text-warning">My Appointments</h1>
            </div>
        </div>

        <?php
        // Check if there are any appointments
        $select_query = "SELECT a.*, d.name as doctor_name, d.specialty, d.morning_schedule, d.evening_schedule 
                       FROM appointments a 
                       JOIN doctors d ON a.doctor_id = d.id 
                       WHERE a.user_id = $user_id 
                       ORDER BY a.appointment_date DESC";
        $result = mysqli_query($con, $select_query);
        $appointment_count = mysqli_num_rows($result);

        if($appointment_count > 0) {
        ?>
            <div class="row">
                <div class="col-lg-12 text-center mb-3">
                    <form method="POST" class="mb-3" onsubmit="return confirm('Are you sure you want to clear all your appointments? This action cannot be undone.');">
                        <button type="submit" name="clear_all_appointments" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Clear All Appointments
                        </button>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Doctor</th>
                            <th>Specialty</th>
                            <th>Date</th>
                            <th>Time Slot</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($row = mysqli_fetch_assoc($result)) {
                            $status_class = '';
                            switch($row['status']) {
                                case 'approved':
                                    $status_class = 'text-success';
                                    break;
                                case 'rejected':
                                    $status_class = 'text-danger';
                                    break;
                                default:
                                    $status_class = 'text-warning';
                            }
                            ?>
                            <tr>
                                <td><?php echo $row['doctor_name']; ?></td>
                                <td><?php echo $row['specialty']; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($row['appointment_date'])); ?></td>
                                <td><?php echo $row['time_slot'] == 'morning' ? $row['morning_schedule'] : $row['evening_schedule']; ?></td>
                                <td class="<?php echo $status_class; ?> text-capitalize">
                                    <?php echo $row['status']; ?>
                                </td>
                                <td>
                                    <?php if($row['status'] != 'approved' && strtotime($row['appointment_date']) > time()): ?>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal<?php echo $row['id']; ?>">
                                            <i class="fas fa-edit"></i> Update
                                        </button>
                                        <form method="POST" style="display: inline;">
                                            <input type="hidden" name="appointment_id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" name="cancel_appointment" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to cancel this appointment?')">
                                                <i class="fas fa-times"></i> Cancel
                                            </button>
                                        </form>
                                        
                                        <!-- Update Modal -->
                                        <div class="modal fade" id="updateModal<?php echo $row['id']; ?>" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Update Appointment</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <form method="POST">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="appointment_id" value="<?php echo $row['id']; ?>">
                                                            <div class="mb-3">
                                                                <label class="form-label">New Date</label>
                                                                <input type="date" name="new_date" class="form-control" min="<?php echo date('Y-m-d'); ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">New Time Slot</label>
                                                                <select name="new_time_slot" class="form-select" required>
                                                                    <option value="morning">Morning (<?php echo $row['morning_schedule']; ?>)</option>
                                                                    <option value="evening">Evening (<?php echo $row['evening_schedule']; ?>)</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" name="update_appointment" class="btn btn-primary">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        <?php
        } else {
        ?>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="alert alert-info">
                        <i class="fas fa-calendar-times fa-3x mb-3"></i>
                        <h3>No Appointments Found</h3>
                        <p>You don't have any appointments scheduled at the moment.</p>
                        <a href="doctors.php" class="btn btn-primary mt-3">
                            <i class="fas fa-user-md"></i> Book an Appointment
                        </a>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html> 