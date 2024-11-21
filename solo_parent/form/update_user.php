<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection using PDO
try {
    $conn = new PDO('mysql:host=127.0.0.1;dbname=solo_parent', 'root', '');
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Check if 'id' is passed in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch user details from the database
    $sql = "SELECT * FROM registrations WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if user exists
    if (!$user) {
        echo "User  not found.";
        exit;
    }

    // Fetch family members from the family_members table
    $family_sql = "SELECT * FROM family_members WHERE user_id = :user_id";
    $family_stmt = $conn->prepare($family_sql);
    $family_stmt->bindParam(':user_id', $id, PDO::PARAM_INT);
    $family_stmt->execute();
    $family_members = $family_stmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch seminars from the seminars table
    $seminar_sql = "SELECT * FROM seminars_members WHERE user_id = :user_id";
    $seminar_stmt = $conn->prepare($seminar_sql);
    $seminar_stmt->bindParam(':user_id', $id, PDO::PARAM_INT);
    $seminar_stmt->execute();
    $seminars = $seminar_stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    echo "Invalid user ID.";
    exit;
}

// Handle form submission for updating user details
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_user'])) {
    // Prepare the update statement for user details
    $update_sql = "UPDATE registrations SET 
        name = :name, age = :age, sex = :sex, status = :status, 
        date_of_birth = :date_of_birth, place_of_birth = :place_of_birth, 
        home_address = :home_address, occupation = :occupation, 
        religion = :religion, contact_no = :contact_no, 
        elementary = :elementary, high_school = :high_school, 
        vocational = :vocational, college = :college, 
        others = :others, school = :school, civic = :civic, 
        community = :community, workplace = :workplace 
        WHERE id = :id";

    $update_stmt = $conn->prepare($update_sql);
    
    // Bind parameters for user details
    $update_stmt->bindParam(':name', $_POST['name']);
    $update_stmt->bindParam(':age', $_POST['age']);
    $update_stmt->bindParam(':sex', $_POST['sex']);
    $update_stmt->bindParam(':status', $_POST['status']);
    $update_stmt->bindParam(':date_of_birth', $_POST['date_of_birth']);
    $update_stmt->bindParam(':place_of_birth', $_POST['place_of_birth']);
    $update_stmt->bindParam(':home_address', $_POST['home_address']);
    $update_stmt->bindParam(':occupation', $_POST['occupation']);
    $update_stmt->bindParam(':religion', $_POST['religion']);
    $update_stmt->bindParam(':contact_no', $_POST['contact_no']);
    $update_stmt->bindParam(':elementary', $_POST['elementary']);
    $update_stmt->bindParam(':high_school', $_POST['high_school']);
    $update_stmt->bindParam(':vocational', $_POST['vocational']);
    $update_stmt->bindParam(':college', $_POST['college']);
    $update_stmt->bindParam(':others', $_POST['others']);
    $update_stmt->bindParam(':school', $_POST['school']);
    $update_stmt->bindParam(':civic', $_POST['civic']);
    $update_stmt->bindParam(':community', $_POST['community']);
    $update_stmt->bindParam(':workplace', $_POST['workplace']);
    $update_stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
    // Execute the update statement
    if ($update_stmt ->execute()) {
        // Set success message in session
        $_SESSION['success_message'] = "User  details updated successfully!";
        // Redirect to the same page to avoid resubmission
        header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $id);
        exit;
    } else {
        echo "Error updating user details.";
    }
}

// Display success message if it exists
if (isset($_SESSION['success_message'])) {
    echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
    // Unset the message after displaying
    unset($_SESSION['success_message']);
}

// Handle form submission for updating family members
if (isset($_POST['update_family'])) {
    foreach ($_POST['family'] as $family_id => $family_data) {
        $family_update_sql = "UPDATE family_members SET 
            name = :name, relationship = :relationship, age = :age, 
            birthday = :birthday, occupation = :occupation 
            WHERE id = :family_id";

        $family_update_stmt = $conn->prepare($family_update_sql);
        $family_update_stmt->bindParam(':name', $family_data['name']);
        $family_update_stmt->bindParam(':relationship', $family_data['relationship']);
        $family_update_stmt->bindParam(':age', $family_data['age']);
        $family_update_stmt->bindParam(':birthday', $family_data['birthday']);
        $family_update_stmt->bindParam(':occupation', $family_data['occupation']);
        $family_update_stmt->bindParam(':family_id', $family_id, PDO::PARAM_INT);
        $family_update_stmt->execute();
    }
    echo "<div class='alert alert-success'>Family details updated successfully!</div>";
}

// Handle form submission for updating seminars
if (isset($_POST['update_seminars'])) {
    foreach ($_POST['seminars'] as $seminar_id => $seminar_data) {
        $seminar_update_sql = "UPDATE seminars SET 
            title = :title, date = :date, organizer = :organizer 
            WHERE id = :seminar_id";

        $seminar_update_stmt = $conn->prepare($seminar_update_sql);
        $seminar_update_stmt->bindParam(':title', $seminar_data['title']);
        $seminar_update_stmt->bindParam(':date', $seminar_data['date']);
        $seminar_update_stmt->bindParam(':organizer', $seminar_data['organizer']);
        $seminar_update_stmt->bindParam(':seminar_id', $seminar_id, PDO::PARAM_INT);
        $seminar_update_stmt->execute();
    }
    echo "<div class='alert alert-success'>Seminar details updated successfully!</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1>Edit User Details</h1>
        <form method="POST" action="">
            <!-- User details form fields -->
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($user['name'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" class="form-control" id="age" name="age" value="<?php echo htmlspecialchars($user['age'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="sex">Sex</label>
                <select class="form-control" id="sex" name="sex" required>
                    <option value="Male" <?php echo ($user['sex'] ?? '') === 'Male' ? 'selected' : ''; ?>>Male</option>
                    <option value="Female" <?php echo ($user['sex'] ?? '') === 'Female' ? 'selected' : ''; ?>>Female</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <input type="text" class="form-control" id="status" name="status" value="<?php echo htmlspecialchars($user['status'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="date_of_birth">Date of Birth</label>
                <input type="date" class="form-control" id="date_of _birth" name="date_of_birth" value="<?php echo htmlspecialchars($user['date_of_birth'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="place_of_birth">Place of Birth</label>
                <input type="text" class="form-control" id="place_of_birth" name="place_of_birth" value="<?php echo htmlspecialchars($user['place_of_birth'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="home_address">Home Address</label>
                <input type="text" class="form-control" id="home_address" name="home_address" value="<?php echo htmlspecialchars($user['home_address'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="occupation">Occupation</label>
                <input type="text" class="form-control" id="occupation" name="occupation" value="<?php echo htmlspecialchars($user['occupation'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="religion">Religion</label>
                <input type="text" class="form-control" id="religion" name="religion" value="<?php echo htmlspecialchars($user['religion'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="contact_no">Contact No</label>
                <input type="text" class="form-control" id="contact_no" name="contact_no" value="<?php echo htmlspecialchars($user['contact_no'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="elementary">Elementary</label>
                <input type="text" class="form-control" id="elementary" name="elementary" value="<?php echo htmlspecialchars($user['elementary'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="high_school">High School</label>
                <input type="text" class="form-control" id="high_school" name="high_school" value="<?php echo htmlspecialchars($user['high_school'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="vocational">Vocational</label>
                <input type="text" class="form-control" id="vocational" name="vocational" value="<?php echo htmlspecialchars($user['vocational'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="college">College</label>
                <input type="text" class="form-control" id="college" name="college" value="<?php echo htmlspecialchars($user['college'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="others">Others</label>
                <input type="text" class="form-control" id="others" name="others" value="<?php echo htmlspecialchars($user['others'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="school">School</label>
                <input type="text" class="form-control" id="school" name="school" value="<?php echo htmlspecialchars($user['school'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="civic">Civic</label>
                <input type="text" class="form-control" id="civic" name="civic" value="<?php echo htmlspecialchars($user['civic'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="community">Community</label>
                <input type="text" class="form-control" id="community" name="community" value="<?php echo htmlspecialchars($user['community'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="workplace">Workplace</label>
                <input type="text" class="form-control" id="workplace" name="workplace" value="<?php echo htmlspecialchars($user['workplace'] ?? ''); ?>">
            </div>
            <button type="submit" name="update_user" class="btn btn-primary">Update User Details</button>
        </form>

        <h1 class="mt-5">Edit Family Members</h1>
        <form method="POST" action="">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Relationship</th>
                        <th>Age</th>
                        <th>Birthday</th>
                        <th>Occupation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($family_members as $member): ?>
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="family[<?php echo $member['id']; ?>][name]" value="<?php echo htmlspecialchars($member['name'] ?? ''); ?>" required>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="family[<?php echo $member['id']; ?>][relationship]" value="<?php echo htmlspecialchars($member['relationship'] ?? ''); ?>" required>
                            </td>
                            <td>
                                <input type="number" class="form-control" name="family[<?php echo $member['id']; ?>][age]" value="<?php echo htmlspecialchars($member['age'] ?? ''); ?>" required>
                            </td>
                            <td>
                                <input type="date" class="form-control" name="family[<?php echo $member['id']; ?>][birthday]" value="<?php echo htmlspecialchars($member['birthday'] ?? ''); ?>" required>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="family[<?php echo $member['id']; ?>][occupation]" value="<?php echo htmlspecialchars($member['occupation'] ?? ''); ?>" required>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button type="submit" name="update_family" class="btn btn-primary">Update Family Details</button>
        </form>

        <h1 class="mt-5">Edit Seminar Details</h1>
        <form method="POST" action="">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Organizer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($seminars as $seminar): ?>
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="seminars[<?php echo $seminar['id']; ?>][title]" value="<?php echo htmlspecialchars($seminar['title'] ?? ''); ?>">
                            </td>
                            <td>
                                <input type="date" class="form-control" name="seminars[<?php echo $seminar['id']; ?>][date]" value="<?php echo htmlspecialchars($seminar['date'] ?? ''); ?>">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="seminars[<?php echo $seminar['id']; ?>][organizer]" value="<?php echo htmlspecialchars($seminar['organizer'] ?? ''); ?>">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button type="submit" name="update_seminars" class="btn btn-primary">Update Seminar Details</button>
        </form>

        <a href="view_details.php" class="btn btn-secondary mt-3">Back to Users</a>
    </div>
</body>
</html>

<?php
// Close connection
$conn = null; // PDO connection is closed by setting it to null
?>