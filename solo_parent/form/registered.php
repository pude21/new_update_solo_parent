<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$conn = new mysqli('127.0.0.1', 'root', '', 'solo_parent');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare the insert statement
$stmt = $conn->prepare("INSERT INTO registrations (name, age, sex, status, date_of_birth, place_of_birth, home_address, occupation, religion, contact_no, pantawid, elementary, high_school, vocational, college, others, school, civic, community, workplace) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

// Bind parameters
$stmt->bind_param("sissssssssisssssssss", 
    $name, 
    $age, 
    $sex, 
    $status, 
    $date_of_birth, 
    $place_of_birth, 
    $home_address, 
    $occupation, 
    $religion, 
    $contact_no, 
    $pantawid,  
    $elementary,
    $high_school,
    $vocational,
    $college,
    $others,
    $school,
    $civic,
    $community,
    $workplace
);

// Set parameters from POST data
$name = $_POST['name'];
$age = $_POST['age'];
$sex = $_POST['sex'];
$status = $_POST['status'];
$date_of_birth = $_POST['date_of_birth'];
$place_of_birth = $_POST['place_of_birth'];
$home_address = $_POST['home_address'];
$occupation = $_POST['occupation'];
$religion = $_POST['religion'];
$contact_no = $_POST['contact_no'];
$pantawid = isset($_POST['pantawid']) ? $_POST['pantawid'] : '';
$elementary = $_POST['elementary'];
$high_school = $_POST['high_school'];
$vocational = $_POST['vocational'];
$college = $_POST['college'];
$others = $_POST['others'];
$school = $_POST['school'];
$civic = $_POST['civic'];
$community = $_POST['community'];
$workspace = $_POST['workspace'];

// Execute the insert
if ($stmt->execute()) {
    // Optionally, you can redirect or display a success message
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close statement
$stmt->close();

// Handle family members
if (!empty($_POST['family_name'])) {
    $family_stmt = $conn->prepare("INSERT INTO family_members (user_id, name, relationship, age, birthday, occupation) VALUES (?, ?, ?, ?, ?, ?)");
    $user_id = $conn->insert_id; // Get the last inserted ID for family members

    foreach ($_POST['family_name'] as $index => $familyName) {
        $family_relationship = $_POST['family_relationship'][$index];
        $family_age = $_POST['family_age'][$index];
        $family_birthday = $_POST['family_birthday'][$index];
        $family_occupation = $_POST['family_occupation'][$index];

        $family_stmt->bind_param("ississ", $user_id, $familyName, $family_relationship, $family_age, $family_birthday, $family_occupation);
        $family_stmt->execute();
    }
    $family_stmt->close();
}

// Handle seminars
if (!empty($_POST['seminar_title'])) {
    $seminar_stmt = $conn->prepare("INSERT INTO seminars_members (user_id, title, date, organizer) VALUES (?, ?, ?, ?)");
    foreach ($_POST['seminar_title'] as $index => $seminarTitle) {
        $seminar_date = $_POST['seminar_date'][$index];
        $seminar_organizer = $_POST['seminar_organizer'][$index];

        $seminar_stmt->bind_param("isss", $user_id, $seminarTitle, $seminar_date, $seminar_organizer);
        $seminar_stmt->execute();
    }
    $seminar_stmt->close();
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
 <title>Registration Summary</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="mb-4">Registration Summary</h1>

        <!-- Form starts here -->
        <form action="view_details.php" method="POST">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">Identifying Data</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr><th>Name</th><td><input type="text" name="name" value="<?php echo htmlspecialchars($_POST['name']); ?>" class="form-control"></td></tr>
                        <tr><th>Age</th><td><input type="number" name="age" value="<?php echo htmlspecialchars($age); ?>" class="form-control"></td></tr>
                        <tr><th>Sex</th><td><input type="text" name="sex" value="<?php echo htmlspecialchars($_POST['sex']); ?>" class="form-control"></td></tr>
                        <tr><th>Status</th><td><input type="text" name="status" value="<?php echo htmlspecialchars($_POST['status']); ?>" class="form-control"></td></tr>
                        <tr><th>Date of Birth</th><td><input type="date" name="date_of_birth" value="<?php echo htmlspecialchars($_POST['date_of_birth']); ?>" class="form-control"></td></tr>
                        <tr><th>Place of Birth</th><td><input type="text" name="place_of_birth" value="<?php echo htmlspecialchars($_POST['place_of_birth']); ?>" class="form-control"></td></tr>
                        <tr><th>Home Address</th><td><input type="text" name="home_address" value="<?php echo htmlspecialchars($_POST['home_address']); ?>" class="form-control"></td></tr>
                        <tr><th>Occupation</th><td><input type="text" name="occupation" value="<?php echo htmlspecialchars($_POST['occupation']); ?>" class="form-control"></td></tr>
                        <tr><th>Religion</th><td><input type="text" name="religion" value="<?php echo htmlspecialchars($_POST['religion']); ?>" class="form-control"></td></tr>
                        <tr><th>Contact No</th><td><input type="text" name="contact_no" value="<?php echo htmlspecialchars($_POST['contact_no']); ?>" class="form-control"></td></tr>
                        <tr><th>Pantawid</th><td><input type="text" name="pantawid" value="<?php echo htmlspecialchars($_POST['pantawid']); ?>" class="form-control"></td></tr>
                    </table>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-secondary text-white">Family Composition</div>
                <div class="card-body">
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
                            <?php foreach ($_POST['family_name'] as $index => $familyName): ?>
                                <tr>
                                    <td><input type="text" name="family_names[]" value="<?php echo htmlspecialchars($_POST['family_name'][$index]); ?>" class="form-control" /></td>
                                    <td><input type="text" name="family_relationship[]" value="<?php echo htmlspecialchars($_POST['family_relationship'][$index]); ?>" class="form-control" /></td>
                                    <td><input type="number" name="family_age[]" value="<?php echo htmlspecialchars($_POST['family_age'][$index]); ?>" class="form-control" /></td>
                                    <td><input type="date" name="family_birthday[]" value="<?php echo htmlspecialchars($_POST['family_birthday'][$index]); ?>" class="form-control" /></td>
                                    <td><input type="text" name="family_occupation[]" value="<?php echo htmlspecialchars($_POST['family_occupation'][$index]); ?>" class="form-control" /></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-info text-white">Educational Attainment</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr><th>Elementary</th><td><input type="text" name="elementary" value="<?php echo htmlspecialchars($_POST['elementary']); ?>" class="form-control" /></td></tr>
                        <tr><th>High School</th><td><input type="text" name="high_school" value="<?php echo htmlspecialchars($_POST['high_school']); ?>" class="form-control" /></td></tr>
                        <tr><th>Vocational</th><td><input type="text" name="vocational" value="<?php echo htmlspecialchars($_POST['vocational']); ?>" class="form-control" /></td></tr>
                        <tr><th>College</th><td><input type="text" name="college" value="<?php echo htmlspecialchars($_POST['college']); ?>" class="form-control" /></td></tr>
                        <tr><th>Others</th><td><input type="text" name="others" value="<?php echo htmlspecialchars($_POST['others']); ?>" class="form-control" /></td></tr>
                    </table>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-warning text-white">Community Involvement</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr><th>School</th><td><input type="text" name="school" value="<?php echo htmlspecialchars($_POST['school']); ?>" class="form-control" /></td></tr>
                        <tr><th>Civic</th><td><input type="text" name="civic" value="<?php echo htmlspecialchars($_POST['civic']); ?>" class="form-control" /></td></tr>
                        <tr><th>Community</th><td><input type="text" name="community" value="<?php echo htmlspecialchars($_POST['community']); ?>" class="form-control" /></td></tr>
                        <tr><th>Workspace</th><td><input type="text" name="workspace" value="<?php echo htmlspecialchars($_POST['workspace']); ?>" class="form-control" /></td></tr>
                    </table>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-secondary text-white">Seminars and Trainings</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Organizer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($_POST['seminar_title'])): ?>
                                <?php foreach ($_POST['seminar_title'] as $index => $seminarTitle): ?>
                                    <tr>
                                        <td><input type="text" name="seminar_title[]" value="<?php echo htmlspecialchars($seminarTitle); ?>" class="form-control" /></td>
                                        <td><input type="date" name="seminar_date[]" value="<?php echo htmlspecialchars($_POST['seminar_date'][$index]); ?>" class="form-control" /></td>
                                        <td><input type="text" name="seminar_organizer[]" value="<?php echo htmlspecialchars($_POST['seminar_organizer'][$index]); ?>" class="form-control" /></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="3">No seminars and trainings added.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Submit button to save updated data to the database -->
            <button type="submit" name="save_to_database" class="btn btn-primary">Save to Database</button>
        </form>
    </div>
</body>
</html>