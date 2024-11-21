<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli('127.0.0.1', 'root', '', 'solo_parent');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all registered users
$sql = "SELECT id, name FROM registrations";
$result = $conn->query($sql);

// Handle deletion
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_sql = "DELETE FROM registrations WHERE id = ?";
    
    if ($delete_stmt = $conn->prepare($delete_sql)) {
        $delete_stmt->bind_param("i", $delete_id);
        if ($delete_stmt->execute()) {
            echo "<div class='alert alert-success'>User  deleted successfully.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error deleting user: " . $conn->error . "</div>";
        }
        $delete_stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="d-flex justify-content-between mb-4">
        <img src="http://localhost/form/img/logo1.png" class="img-solid" style="max-height: 100px;">
        <h6 class="text-center mb-4">REPUBLIC OF THE PHILIPPINES<br>CITY OF CEBU<br>DEPARTMENT OF SOCIAL WELFARE AND SERVICES</h6>

        <img src="http://localhost/form/img/logo3.png" class="img-solid" style="max-height: 100px;">
    </div>

    <div class="container mt-5">
       <center> <h1 class="mb-4">Registered Users</h1></center>
        
        <!-- Button to add a new user -->
        <a href="index.php" class="btn btn-primary mb-3" >Add New User</a>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td>
                                <a href="user_details.php?id=<?php echo $row['id']; ?>">
                                    <?php echo htmlspecialchars($row['name']); ?>
                                </a>
                            </td>
                            <td>
                                <a href="update_user.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Update</a>
                                <a href="?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2">No registered users found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
// Close connection
$conn->close();
?>