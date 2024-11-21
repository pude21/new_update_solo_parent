<?php 
require_once "./util/dbhelper.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    echo "Diko Kita ID";
}
$db = new DbHelper();
$displayAll_Details = $db->Joiningtables($id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VIEW DETAILS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 8.5in; /* Bond paper width */
            height: auto;
            margin: 0 auto;
            padding: 1in;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            font-size: 2em;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        .btn {
            padding: 5px 10px;
            margin: 5px;
            text-decoration: none;
            border-radius: 4px;
            color: white;
            font-size: 1em;
        }

        .btn-primary {
            background-color: #007bff;
        }

        .btn-danger {
            background-color: #dc3545;
        }

        .btn:hover {
            opacity: 0.8;
        }

    </style>
</head>
<body>
    <div class="container">
        <h4 style="text-align:center;">Department of Social Welfare Services</h4>
        <br>
        <h2 style="text-align:center;">Application Form For Solo Parent</h2>
        
        <!-- First Table: Personal Details -->
        <table>
            <thead>
                <tr>
                    <th>Field</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($displayAll_Details as $row) : ?>
                    <tr>
                        <td><strong>Name</strong></td>
                        <td><?= htmlspecialchars($row->fullname); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Date of Birth</strong></td>
                        <td><?= htmlspecialchars($row->date_of_birth); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Philsys Card Number</strong></td>
                        <td><?= htmlspecialchars($row->philsys_card_number); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Age</strong></td>
                        <td><?= htmlspecialchars($row->age); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Sex</strong></td>
                        <td><?= htmlspecialchars($row->sex); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Religion</strong></td>
                        <td><?= htmlspecialchars($row->religion); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Place of Birth</strong></td>
                        <td><?= htmlspecialchars($row->place_of_birth); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Civil Status</strong></td>
                        <td><?= htmlspecialchars($row->civil_status); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Educational Attainment</strong></td>
                        <td><?= htmlspecialchars($row->educational_attainment); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Occupation</strong></td>
                        <td><?= htmlspecialchars($row->occupation); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Monthly Income</strong></td>
                        <td><?= htmlspecialchars($row->monthly_income); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Contact Number</strong></td>
                        <td><?= htmlspecialchars($row->contact_number); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Email Address</strong></td>
                        <td><?= htmlspecialchars($row->email_address); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Pantawid Beneficiary</strong></td>
                        <td><?= htmlspecialchars($row->pantawid_beneficiary); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Indigenous Person</strong></td>
                        <td><?= htmlspecialchars($row->indigenous_person); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Are you a migrant Worker</strong></td>
                        <td><?= htmlspecialchars($row->are_you_a_migrant_worker); ?></td>
                    </tr>
                    <tr>
                        <td><strong>LGBTQ +</strong></td>
                        <td><?= htmlspecialchars($row->lgbtq); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>
        <br>

        <!-- Second Table: Family Members (Assuming you have data for family members) -->
        <h2>Family Members</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Relationship</th>
                    <th>Sex</th>
                    <th>Birthdate</th>
                    <th>Civil Status</th>
                    <th>Educational Attainment</th>
                    <th>Occupation</th>
                    <th>Monthly Income</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($row->family_members)): ?>
                <?php foreach ($row->family_members as $family_member): ?>
                    <tr>
                        <td><?= htmlspecialchars($family_member['name']); ?></td>
                        <td><?= htmlspecialchars($family_member['age']); ?></td>
                        <td><?= htmlspecialchars($family_member['relationship']); ?></td>
                        <td><?= htmlspecialchars($family_member['sex']); ?></td>
                        <td><?= htmlspecialchars($family_member['birthdate']); ?></td>
                        <td><?= htmlspecialchars($family_member['civil_status']); ?></td>
                        <td><?= htmlspecialchars($family_member['educational_attainment']); ?></td>
                        <td><?= htmlspecialchars($family_member['occupation']); ?></td>
                        <td><?= htmlspecialchars($family_member['monthly_income']); ?></td>

                    </tr>
                    
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4">No family members found.</td></tr>
            <?php endif; ?>
        </tbody>
        </table>
        <p>NOTE: Include Family Member and other members of the household especially minor children. Use back side for additional members.</p>
<br>
        <h4>III. Classification/Circumstances of being a solo parent(Dahilan bakit solo parent)?</h4>
                <div>
                    <h5>
                                        
                    </h5>
                </div>
<br>
        <!-- Action buttons (edit, delete) -->
        <div class="text-center">
            <a href="app_form.php?id=<?= $row->id?>" class="btn btn-primary">Edit</a>
            <a href="index.php" class="btn btn-danger">Back</a>
        </div>
    </div>
</body>
</html>
