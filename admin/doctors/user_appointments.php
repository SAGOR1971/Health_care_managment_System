<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("location:../form/login.php");
    exit();
}
include('config.php');

// Handle clear all appointments
if(isset($_POST['clear_all_appointments'])) {
    $clear_query = "DELETE FROM appointments";
    if(mysqli_query($con, $clear_query)) {
        echo "<script>alert('All appointments have been cleared successfully!');</script>";
    } else {
        echo "<script>alert('Failed to clear appointments.');</script>";
    }
}

// Handle appointment status updates
if(isset($_POST['update_status'])) {
    $appointment_id = $_POST['appointment_id'];
    $status = $_POST['status'];
    
    $update_query = "UPDATE appointments SET status = '$status' WHERE id = $appointment_id";
    mysqli_query($con, $update_query);

    // Add reward points if appointment is approved
    if($status === 'approved') {
        // Get the doctor's fee and user ID for this appointment
        $fee_query = "SELECT a.user_id, d.fee 
                      FROM appointments a 
                      JOIN doctors d ON a.doctor_id = d.id 
                      WHERE a.id = $appointment_id";
        $fee_result = mysqli_query($con, $fee_query);
        
        if($fee_row = mysqli_fetch_assoc($fee_result)) {
            $reward_points = $fee_row['fee'] * 0.10; // 10% of doctor's fee
            $user_id = $fee_row['user_id'];
            
            // Update user's reward points
            mysqli_query($con, "UPDATE tbluser SET reward_points = reward_points + $reward_points WHERE Id = '$user_id'");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Appointments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<nav class="navbar navbar-light bg-primary">
  <div class="container-fluid text-white">
    <a href="../mystore.php" class="navbar-brand text-white"><h1>Medical Store</h1></a>
    <span>
    <i class="fa-solid fa-user-tie"></i>
    Hello, <?php echo isset($_SESSION['admin']) ? $_SESSION['admin'] : ''; ?> |
    <i class="fa-solid fa-right-from-bracket"></i>
    <a href="../form/login.php" class="text-decoration-none text-white">Logout</a> |
    <a href="../../user/index.php" class="text-decoration-none text-white">Users Panel</a>
    </span>
  </div>
</nav>
    
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">
                <h2 class="text-center mb-4">Manage Appointments</h2>
                <form method="POST" class="text-center mb-4" onsubmit="return confirm('Are you sure you want to clear ALL appointments? This action cannot be undone and will affect all users.');">
                    <button type="submit" name="clear_all_appointments" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Clear All Appointments
                    </button>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>ID</th>
                                <th>User Name</th>
                                <th>Doctor Name</th>
                                <th>Appointment Date</th>
                                <th>Time Slot</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $select_query = "SELECT a.*, u.username as user_name, d.name as doctor_name 
                                           FROM appointments a 
                                           JOIN tbluser u ON a.user_id = u.Id 
                                           JOIN doctors d ON a.doctor_id = d.id 
                                           ORDER BY a.appointment_date DESC";
                            $result = mysqli_query($con, $select_query);
                            
                            if(mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>
                                        <td>{$row['id']}</td>
                                        <td>{$row['user_name']}</td>
                                        <td>{$row['doctor_name']}</td>
                                        <td>" . date('d-m-Y', strtotime($row['appointment_date'])) . "</td>
                                        <td>{$row['time_slot']}</td>
                                        <td>
                                            <form method='POST' style='display:inline;'>
                                                <input type='hidden' name='appointment_id' value='{$row['id']}'>
                                                <select name='status' class='form-select form-select-sm' onchange='this.form.submit()'>
                                                    <option value='pending' " . ($row['status'] == 'pending' ? 'selected' : '') . ">Pending</option>
                                                    <option value='approved' " . ($row['status'] == 'approved' ? 'selected' : '') . ">Approved</option>
                                                    <option value='rejected' " . ($row['status'] == 'rejected' ? 'selected' : '') . ">Rejected</option>
                                                </select>
                                                <input type='hidden' name='update_status' value='1'>
                                            </form>
                                        </td>
                                        <td>
                                            <a href='view_appointment.php?id={$row['id']}' class='btn btn-info btn-sm'>
                                                <i class='fas fa-eye'></i> View
                                            </a>
                                        </td>
                                    </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='7' class='text-center'>No appointments found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 