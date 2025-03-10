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

// Handle message deletion
if(isset($_POST['delete_message'])) {
    $message_id = mysqli_real_escape_string($con, $_POST['message_id']);
    $delete_query = "DELETE FROM contact_messages WHERE id = '$message_id'";
    if(mysqli_query($con, $delete_query)) {
        echo "<script>alert('Message deleted successfully!');</script>";
    } else {
        echo "<script>alert('Error deleting message: " . mysqli_error($con) . "');</script>";
    }
}

// Fetch all messages
$messages_query = "SELECT * FROM contact_messages ORDER BY created_at DESC";
$messages_result = mysqli_query($con, $messages_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Contact Messages</title>
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
        <h2 class="text-center mb-4">Contact Messages</h2>
        
        <?php if(mysqli_num_rows($messages_result) > 0): ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($message = mysqli_fetch_assoc($messages_result)): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($message['name']); ?></td>
                                <td><?php echo htmlspecialchars($message['email']); ?></td>
                                <td><?php echo nl2br(htmlspecialchars($message['message'])); ?></td>
                                <td><?php echo date('d-m-Y H:i', strtotime($message['created_at'])); ?></td>
                                <td>
                                    <form method="POST" onsubmit="return confirm('Are you sure you want to delete this message?');">
                                        <input type="hidden" name="message_id" value="<?php echo $message['id']; ?>">
                                        <button type="submit" name="delete_message" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info text-center">
                <i class="fas fa-inbox fa-3x mb-3"></i>
                <h4>No Messages</h4>
                <p>There are no contact messages at the moment.</p>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 