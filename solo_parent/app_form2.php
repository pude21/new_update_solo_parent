<?php 
include "data_connect.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
} else {
    echo "Di ko kita sa ID";
}

if (isset($_POST['submit'])) {
$users_id = $_POST['user_id'];
$names = $_POST['name'];
$sexes = $_POST['sex'];
$relationships = $_POST['relationship'];
$ages = $_POST['age'];
$birthdates = $_POST['birthdate'];
$civil_statuses = $_POST['civil_status'];
$educational_attainments = $_POST['educational_attainment'];
$occupations = $_POST['occupation'];
$monthly_incomes = $_POST['monthly_income'];
$solo_parent_reason = $_POST['solo_parent_reason'];
$solo_parent_needs = $_POST['solo_parent_needs'];
$emer_name = $_POST['emer_name'];
$emer_relationship = $_POST['emer_relationship'];
$emer_address = $_POST['emer_address'];
$emer_contact_num = $_POST['emer_contact_num'];
$solo_parent_card_number = $_POST['solo_parent_card_number'];
$date_issuances = $_POST['date_issuances'];
$c = $_POST['solo_parent_category'];
$beneficiary_code = $_POST['beneficiary_code'];



    

    $allSuccess = true;

    for ($i = 0; $i < count($names); $i++) {
        $user_id = mysqli_real_escape_string($conn, $names[$i]);
        $name = mysqli_real_escape_string($conn, $names[$i]);
        $sex = mysqli_real_escape_string($conn, $sexes[$i]);
        $relationship = mysqli_real_escape_string($conn, $relationships[$i]);
        $age = (int)$ages[$i];
        $birthdate = mysqli_real_escape_string($conn, $birthdates[$i]);
        $civil_status = mysqli_real_escape_string($conn, $civil_statuses[$i]);
        $educational_attainment = mysqli_real_escape_string($conn, $educational_attainments[$i]);
        $occupation = mysqli_real_escape_string($conn, $occupations[$i]);
        $monthly_income = (float)$monthly_incomes[$i];

        $sql = "INSERT INTO `familymembers` (`user_id`, `name`, `sex`, `relationship`, `age`, `birthdate`, `civil_status`, `educational_attainment`, `occupation`, `monthly_income`,``) 
                VALUES ('$id','$name', '$sex', '$relationship', '$age', '$birthdate', '$civil_status', '$educational_attainment', '$occupation', '$monthly_income')";

        if (!mysqli_query($conn, $sql)) {
            $allSuccess = false;
            echo "Failed to add data for $name: " . mysqli_error($conn) . "<br>";
        }
    }

    if ($allSuccess) {
        header("Location: index.php?msg=New Data Added Successfully!");
        exit(); // Important to stop further script execution
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Information Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    
</head>

<body>
    <div class="container my-3 p-5 bg-white shadow rounded">
        <h3>II. Household Composition</h3>
        <form action="" method="POST" stye="width:50vw; min-width:250px;">  <!-- Updated action -->
            <input type="hidden" name="id" value="id">
        <table id="formTable" class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Sex</th>
                        <th>Relationship</th>
                        <th>Age</th>
                        <th>Birthdate</th>
                        <th>Civil Status</th>
                        <th>Educational Attainment</th>
                        <th>Occupation</th>
                        <th>Monthly Income</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" class="form-control" name="name[]" required></td>
                        <td>
                            <select name="sex[]" class="form-select">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="relationship[]" required></td>
                        <td><input type="number" class="form-control" name="age[]" min="0" required></td>
                        <td><input type="date" class="form-control" name="birthdate[]" required></td>
                        <td>
                            <select name="civil_status[]" class="form-select">
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Widowed">Widowed</option>
                                <option value="Divorced">Divorced</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="educational_attainment[]" required></td>
                        <td><input type="text" class="form-control" name="occupation[]" required></td>
                        <td><input type="number" class="form-control" name="monthly_income[]" min="0" step="0.01" required></td>
                        <td><button type="button" class="btn btn-danger" onclick="deleteRow(this)">Delete</button></td>
                    </tr>
                </tbody>
            </table>
            <p>NOTE: Include family members and other household members, especially minor children. Use the back side for additional members.</p>
            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" onclick="addRow()">Add Row</button>
            </div>
        
                
                <script>
                    function addRow() {
                        const table = document.getElementById("formTable").getElementsByTagName("tbody")[0];
                        const newRow = table.rows[0].cloneNode(true);
                        newRow.querySelectorAll("input").forEach(input => input.value = "");
                        newRow.querySelectorAll("select").forEach(select => select.selectedIndex = 0);
                        table.appendChild(newRow);
                    }

                    function deleteRow(button) {
                        const row = button.parentNode.parentNode;
                        const table = row.parentNode;
                        if (table.rows.length > 1) {
                            table.removeChild(row);
                        } else {
                            alert("At least one row is required.");
                        }
                    }
                </script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


            <br>
            <p><label for="solo_parent_reason"><h5>III. Classification/Circumstances of being a solo parent(Dahilan bakit naging solo parent)?</h5></label></p>
            <textarea id="solo_parent_reason" name="solo_parent_reason" rows="6" cols="130" placeholder="Type here..."></textarea>
            <br>
            <br>
            <br>
            <br>
            <p><label for="solo_parent_needs"><h5>IV. Needs/Problems of being a solo parent(Kinakailangan/Problema ng isang solo parent)?</h5></label></p>
            <textarea id="solo_parent_needs" name="solo_parent_needs" rows="6" cols="130" placeholder="Type here..."></textarea>
            <br>
            <br>
            <br>
            <br>
            <h5>V. IN CASE OF EMERGENCY</h5>
            <div class="row">
                    <div class="col-sm-7 my-1 ">&nbsp;
                        <label  style="font-weight: bold;" class="form-label">Name:</label>
                        <input type="text" class="form-control" name="emer_name"  required>
                    </div>
                    <div class="col-sm-5 my-1">
                        <label style="font-weight: bold;" class="form-label">Relationship:</label>
                        <input type="text" class="form-control" name="emer_relationship"  required>
                    </div>
                    <div class="col-sm-7 my-1 ">&nbsp;
                        <label  style="font-weight: bold;" class="form-label">Address:</label>
                        <input type="text" class="form-control" name="emer_address"  required>
                    </div>
                    <div class="col-sm-5 my-1">
                        <label style="font-weight: bold;" class="form-label">Contact Number/s:</label>
                        <input type="text" class="form-control" name="emer_contact_num"  required>
                    </div>
                    <p>I hereby certify that the information given above are true and correct. I further understand that 
                        any misinterpretation that may have made will subject me to criminal and civil liabilities provided
                        for by existing laws. In addition, hereby given my consent to share the information above to the
                        member agencies of the Inter-Agency Coordinating and Monitoring Committee on solo parents.
                    </p>

            <br>
            <br>
            <br>
            <br>

            <h5 style="text-align:center;">FOR SPD/SPO USE ONLY</h5>
            <br>
            <br>
            <div class="col-sm-7 my-1 ">&nbsp;
                        <label  style="font-weight: bold;" class="form-label">Solo Parent Identification Card Number:</label>
                        <input type="text" class="form-control" name="solo_parent_card_number"  required>
                    </div>
                    <div class="col-sm-5 my-1">
                        <label style="font-weight: bold;" class="form-label">Date Issuances:</label>
                        <input type="text" class="form-control" name="date_issuances"  required>
                    </div>
                    <div class="col-sm-7 my-1 ">&nbsp;
                        <label  style="font-weight: bold;" class="form-label">Solo Parent Category:</label>
                        <input type="text" class="form-control" name="solo_parent_category"  required>
                    </div>
                    <div class="col-sm-5 my-1">
                        <label style="font-weight: bold;" class="form-label">Beneficiary Code:</label>
                        <input type="text" class="form-control" name="beneficiary_code"  required>
                    </div>
            <br>
            <br>
            <div class="d-flex justify-content-start">
                <a href="app_form.php" class="btn btn-secondary me-2">Back</a> <!-- Added margin to the right of the Back button -->
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </div>


            </form>
        </div>
    </div>
</body>
</html>

